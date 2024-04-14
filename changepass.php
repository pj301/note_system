<?php
include_once 'dashboard.php';


include 'includes/db_conn.php';


$currentPasswordErr = $newPasswordErr = $confirmPasswordErr = '';
$passwordUpdated = false;


if (isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
        $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

       
        $select = "SELECT password FROM user_form WHERE name = '$name'";
        $result = mysqli_query($conn, $select);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

           
            if (md5($currentPassword) == $storedPassword) {
                
                if (strlen($newPassword) < 8) {
                    $newPasswordErr = "Password must be at least 8 characters long";
                } elseif ($newPassword != $confirmPassword) {
                    $confirmPasswordErr = "Passwords do not match";
                } else {
                    
                    $hashedPassword = md5($newPassword);

                   
                    $updateQuery = "UPDATE user_form SET password = '$hashedPassword' WHERE name = '$name'";
                    mysqli_query($conn, $updateQuery);

                    
                    $passwordUpdated = true;

                   
                    header('Location: userpage.php');
                    exit();
                }
            } else {
                $currentPasswordErr = "Incorrect current password";
            }
        }
    }
}
?>


<link rel="stylesheet" type="text/css" href="css/userpage.css">
<style>
    .container{
    background-image: url(images/pro-table-bottom.png);
    background-position: right top;
    background-repeat: no-repeat;
    background-size: cover;
    }
    </style>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="" method="post">
            <label for="current_password">Current Password:</label><br>
            <input type="password" id="current_password" name="current_password"><br>
            <span class="error"><?php echo $currentPasswordErr; ?></span><br>

            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password"><br>
            <span class="error"><?php echo $newPasswordErr; ?></span><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password"><br>
            <span class="error"><?php echo $confirmPasswordErr; ?></span><br>

            <button type="submit" name="update_password">Update Password</button>
        </form>
    </div>
</body>
</html>
