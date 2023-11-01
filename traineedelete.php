<?php
session_start();
include 'includes/conn.php';

if (isset($_GET['deletekey'])) {
    $delete = $_GET['deletekey'];


    // Make sure to use backticks for table and column names, not single quotes
    $updatequery = "UPDATE `employee_data` SET `DELSTATUS` = '2' WHERE `CODE`='$delete'";

    $output = mysqli_query($conn, $updatequery);

    if ($output) {
        // Display a success message using JavaScript alert
        echo "<script>alert('Deleted successfully')</script>";
        echo "<script>window.history.back();</script>";
    } else {
        echo "Deletion failed: " . mysqli_error($conn);
    }
}

?>



