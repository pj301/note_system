<?php
session_start();
include 'dashboard.php';
include 'includes/db_conn.php'; 

$userID = ""; // Initialize userID
$userName = ""; // Initialize userName
$email = ""; // Initialize email
$userImage = ""; // Initialize userImage variable

if (isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name']; 
    
    $select = "SELECT id, name, email, imgpath FROM user_form WHERE name = '$name'";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['id']; 
        $userName = $row['name']; 
        $email = $row['email'];
        $userImage = $row['imgpath']; // Fetch image path directly from user_form table
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
    <div id="main" class="container">
       
        <div class="user-image-container">
            <?php if (!empty($userImage)) : ?>
                <img src="<?php echo $userImage; ?>" alt="User Image" class="user-image">
            <?php else : ?>
                <img src="images/user.png" alt="Default User Image" class="user-image">
            <?php endif; ?>
        </div>
        <div class="user-details">
            <h2>User Profile</h2>
            <p><strong>Name:</strong> <?php echo isset($userName) ? $userName : ""; ?></p> 
            <p><strong>Email:</strong> <?php echo isset($email) ? $email : ""; ?></p> 
        </div>

        <div class="buttons">
          
            <button id="choosePictureBtn">Choose Image</button>
            <button onclick="location.href='editprofile.php';">Edit Profile</button>
            <button onclick="location.href='changepass.php';">Change Password</button>
        </div>
    </div>

    <!-- Hidden input field to select image file -->
    <input type="file" id="imageInput" style="display: none;">

    <script>
        // Function to handle click event on choose picture button
        document.getElementById('choosePictureBtn').addEventListener('click', function() {
            document.getElementById('imageInput').click(); // Click on hidden input field
        });

        // Function to handle file selection
        document.getElementById('imageInput').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var formData = new FormData();
                formData.append('file', file);

                // Send AJAX request to upload or update image
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_image.php'); // PHP script to handle image upload
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Image uploaded or updated successfully
                        console.log('Image uploaded:', xhr.responseText);
                        // Reload the page to display the updated image
                        location.reload();
                    } else {
                        // Error handling
                        console.error('Image upload failed:', xhr.responseText);
                    }
                };
                xhr.send(formData);
            }
        });
    </script>
</body>
</html>
