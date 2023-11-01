<?php
include "connection.php"; // Include your database connection code

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['employeeId'])) {
        $employeeId = $_POST['employeeId'];

        // Create an SQL query to delete the employee
        $deleteSql = "DELETE FROM employee_data WHERE ID = $employeeId";

        // Execute the query
        if ($conn->query($deleteSql) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'Missing employeeId.';
    }
} else {
    echo 'Invalid request.';
}
?>
