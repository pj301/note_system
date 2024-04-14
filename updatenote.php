<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'includes/db_conn.php';
        
        // Sanitize inputs to prevent SQL injection
        $note_id = mysqli_real_escape_string($conn, $_POST['note_id']);
        $note_title = mysqli_real_escape_string($conn, $_POST['title']);
        $note_content = mysqli_real_escape_string($conn, $_POST['content']);
        
        $note_date = date("Y-m-d");
    
        // Construct the update query
        $query = "UPDATE tbl_notes SET n_title='$note_title', n_content='$note_content', n_date='$note_date' WHERE n_id=$note_id";
        
        // Execute the update query
        $result = mysqli_query($conn, $query);
    
        // Check if the update was successful
        if ($result) {
            // Redirect to viewnote.php with the updated note ID
            header("location:viewnote.php?id=$note_id");
            exit;
        } else {
            // Handle errors
            echo "Error updating note: " . mysqli_error($conn);
        }
    
        // Close database connection
        mysqli_close($conn);
    }
    ?>
    
