<?php
session_start();
include 'includes/db_conn.php';

if (isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name'];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        if ($fileError === UPLOAD_ERR_OK) {
            $uploadDirectory = 'uploads/';

            // Generate a unique filename
            $prefix = 'SHESH-' . $name . '-';
            $newFileName = uniqid($prefix, true) . '_' . $fileName;
            $targetPath = $uploadDirectory . $newFileName;

            // Get user's ID from user_form table
            $select = "SELECT id FROM user_form WHERE name = '$name'";
            $result = mysqli_query($conn, $select);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $userID = $row['id'];

                // Update or insert image path into user_form table
                $update = "UPDATE user_form SET imgpath = '$targetPath' WHERE id = $userID";
                mysqli_query($conn, $update);
            } else {
                // Handle the case where user does not exist
                echo 'Error: User not found.';
                exit(); // Exit script
            }

            // Move uploaded file to target directory
            move_uploaded_file($fileTmpName, $targetPath);

            echo $targetPath; // Return the path of the uploaded file
        } else {
            echo 'Error: File upload failed.';
        }
    } 
}
?>
