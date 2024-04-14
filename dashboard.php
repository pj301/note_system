<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="fonts-awesome/css/all.css">
    <link rel="stylesheet" href="styless/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styless/home.css"> 
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
       .user-image1 {
    border-radius: 50%;
    margin-right: 10px;
    max-width: 60px;
    height: auto;
    
}
.color-alter {
    color: #28a745;
    font-size: 25px;
  }
    </style>
</head>
<body>
<!-- /* ________________________________________________________________________________*/ -->
    <header>
        <div class="menu-icon" onclick="toggleNav()">
            <i class="fas fa-bars"></i> <!-- Font Awesome menu icon -->
        </div>
        <!-- <div id="currentDateTime"> </div>  -->
        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn">
                <!-- Search button content -->
                
            </div>
        </div>
        
    </header>
<!-- /* ________________________________________________________________________________*/ -->
    <div class="main-container">
        <div id="mySidebar"class="navcontainer">
            <nav  class="nav">
                <div class="logosec"> <!-- Moved logo here -->
                    <a href="#" class="logo">
                        <img src="images/note-image.png" alt="Logo">
                        <div class="logo-name" style="color:white; font-size: 25px; font-weight:bold;">Easy<span class="color-alter">Note</span></div>
                    </a>
                </div>
                <div class="break-line"></div> <!-- Break line will be inserted here -->
                <div class="nav-upper-options">
                    <ul>
                            <li><a href="dashboardpage.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboardpage.php') ? 'class="active"' : ''; ?>><i class="fas fa-house"></i> Dashboard</a></li>
                            <li><a href="notebook.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'notebook.php') ? 'class="active"' : ''; ?>><i class="fas fa-sticky-note"></i> All Notes</a></li>
                            <li><a href="favorite.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'favorite.php') ? 'class="active"' : ''; ?>><i class="fas fa-heart"></i> Favorites</a></li>
                            <li><a href="archivepage.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'archivepage.php') ? 'class="active"' : ''; ?>><i class="fas fa-archive"></i> Archives</a></li>
                        </ul>
                    
                </div>
                
                <div class="break-line"></div> <!-- Break line will be inserted here -->
                <div class="user-profile">
                <a href="#" class="profile-link">
                    <?php if (!empty($imagePath)): ?>
                        <img src="<?php echo $imagePath; ?>" alt="?" class="user-image1"style="border-radius: 60%; height: 50px;">
                    <?php else: ?>
                        <i class='bx bxs-user user-icon'></i>
                    <?php endif; ?>
                    Hi, <?php echo $userName1; ?> Welcome
                </a>
                <div class="profile-info">
                    <div class="profile-menu">
                        <ul>
                            <li><a href="userpage.php">Profile Settings</a></li>
                            <li><a href="includes/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            </nav>
        </div>
<!-- /* ________________________________________________________________________________*/ -->


    </div>
<!-- /* ________________________________________________________________________________*/ -->
    <script src="js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll('.nav-upper-options ul li a');

        // Add event listener to each nav link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Add active class to the clicked link
                this.classList.add('active');
            });
        });
    });
    </script>
</body>
</html>
