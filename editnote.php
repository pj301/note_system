
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/editnote.css"> 
  
</head>
<body>
<?php

include 'includes/db_conn.php';
include_once 'dashboard.php'; 

if(isset($_GET['id'])) {
    $note_id = $_GET['id'];
    
    
    $query = "SELECT * FROM tbl_notes WHERE n_id = $note_id";
   
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $note_title = $row['n_title'];
        $note_content = $row['n_content'];
        
        $note_date = date("Y-m-d");
    } else {
        echo "Note not found!";
    }
} else {
    echo "Note ID not provided!";
}
?>


<div class="note-edit-form">
    <form action="updatenote.php" method="POST">
        <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $note_title; ?>"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"><?php echo $note_content; ?></textarea><br>      
        
        <input type="submit" value="Update Note">
    </form>
</div>

<?php mysqli_close($conn); ?>

</body>
</html>
