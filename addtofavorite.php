<?php
session_start();
include_once 'includes/db_conn.php';

if(isset($_GET['id']) && isset($_GET['favorite'])) {
    // Sanitize the input
    $noteId = mysqli_real_escape_string($conn, $_GET['id']);
    $favorite = mysqli_real_escape_string($conn, $_GET['favorite']);

    // Check if the user is logged in
    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Update the favorite status in the database
        $updateQuery = "UPDATE tbl_notes SET favorite = '$favorite' WHERE n_id = '$noteId' AND id = '$userId'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if($updateResult) {
            // Return a success response
            http_response_code(200);
            echo "Favorite status updated successfully";
            exit();
        } else {
            // Return an error response
            http_response_code(500);
            echo "Error updating favorite status: " . mysqli_error($conn);
            exit();
        }
    } else {
        // User is not logged in
        http_response_code(401);
        echo "Unauthorized access";
        exit();
    }
} else {
    // Invalid request parameters
    http_response_code(400);
    echo "Invalid request parameters";
    exit();
}

mysqli_close($conn);
?>
