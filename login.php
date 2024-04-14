<?php
include 'includes/db_conn.php';

session_start(); // Start the session
$error = array(); // Initialize error array

if (isset($_POST['name']) && isset($_POST['password'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE name = '$name' AND password ='$pass'";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (!empty($row['name'])) {
            $_SESSION['user_name'] = $row['name'];
            echo json_encode(array('success' => true));
             // Output JavaScript only if there are no errors
           
            exit();
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Incorrect username or password!'));
        exit();
    }
}

echo json_encode(array('success' => false, 'message' => 'Invalid request'));
