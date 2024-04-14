<?php

include 'includes/db_conn.php';

// DELETION SA MG NOTE MEMEORIES NINYO
if(isset($_GET['id'])) {
    $noteId = $_GET['id'];

    $selectQuery2 = "SELECT * FROM tbl_notes WHERE n_id = $noteId";
    $selectResult2 = mysqli_query($conn, $selectQuery2);

    if(mysqli_num_rows($selectResult2) > 0) {
        $row = mysqli_fetch_assoc($selectResult2);
        

    
        if($selectResult2) {
       
        $deleteQuery2 = "DELETE FROM tbl_notes WHERE n_id = $noteId";
        $deleteResult2 = mysqli_query($conn, $deleteQuery2);

        
            if($deleteResult2) {
            
            header('LOcation: home.php');
                exit();
                                }
    
                    }
            }
    }

    // REMOVE SA FAVORITES PERO IKAW DI FAVORITE NIYA
    $selectQuery1 = "SELECT * FROM tbl_favorite WHERE f_id = $noteId";
    $selectResult1 = mysqli_query($conn, $selectQuery1);

    if(mysqli_num_rows($selectResult1) > 0) {
        $row = mysqli_fetch_assoc($selectResult1);
 

        
        if($selectResult1) {
            
            $deleteQuery1 = "DELETE FROM tbl_favorite WHERE f_id = $noteId";
            $deleteResult1 = mysqli_query($conn, $deleteQuery1);

           
            if($deleteResult1) {
                
                exit();
            }
        }
    }

    // PROCESS SA PAG UNARCHIVE SA FEELINGS

    session_start();

    if(isset($_GET['id']) && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $archiveId = $_GET['id'];
    
        include_once 'config.php';
    
        
        $selectQuery = "SELECT * FROM tbl_archive WHERE a_id = $archiveId";
        $selectResult = mysqli_query($conn, $selectQuery);
    
        if(mysqli_num_rows($selectResult) > 0) {
            $row = mysqli_fetch_assoc($selectResult);
            $a_title = mysqli_real_escape_string($conn, $row['a_title']);
            $a_content = mysqli_real_escape_string($conn, $row['a_content']);
            $a_date = $row['a_date'];
    
            
            $insertQuery = "INSERT INTO tbl_notes (id, n_title, n_content, n_date) 
                            VALUES ('$userId', '$a_title', '$a_content', '$a_date')";
            $insertResult = mysqli_query($conn, $insertQuery);
    
            if($insertResult) {

                $deleteQuery = "DELETE FROM tbl_archive WHERE a_id = $archiveId";
                $deleteResult = mysqli_query($conn, $deleteQuery);
    
                if($deleteResult) {
                    header('Location: archivepage.php');
                    exit();
                }
            }
        }
    } 
   
    

    


// CLOSE DB CONNECTION NINYONG DUHA
mysqli_close($conn);
?>
