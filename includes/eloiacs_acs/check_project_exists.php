<?php
include "connection.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["projectID"])) {
    $projectID = $_POST["projectID"];

    // Check if the project ID exists in the "accounts" table
    $checkSql = "SELECT COUNT(*) as count FROM accounts WHERE projectid = '$projectID' AND accountstatus !='Completed'";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult) {
        $row = mysqli_fetch_assoc($checkResult);
        $exists = $row["count"] > 0;

        // Return the result as JSON response
        header("Content-Type: application/json");
        echo json_encode($exists);
    } else {
        // Return an error response if there's an issue with the query
        http_response_code(500);
        echo json_encode(false);
    }
} else {
    // Return an error response if projectID is not provided
    http_response_code(400);
    echo json_encode(false);
}

// Close the database connection
mysqli_close($conn);
?>
