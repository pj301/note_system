<?php
include_once 'header.php';
include 'includes/db_conn.php';

if(isset($_POST['add_note'])) {
    
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $date = date('Y-m-d'); 
    
    $insert_query = "INSERT INTO tbl_notes (id, n_title, n_content, n_date) VALUES ('$user_id', '$title', '$content', '$date')";
    
    if(mysqli_query($conn, $insert_query)) {
       
        header('Location: notebook.php');
        exit();
    }
}
} 

?> 
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notes</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/addnotes.css"> 
</head>
<body>
<div class="content">
    <h1>Add Note</h1>
    <form action="" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="69" required></textarea><br><br>
        
        <button type="submit" name="add_note">Add Note</button>
    </form>
</div>

</body>
</html> -->
