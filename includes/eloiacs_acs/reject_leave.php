<?php
// Include your database connection script
include "connection.php";

if (isset($_GET['id'])) {
    $empId = $_GET['id'];
    
    // Fetch data for email notification
    $sql_reject_email = "SELECT `EMPLOYEE_NAME`, `EMAIL_EMP` FROM `time_off_tracking` WHERE ID = ?";
    $stmt = $conn->prepare($sql_reject_email);
    $stmt->bind_param("i", $empId);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $employeeName = $row['EMPLOYEE_NAME'];
            $sentmail = $row['EMAIL_EMP'];

            // Create the email headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: mail.eloiacs@gmail.com' . "\r\n";

            // Create the email content
            $subject = 'Leave Request Rejected';
            $message = 'Hi ' . $employeeName . ',<br>Regrettably, your leave request has been declined by HR.An email notification has been sent to inform you.';

            // Send the email using the mail() function
            if (mail($sentmail, $subject, $message, $headers)) {
                // Update the status to "Rejected"
                $newStatus = "Rejected";
                $sql_update_status = "UPDATE time_off_tracking SET STATUS_LEAVE = ? WHERE ID = ?";
                $stmt_update_status = $conn->prepare($sql_update_status);
                $stmt_update_status->bind_param("si", $newStatus, $empId);
                
                if ($stmt_update_status->execute()) {
                    // Leave request rejected successfully
                    echo "<script>
                            alert('Leave request declined successfully! Email sent to $sentmail.');
                            window.history.back(); // Go back to the previous page
                          </script>";
                } else {
                    // Error occurred while rejecting the leave request
                    echo "<script>
                            alert('Error: Leave request rejection failed.');
                            window.history.back(); // Go back to the previous page
                          </script>";
                }

                $stmt_update_status->close();
            } else {
                // Error sending email
                echo "<script>
                        alert('Error: Email could not be sent.');
                        window.history.back(); // Go back to the previous page
                      </script>";
            }
        } else {
            // No data found for email notification
            echo "<script>
                    alert('Error: No data found for email notification.');
                    window.history.back(); // Go back to the previous page
                  </script>";
        }
    } else {
        // SQL query execution failed
        echo "<script>
                alert('Error: SQL query execution failed.');
                window.history.back(); // Go back to the previous page
              </script>";
    }

    $stmt->close();
} else {
    // Invalid request
    echo "<script>
            alert('Error: Invalid request.');
            window.history.back(); // Go back to the previous page
          </script>";
}
?>
