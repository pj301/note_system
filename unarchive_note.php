<?php
session_start();

if(isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $noteId = $_GET['id'];

    include_once 'includes/db_conn.php';

    // Update the favorite attribute to 0 for the specified note
    $updateQuery = "UPDATE tbl_notes SET archived = 0 WHERE n_id = '$noteId' AND id = '$userId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if($updateResult) {
        // Note successfully removed from favorites
        header('Location: notebook.php');
        exit();
    } else {
        // Error updating favorite status
        echo "Error removing note from favorites: " . mysqli_error($conn);
    }
}

mysqli_close($conn);


?>
