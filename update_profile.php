<?php
require 'connection.php'; // Assuming this file contains your database connection code

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empcode = $_POST["empcode"]; // Assuming you have an empcode
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];

    // Handle form submission

    // Update the mobile number in the database
    $sqlMobileUpdate = "UPDATE employee_data SET MOBILE = ? WHERE CODE = ?";
    $stmtMobileUpdate = $conn->prepare($sqlMobileUpdate);
    $stmtMobileUpdate->bind_param("ss", $mobile, $empcode);

    if ($stmtMobileUpdate->execute()) {
        echo "Mobile number updated successfully";
    } else {
        echo "Error updating mobile number: " . $stmtMobileUpdate->error;
    }

    $stmtMobileUpdate->close();

    // Update the email in the usertable table
    $sqlEmailUpdate = "UPDATE usertable SET email = ? WHERE name = ?";
    $stmtEmailUpdate = $conn->prepare($sqlEmailUpdate);
    $stmtEmailUpdate->bind_param("ss", $email, $empcode);

    if ($stmtEmailUpdate->execute()) {
        echo "Email updated successfully";
    } else {
        echo "Error updating email: " . $stmtEmailUpdate->error;
    }

    $stmtEmailUpdate->close();
    $conn->close();
}
?>
