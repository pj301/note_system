<?php
session_start();
include 'includes/db_conn.php';
include 'dashboard.php';

if(isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name']; 
    
    $select = "SELECT name, email FROM user_form WHERE name = '$name'";
    $result = mysqli_query($conn, $select);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userName = $row['name']; 
        $email = $row['email'];
    }
}

if(isset($_POST['update_username'])) {
    $newName = mysqli_real_escape_string($conn, $_POST['new_name']);
    
    // Check if the new username already exists
    $checkUsernameQuery = "SELECT * FROM user_form WHERE name = '$newName' AND name != '$name'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
    
    if(mysqli_num_rows($checkUsernameResult) > 0) {
        echo "<script>alert('Username already taken');</script>";
    } else {
        // Update the username
        $update_query = "UPDATE user_form SET name = '$newName' WHERE name = '$name'";
        mysqli_query($conn, $update_query);
        
        if(mysqli_affected_rows($conn) > 0) {
            $_SESSION['user_name'] = $newName;
        }
        
        header('Location: userpage.php');
        exit();
    }
    
}

if(isset($_POST['update_email'])) {
    $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);

    $checkemailQuery = "SELECT * FROM user_form WHERE email = '$newEmail' AND email != '$email'";
    $checkemailResult = mysqli_query($conn, $checkemailQuery);

    if(mysqli_num_rows($checkemailResult) > 0) {
        echo "<script>alert('Email already taken');</script>";
    } else{

    // Update the email
    $update_query = "UPDATE user_form SET email = '$newEmail' WHERE name = '$name'";
    mysqli_query($conn, $update_query);

    header('Location: userpage.php');
    exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title> 
    <link rel="stylesheet" type="text/css" href="css/userpage.css">
    <style>
    .container{
    background-image: url(images/pro-table-bottom.png);
    background-position: right top;
    background-repeat: no-repeat;
    background-size: cover;
    }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Profile</h2>
    <form action="" method="post">
        <label for="current_name">Username:</label><br>
        <input type="text" id="new_name" name="new_name" value="<?php echo $name; ?>"><br><br> 
        <button type="submit" name="update_username">Update Username</button><br><br>
        <label for="new_email">Email:</label><br>
        <input type="email" id="new_email" name="new_email" value="<?php echo $email; ?>"><br><br>
        
        <button type="submit" name="update_email">Update Email</button>
    </form>
</div>

<script>

    
    updateButton.addEventListener('click', function() {
        var newName = document.getElementById('new_name').value;
        document.querySelector('.user-section span').textContent = newName;
    });

</script>


</body>
</html>
