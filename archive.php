<?php

session_start();

include 'includes/db_conn.php';

if(isset($_GET['id'])) {
    $noteId = $_GET['id'];

    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Update the archive attribute to 1 for the specified note
        $archiveQuery = "UPDATE tbl_notes SET archived = 1 WHERE n_id = '$noteId' AND id = '$userId'";
        $archiveResult = mysqli_query($conn, $archiveQuery);

        if($archiveResult) {
            // Note successfully archived
            header('Location: notebook.php');
            exit();
        } else {
            // Error updating archive status
            echo "Error archiving note: " . mysqli_error($conn);
        }
    }
}
   

mysqli_close($conn);
?>
