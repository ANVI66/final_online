<?php
session_start(); 
include "includes/conn.php";


        if (isset($_GET["code"])) {
            $id = $_GET["code"];
            
            // Perform the deletion query
            $updateQuery = "UPDATE `employee_data` SET `DELSTATUS` = '2' WHERE CODE = '$id'";
    
            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                // Deletion successful
               echo '<script>alert("Deleted Succesfully.");</script>';
                echo '<script>window.history.back();</script>'; // Redirect back to the previous page
            } else {
                // Deletion failed
                echo "Failed to delete the record.";
            }
        } else {
            echo "ID not provided.";
        }
        


mysqli_close($conn);
?>
