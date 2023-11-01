<?php
include "connection.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["projectID"])) {
    $projectID = $_POST["projectID"];

    // Query the "accounts" table to retrieve data for the given project ID
    $accountsQuery = "SELECT `ID`, `date`, `ourbatch`, `projectid`, `clientname`, `contactperson`, `totalpages`, `tlstatus`, `accountstatus`, `receiveddate`, `completiondate`, `cost`, `totalcost`, `received`, `pending` FROM `accounts` WHERE `projectid` = '$projectID'";
    $accountsResult = mysqli_query($conn, $accountsQuery);

    // Query the "projects" table to retrieve data for the given project ID
    $projectsQuery = "SELECT `OURBATCH`, `PROJECTID`, `CLIENTNAME`, `CONTACTPERSON`, `RECEIVEDDATE`, `RECEIVEDPAGES`, `COMPLETIONDATE`, `STATUS` FROM `projects` WHERE `PROJECTID` = '$projectID'";
    $projectsResult = mysqli_query($conn, $projectsQuery);

    if ($accountsResult && mysqli_num_rows($accountsResult) > 0) {
        // Fetch the data from the "accounts" table
        $row = mysqli_fetch_assoc($accountsResult);

        // Add an indicator that the data comes from the "accounts" table
        $row['source'] = 'accounts';

        // Return the data as JSON response
        header("Content-Type: application/json");
        echo json_encode($row);
    } elseif ($projectsResult && mysqli_num_rows($projectsResult) > 0) {
        // Fetch the data from the "projects" table
        $row = mysqli_fetch_assoc($projectsResult);

        // Add an indicator that the data comes from the "projects" table
        $row['source'] = 'projects';

        // Return the data as JSON response
        header("Content-Type: application/json");
        echo json_encode($row);
    } else {
        // Return an empty JSON response if no data is found
        echo json_encode(array());
    }
} else {
    // Return an empty JSON response if projectID is not provided
    echo json_encode(array());
}

// Close the database connection
mysqli_close($conn);
?>