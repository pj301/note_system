<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Note</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/viewnote.css"> 
</head>
<body>
<?php

include 'dashboard.php';

include 'includes/db_conn.php';

if(isset($_GET['id'])) {
    $note_id = $_GET['id'];
    
    
            $query = "SELECT * FROM tbl_notes WHERE n_id = $note_id";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
        ?>
            <div class="note-container">
                <h2><?php echo $row['n_title']; ?></h2>
                <p><?php echo $row['n_content']; ?></p>
                
                <a href="editnote.php?id=<?php echo $row['n_id']; ?>" class="edit-button">Edit Note</a>
            </div>
        <?php
            } else {
                echo "<p>Note not found.</p>";
            }

            mysqli_close($conn);
        } else {
            echo "<p>Note ID not provided.</p>";
        }
        ?>
</body>
</html>
