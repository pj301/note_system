<?php

include_once 'includes/db_conn.php';

// Check if there are any archived notes
$checkQuery = "SELECT * FROM tbl_notes WHERE archived = 1";
$checkResult = mysqli_query($conn, $checkQuery);

if(mysqli_num_rows($checkResult) > 0) {
    // If there are archived notes, proceed with deletion
    $deleteQuery = "DELETE FROM tbl_notes WHERE archived = 1";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if($deleteResult) {
        // Redirect to the home page after deleting all archived notes
        header('Location: archivepage.php');
        exit();
    } else {
        // Handle any errors that occur during the deletion process
        echo "Error deleting archived notes: " . mysqli_error($conn);
    }
} else {
    // If there are no archived notes, display a message or handle accordingly
    echo "No archived notes found to delete.";
}

// CLOSE DB CONNECTION 
mysqli_close($conn);
?>
