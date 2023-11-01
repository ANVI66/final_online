<?php
include "connection.php";

if (isset($_POST['update_Password'])) {
    $email_frgtpassword = $_POST['email'];
    $employee_id_frgtpassword = $_POST['employee_id'];
    $code = $_POST['code']; // Assuming you receive the code from the form
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if the user exists with the provided email and employee ID
    $sql_frgt = "SELECT code, status FROM usertable WHERE name = '$employee_id_frgtpassword' AND email = '$email_frgtpassword'";
    $result = mysqli_query($conn, $sql_frgt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $verificationCodeInDb = $row['code'];
        $status = $row['status'];

        if ($verificationCodeInDb === $code && $status === "Notverified") {
            // Verify that the password and confirm password match
            if ($password === $confirmPassword) {
                $status_verified = "verified";
                // Update the user's password and status in the database
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $updateQuery = "UPDATE `usertable` SET `password`='$hashedPassword', `status`='$status_verified', `code`=$code WHERE `email`='$email_frgtpassword' AND `name`='$employee_id_frgtpassword'";

                if (mysqli_query($conn, $updateQuery)) {
                    // Password updated successfully
                    $message = "Password updated successfully.";
                    // Redirect to index.php after successful update
                    echo "<script>alert('$message'); window.location.href = 'index.php';</script>";
                    exit(); // Exit to prevent further execution
                } else {
                    // Handle database error
                    $message = "Database error: " . mysqli_error($conn);
                }
            } else {
                // Passwords do not match
                $message = "Password and confirm password do not match.";
            }
        } else {
            // Invalid verification code or status
            $message = "Invalid verification code or status.";
        }
    } else {
        // Handle database error
        $message = "Database error: " . mysqli_error($conn);
    }

    // Redirect to error.php on failure
    echo "<script>alert('$message'); window.location.href = 'error.php';</script>";
    exit(); // Exit to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('assets/images/register_backgroun.png');
            background-size: 100%;
            background-repeat: round;
            background-attachment: fixed;
            max-width: 100%;
            max-height: 100%;
            color: white;
        }

        .container {
            max-width: 650px;
            max-height: max-content;
            background: rgba(117, 110, 110, 0.05);
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            padding: 35px;
            position: absolute;
            left: 30%;
            top: 15%;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent; /* Semi-transparent white background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it's on top of other content */
        }

        .spinner-border {
            width: 5rem; /* Adjust the size of the spinner as needed */
            height: 5rem; /* Adjust the size of the spinner as needed */
        }

        /* CSS to blur the background */
        body.loading {
            filter: blur(5px); /* Adjust the blur intensity as needed */
            pointer-events: none; /* Prevent interactions with the blurred background */
        }

        #resetPasswordBtn, .reset_pass {
            margin: 20px;
        }

        .alert-success {
            margin: 0px -4px -38px -4px;
            padding: 2%;
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        #resetPasswordBtn, #updatePasswordBtn {
            width: 185px;
            height: 48px;
            background-color: #fb5607;
            color: white;
            font-size: 16px;
            border: 1px solid transparent;
        }
    </style>
</head>
<body>
<div class="loading-overlay" id="loadingOverlay" style="display:none">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div class="container mt-5 forget_contain">
     <div id="message_new" class="alert" style="display: none;"></div>
    <h2 class="mb-4">Forgot Password</h2>
   
    <form id="resetPasswordForm" action="" method="post">
        <div class="form-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" class="form-control" id="employee_id" name="employee_id" value="EMP0001" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="epubeloiacsacswfo2@gmail.com" name="email" required>
        </div>
        <button type="button" class="btn btn-primary" id="resetPasswordBtn">Reset Password</button>
        <div class="new_verification mt-4" style="display: none;">
            <div class="form-group">
                <input type="text" class="form-control" id="code" name="code" placeholder="Enter the code" required>
            </div>
            <div class="form-group">
                <label></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter the password" required>
            </div>
            <div class="form-group">
                <label></label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                       placeholder="Confirm the password" required>
            </div>
            <button type="submit" class="btn reset_pass" id="updatePasswordBtn" name="update_Password">Update Password
            </button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#resetPasswordBtn").click(function () {
            var email = $("#email").val();
            var employee_id = $("#employee_id").val(); // Get the Employee ID
            showLoadingOverlay();
            $.ajax({
                type: "POST",
                url: "includes/check_email.php", // Replace with the URL where your PHP script is located
                data: {email: email, employee_id: employee_id}, // Pass both email and employee_id
                success: function (response) {
                    if (response === "success") {
                        $("#message_new").html("Verification code sent. Check your email.");
                        $("#message_new").removeClass("alert-danger").addClass("alert-success").show();
                        $(".new_verification").show(); // Show the "Verify Password" div
                        hideLoadingOverlay();
                    } else if (response === "not_exists") {
                        $("#message_new").html("Email not found in our records.");
                        $("#message_new").removeClass("alert-success").addClass("alert-danger").show();
                        $(".new_verification").hide(); // Hide the "Verify Password" div
                        hideLoadingOverlay();
                    } else {
                        $("#message_new").html("Error: " + response);
                        $("#message_new").removeClass("alert-success").addClass("alert-danger").show();
                        $(".new_verification").hide(); // Hide the "Verify Password" div
                        hideLoadingOverlay();
                    }
                },
                error: function () {
                    $("#message_new").html("Error: Could not connect to the server.");
                    $("#message_new").removeClass("alert-success").addClass("alert-danger").show();
                    $(".new_verification").hide(); // Hide the "Verify Password" div
                    hideLoadingOverlay();
                }
            });
        });
    });

    function showLoadingOverlay() {
        $("#loadingOverlay").show();
        $("body").addClass("loading");
    }

    function hideLoadingOverlay() {
        $("#loadingOverlay").hide();
        $("body").removeClass("loading");
    }
</script></body>
</html>
