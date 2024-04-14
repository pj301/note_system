<?php
include_once 'dashboard.php'; 
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
    <style>
       #main {
    margin-top: -10px; /* Adjust the negative margin as needed */
}

/* Style for the header title */
.header-title {
    font-size: 24px;
    font-weight: bold;
    color: #333; /* Adjust color as needed */
    margin: 20px 0; /* Adjust margin as needed */
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 5px 5px 10px #bfbfbf, -5px -5px 10px #ffffff; 
}

/* Style for the left container */
.dash-left-container {
    width: calc(100% - 255px); /* Take up the remaining width after subtracting the width of the navbar and adding margin */
    background-color: #cfe6ff; /* Background color */
    float: left; /* Float left to align with the top bar */
    height: calc(100vh - 60px); /* Full height of the viewport minus header title height and top bar height */
    padding: 20px; /* Add padding for content */
    margin-right: 5px; /* Add 5px margin to the right */
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 5px 5px 10px #bfbfbf, -5px -5px 10px #ffffff; /* Neumorphism shadow effect */
}



.card-container{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 20px;
    margin-top: 20px;
}

.card-container .card {
    background-color: rgba(152, 251, 152, 5); /* Semi-transparent pastel green color */
    background-image: url('images/regular-table-bottom.png'); /* Background image */
    background-size: cover;
    background-position: center;
    padding: 50px 30px;
    height: 150px;
    text-align: center;
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 5px 5px 10px #bfbfbf, -5px -5px 10px #ffffff; 
}

.card-container .card h2{
   color: #fff;
   text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
.card-container .card p {
    color: #fff; /* White color */
    font-size: 30px; /* Adjust font size as needed */
    font-weight: bold; /* Make the number bold */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a shadow effect */
    margin-top: 5px;
}

/* Style for the welcome screen */
.welcome-screen {
    position: relative;
    width: 100%;
    height: 150px; 
    background-image: url('images/service-bg.jpg'); 
    background-size: cover;
    background-position: center;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.welcome-screen h1 {
    font-size: 24px; /* Adjust font size as needed */
    margin-bottom: 10px; /* Adjust margin as needed */
    margin:0 auto;
}

.welcome-screen p {
    font-size: 16px; /* Adjust font size as needed */
    margin:0 auto;
}

/* Style for the right container */
.dash-right-container {
    width: 250px; /* Width of the navbar */
    background-color: #cfe6ff; /* Background color */
    float: right; /* Float right to align with the top bar */
    height: calc(100vh - 60px); /* Full height of the viewport minus header title height and top bar height */
    padding: 20px; /* Add padding for content */
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 5px 5px 10px #bfbfbf, -5px -5px 10px #ffffff; /* Neumorphism shadow effect */
}

/* Clearfix to contain floated elements */
.content::after {
    content: "";
    display: table;
    clear: both;
}
    </style>
</head>
<body>
    <div id="main" class="content">
       
       <!-- Left container -->
<div class="dash-left-container">
    <!-- Header title -->
    <h1 class="header-title">My Dashboard</h1>
    <div class="welcome-screen">
        <h1>Welcome To EasyNote</h1>
        <p>Your Online Note-Taking System</p>
    </div>

   <?php
 include 'includes/db_conn.php';

// Assuming $conn is your database connection object

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// Query to count total notes for the logged-in user
$totalNotesQuery = "SELECT COUNT(*) AS total_notes_count FROM tbl_notes WHERE id = $userId";
$totalNotesResult = mysqli_query($conn, $totalNotesQuery);
$totalNotesCount = mysqli_fetch_assoc($totalNotesResult)['total_notes_count'];

// Query to count total favorite notes for the logged-in user
$totalFavoritesQuery = "SELECT COUNT(*) AS total_favorites_count FROM tbl_notes WHERE id = $userId AND favorite = 1";
$totalFavoritesResult = mysqli_query($conn, $totalFavoritesQuery);
$totalFavoritesCount = mysqli_fetch_assoc($totalFavoritesResult)['total_favorites_count'];

// Query to count total archived notes for the logged-in user
$totalArchivedQuery = "SELECT COUNT(*) AS total_archived_count FROM tbl_notes WHERE id = $userId AND archived = 1";
$totalArchivedResult = mysqli_query($conn, $totalArchivedQuery);
$totalArchivedCount = mysqli_fetch_assoc($totalArchivedResult)['total_archived_count'];
?>

    <div class="card-container">
        <div class="card">
            <h2>Total Notes</h2>
            <p><?php echo $totalNotesCount; ?></p>
        </div>
        <div class="card">
            <h2>Total Favorite</h2>
            <p><?php echo $totalFavoritesCount; ?></p>
        </div>
        <div class="card">
            <h2>Total Archived</h2>
            <p><?php echo $totalArchivedCount; ?></p>
        </div>
    </div>
</div>

        <!-- Right container -->
        <div class="dash-right-container">
            <!-- Right content goes here -->
        </div>
    </div>
    <script src="js/archived.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
