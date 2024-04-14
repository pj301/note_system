<?php
session_start();
include 'dashboard.php';
include 'includes/db_conn.php'; 

$userID = ""; // Initialize userID
$userName = ""; // Initialize userName
$email = ""; // Initialize email
$userImage = ""; // Initialize userImage variable
$userPass = ""; // Initialize userImage variable

if (isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name']; 
    
    $select = "SELECT id, name, email, imgpath,password FROM user_form WHERE name = '$name'";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['id']; 
        $userName = $row['name']; 
        $email = $row['email'];
        $userImage = $row['imgpath']; 
         $userPass = $row['password']; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/userpage.css">
    <style>
        body {
    margin: 0;
    padding: 0;
}
#main{
    margin-top: 5px;
}
.user-container .user-label{
    margin-top: 0;
}
.user-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align items to the left */
    padding: 20px;
    margin: 0;
    margin-top: 0; /* Ensure no margin at the top */
}

        .user-label {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .user-details-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            width: 100%; 
            background-color: #f7f7f7;
            border-bottom: 1px solid #ccc;
            padding: 0px 0px 16px; 
        }
        .user-details {
            display: flex;
             width: inherit;
             padding: 0px 0px 16px; 
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: flex-start;
            min-width: 0;
        }
        .user-label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .user-label label{
            font-size:14px;
        }
        .user-details p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .user-details-container button {
            background-color:#40576D12;
             height: 40px;
             color: rgb(0, 0, 0);
            padding: 0px 8px;
            margin: 32px 0px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .user-details-container button:hover {
            background-color: rgba(64, 87, 109, 0.12);
        }
        .profile-pic {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Adjusts spacing between image and buttons */
            margin-bottom: 20px;
        }
        /* .profile-pic img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
            margin-left:0;
        } */
        /* .profile-button-container {
            column-gap: 16px;
            display: flex;
            flex-direction: row;
        } */
        /* .profile-button-container button {
            margin-bottom: 10px;
            padding: 0px 8px;
            height: 40px;
        } */
        .profile-button-container span{
            font-size: 14px;
            margin: 9px 0px;
            padding:0px 8px;
        }
        .profile-button-container button.remove-pic {
    margin-bottom: 10px;
    padding: 0px 8px;
    height: 40px;
    background-color: transparent; /* Set background color to transparent */
}
/* Styles for the image container */
.image-container {
    position: relative;
    display: inline-block;

}

/* Styles for the profile pic image */
.profile-pic img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
  
}

/* Styles for the button container */
.profile-button-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

/* Styles for the buttons */
.profile-button-container button {
    padding: 0 8px;
    height: 40px;
    margin-bottom: 10px;
}

/* Styles for the camera overlay */
.camera-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor:pointer;
}

/* Styles for the camera icon */
.camera-overlay i {
    color: white;
    cursor:pointer;
}

/* Hover effect for the camera overlay */
.profile-img-wrapper:hover .camera-overlay {
    opacity: 1;
}

/* Dim the image on hover */
.profile-img-wrapper:hover img {
    filter: brightness(70%);
}

    </style>
</head>
<body>
    <div id="main" class="user-container">
        <div class="user-label">Your Account</div>
        <div class="user-details-container">
            <div class="user-details">
                <div class="user-label">Profile Photo</div>
                <div class="profile-pic">
                    <div class="image-container">
                    <?php if (!empty($userImage)) : ?>
                        <label for="imageInput" class="profile-img-wrapper">
                            <img src="<?php echo $userImage; ?>" alt="User Image">
                            <div class="camera-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                    <?php else : ?>
                        <label for="imageInput" class="profile-img-wrapper">
                            <img src="images/user.png" alt="Default User Image">
                            <div class="camera-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                    <?php endif; ?>
                    <input type="file" id="imageInput" style="display: none;">
                    </div>
                    <div class="profile-button-container">
                        <button class="remove-pic"><span>Remove photo</span></button>
                        <button class="change-pic"><span>Change photo</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-details-container">
            <div class="user-details">
                <div class="user-label"> <label>Account Name</label></div>
                <p><?php echo isset($userName) ? $userName : ""; ?></p>    
                
            </div>
            <button>Edit</button>
        </div>
        <div class="user-details-container">
            <div class="user-details">
                <div class="user-label"> <label>Email Address</label></div>
                <p><?php echo isset($email) ? $email : ""; ?></p> 
               
            </div>
            <button>Edit</button>
        </div>
        <div class="user-details-container">
            <div class="user-details">
                <div class="user-label"><label>Password</label></div>
                <p><?php echo isset($userPass) ? $userPass : ""; ?></p> 
              
            </div>
            <button>Edit</button>
        </div>
    </div>



    <!-- Hidden input field to select image file -->
    <!-- <input type="file" id="imageInput" style="display: none;"> -->

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


        // Get the edit button for Account Name
const editButton = document.querySelector('.user-details-container .edit-btn');

// Attach click event listener to the edit button
editButton.addEventListener('click', () => {
    const container = editButton.parentElement;
    const details = container.querySelector('.user-details');
    const input = container.querySelector('.edit-input');
    const currentValue = details.querySelector('.account-name').innerText.trim();

    // Toggle visibility of input field
    if (input.style.display === 'none') {
        // Display input field
        input.style.display = 'block';
        input.value = currentValue;
        details.querySelector('.account-name').style.display = 'none';
        editButton.innerText = 'Cancel'; // Change button text to Cancel
    } else {
        // Hide input field
        input.style.display = 'none';
        details.querySelector('.account-name').style.display = 'block';
        editButton.innerText = 'Edit'; // Change button text to Edit
    }
});

    </script>
</body>
</html>
