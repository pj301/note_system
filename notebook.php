<?php 
include('header.php');



// Add new note functionality
include 'addnotes.php';

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
     #mainGeader {
    background-color: #cfe6ff; 
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 5px 5px 10px #bfbfbf, -5px -5px 10px #ffffff; /* Neumorphism shadow effect */
}
    </style>
</head>
<body>

<?php include 'dashboard.php'; ?>
<div id="main"  class="content">

     <div id="mainGeader" class="notes-header">
            <h1>All Notes</h1>
            <a href="#" onclick="openModal()" class="notes-icon"><i class='fas fa-plus'></i> Create Note</a>
        </div>    
        <div class="notes-grid" id="notesGrid">
        <?php
        include 'includes/db_conn.php';
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM tbl_notes WHERE id = '$user_id' AND archived = 0 ORDER BY n_id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {    
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the note is a favorite
                $favoriteClass = $row['favorite'] == 1 ? 'fas' : 'far';
                $heartColor = $row['favorite'] == 1 ? 'red' : 'black';

                echo '<div class="note"> 
                        <i class="heart-icon ' . $favoriteClass . ' fa-heart" style="color: ' . $heartColor . ';" onclick="toggleFavorite(this, ' . $row['n_id'] . ')"></i>' .
                    
                    '<div class="note-actions"> 
                    <i class="fas fa-ellipsis-h"></i>
                        <ul class="actions-dropdown">
                                <li><a href="viewnote.php?id=' . $row['n_id'] . '">View Note</a></li>  
                            
                            <li><a href="archive.php?id=' . $row['n_id'] . '" class="delete-note">Delete Note</a></li> 
                        </ul>
                    </div>' .  
                    '<h3>' . $row['n_title'] . '</h3>' . 
                    '<p>' . $row['n_content'] . '</p>' . 
                    '<p class="date"> Modified Date: ' . $row['n_date'] . '</p>' . 
                    '</div>'; 
            }   
        } else { 
            echo '<div class="no-notes">' .
                '<i class="bx bx-note"></i>' . 
                '<p>No notes found.</p>' .
                '</div>';
        }
        mysqli_close($conn);
        ?>


        </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Add Note</h2>
        <!-- Your form content goes here -->
        <form action="addnotes.php" method="POST">
            <div class="form-group">
                <label for="title" class="form-control">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required><br><br>
            </div>
            <div class="form-group">
                <label for="content" class="form-control">Content:</label><br>
                <textarea id="content" name="content" class="form-control form-control-textarea" rows="4" cols="50" required></textarea><br><br>
            </div>
            <div class="btn-container">
                <input type="submit" name="add_note" value="Add Note" class="btn-submit">
            </div>
        </form>
    </div>
</div>

<script src="js/script.js"></script>

</body>
</html>