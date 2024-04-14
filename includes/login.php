
<?php
include 'db_conn.php';
session_start();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE name = '$name' AND password = '$pass'";

    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if (!empty($row['name'])) { 
            $_SESSION['user_name'] = $row['name'];

            
            header('location: dashboard.php');
            exit();
        }
    } else {
        $error[] = 'Incorrect username or password!';
    }
}
?>