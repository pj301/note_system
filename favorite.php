<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite</title>
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
<?php
include_once 'dashboard.php'; 
?>

<div id="main" class="content">
    <div class="notes-container">
    <div id="mainGeader" class="notes-header">
            <h1>
                <span class="favorites-header">Favorite Notes</span>
            </h1>

        </div>     
        <div class="notes-grid" id="notesGrid">
        <?php
            include 'includes/db_conn.php';

           
          
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; 

            $query = "SELECT * FROM tbl_notes WHERE id = '$userId' AND favorite = 1 AND archived= 0 ORDER BY n_id DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {    
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="note">' .
                        '<input type="checkbox" class="note-checkbox" data-note-id="' . $row['n_id'] . '" onchange="toggleRemoveButton(this)">' .
                        '<h3>' . $row['n_title'] . '</h3>' . 
                        '<p>' . $row['n_content'] . '</p>' . 
                        '<p class="date"> Modified Date: ' . $row['n_date'] . '</p>' .
                        '<button class="remove-button" onclick="removeSelectedNotes()">Remove</button>' .
                        '</div>'; 
                }   
            } else { 
                echo '<div class="no-notes">' .
                    '<i class="bx bx-note"></i>' . 
                    '<p>No favorite notes found.</p>' .
                    '</div>';
            }

            mysqli_close($conn);
            ?>
            
        </div>
    </div>
</div>
<script src="js/favorite.js"></script>
<script src="js/script.js"></script>
</body>
</html>
