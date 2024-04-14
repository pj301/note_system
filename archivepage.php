
<?php
include_once 'dashboard.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived</title>
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
<div id="main" class="content">
    <div class="notes-container">
    <div id="mainGeader" class="notes-header">
            <h1>
                <span class="favorites-header">Archived Notes</span>
                <button class="remove-button" onclick="removeSelectedNotes()">Remove</button>
            </h1>
            <input type="text" class="search-bar" id="searchBar" placeholder="Search...">
            
            <button class="remove-all-button" onclick="deleteAllNotes()">Delete All Notes</button>
        </div>    
    
        <div class="notes-grid" id="notesGrid">
            <?php
            include_once 'includes/db_conn.php';

            if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];

                $query = "SELECT n_id, n_title, n_content, n_date
                          FROM tbl_notes
                          WHERE id = '$userId' AND archived = 1
                          ORDER BY n_id DESC"; 
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="note">' .
                            '<input type="checkbox" class="note-checkbox" onclick="toggleRemoveButton(this)">' .
                            '<h3>' . $row['n_title'] . '</h3>' . 
                            '<p>' . $row['n_content'] . '</p>' . 
                            '<p class="date"> Archived Date: ' . $row['n_date'] . '</p>' . 
                            '<button class="remove-button" onclick="removeNote(' . $row['n_id'] . ')">Unarchive</button>' .
                            '</div>'; 
                    }   
                } else { 
                    echo '<div class="no-notes">' .
                        '<i class="bx bx-note"></i>' . 
                        '<p>No archived notes found.</p>' .
                        '</div>';
                }
            } else {
                echo '<p>Please login to view archived notes.</p>';
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>

<script src="js/archived.js"></script>
<script src="js/script.js"></script>
</body>
</html>
