<?php
include 'includes/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an empty array to store any errors
    $errors = [];

    // Validate form data
    if (empty($_POST['name'])) {
        $errors[] = "Name is required";
    } elseif (strpos($_POST['name'], ' ') !== false) {
        $errors[] = "Username cannot contain whitespace";
    }

    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($_POST['password'])) {
        $errors[] = "Password is required";
    } elseif (strlen($_POST['password']) < 8) {
        $errors[] = "Password should be 8 characters or longer";
    } elseif (!preg_match("/[a-zA-Z]/", $_POST['password']) || !preg_match("/\d/", $_POST['password'])) {
        $errors[] = "Password should contain both letters and numbers";
    }

    if ($_POST['password'] !== $_POST['cpassword']) {
        $errors[] = "Passwords do not match";
    }

    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Hash the password using MD5
        $hashed_password = md5($password);

        // Check if username or email already exists
        $select = "SELECT * FROM user_form WHERE email = '$email' OR name = '$name'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = 'Username or email already exists';
            $response = array("success" => false, "message" => $errors[0]);
            echo json_encode($response);
        } else {
            // Insert user data into the database
            $insert = "INSERT INTO user_form (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $insert)) {
                // If insertion is successful, send success response
                $response = array("success" => true, "message" => "Registration successful");
                echo json_encode($response);
            } else {
                // If insertion fails, send error response
                $response = array("success" => false, "message" => "Error: " . mysqli_error($conn));
                echo json_encode($response);
            }
        }
    } else {
        // If there are errors in form validation, send error response
        $response = array("success" => false, "message" => $errors[0]); // Send only the first error message
        echo json_encode($response);
    }
} else {
    // If the request method is not POST, send error response
    $response = array("success" => false, "message" => "Invalid request method");
    echo json_encode($response);
}
?>
