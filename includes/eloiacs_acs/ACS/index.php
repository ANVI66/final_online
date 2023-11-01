<?php
    session_start();
    include "connection.php"; 
    $error_message = "";

    // Check if the user is already logged in and has a session
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("Location: dashboard.php");
        exit();
    }

    // Check if the "remember_user" cookie exists and is not empty
    if (isset($_COOKIE['remember_user']) && !empty($_COOKIE['remember_user'])) {
        // Decode the JSON data from the cookie
        $cookieData = json_decode(base64_decode($_COOKIE['remember_user']), true);

        // Assuming you have the user's email in the cookie
        $email = $cookieData['email'];

        // Use the email to query your database and get user details
        $query = "SELECT `name`, `status`, `place`, `position` FROM usertable WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Error in preparing the query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Now you have the user details from the cookie and the database
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $email;
            $_SESSION['status'] = $row['status'];
            $_SESSION['place'] = $row['place'];
            $_SESSION['position'] = $row['position'];
            $_SESSION['loggedin'] = true;

            // Redirect to the appropriate page based on user status
            if ($_SESSION['status'] === 'verified') {
                header("Location: dashboard.php");
                exit();
            } 
            elseif ($_SESSION['status'] === 'Notverified') {
                header("Location: otp_verify.php"); // Redirect to error page
                exit();
            } else {
                echo '<script>alert("Unknown user status. Please contact support.");</script>';
            }
        }
    }

    // Handle the login form submission here
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT id, `name`, `email`, `password`, `status`, `place`, `position` FROM usertable WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Error in preparing the query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $storedPasswordHash = $row['password'];

            // Verify the hashed password
            if (password_verify($password, $storedPasswordHash)) {
                $_SESSION['username'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['place'] = $row['place'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['loggedin'] = true;

                // Check if "Remember Me" checkbox is checked and set the persistent login cookie
                if (isset($_POST['remember_user'])) {
                    setcookie('remember_user', base64_encode(json_encode(array(
                        'username' => $row['name'],
                        'email' => $row['email'],
                        'status' => $row['status'],
                        'place' => $row['place'],
                        'position' => $row['position'],
                    ))), time() + 30 * 24 * 60 * 60, '/');
                }

                if ($_SESSION['status'] === 'verified') {
                    header("Location: dashboard.php");
                    exit();
                } elseif ($_SESSION['status'] === 'Notverified') {
                    header("Location:otp_verify.php"); // Redirect to error page
                    exit();
                } else {
                    echo '<script>alert("Unknown user status. Please contact support.");</script>';
                }
            } else {
              $error_message = 'Invalid username or password';
            }
        } else {
           $error_message = 'Invalid username or password';
        }
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap" rel="stylesheet">

</head>
<style>
   body{
    background-image: url('assets/images/ind_background.png');
background-size: 100%;
background-repeat: round;
background-attachment: fixed;
max-width: 100%;
max-height: 100%;
color:white;
}.container {
max-width: 650px;   
background: rgba(117, 110, 110, 0.05);
box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
backdrop-filter: blur(10px);
margin-top: 30px;
padding: 35px;
}.form-control,#loginPassword
{
width:541px;
height:40px;   
}::placeholder
{
color:black;
}
.password-input-container {
position: relative;
}

#loginPassword {
padding-right: 30px; /* Add space on the right for the icon */
}

.icon_eye {
position: absolute;
top: 50%;
right: 5px; /* Adjust the position of the icon as needed */
transform: translateY(-50%);
cursor: pointer;
}.typoghraphy
{    color: #0e649b;
font-family: Dr Sugiyama;
font-size: 50px;
font-style: normal;
font-weight: 400;
line-height: normal;
letter-spacing: 3px;
}.otrait
{
color: #FFF;
font-family: Dr Sugiyama;
font-size: 45px;
font-style: normal;
font-weight: 400;
line-height: normal;
letter-spacing: 2.7px;
}.form-check-label{
color: #FFF;
font-family: Quicksand;
font-size: 16px;
font-style: normal;
font-weight: 600;
line-height: normal;
letter-spacing: 0.26px;
}
.Image_logo,.ind_content{
margin-bottom: 30px;
}
.login_form
{
width:540px;
height:280px;
}
.sign_lg_in,.sign_lg_in:hover{
width: 541px;
height: 40px;
background: #0e649b;
border:none;
color: #FFF;
font-family: Quicksand;
font-size: 15px;
font-style: normal;
font-weight: 700;
line-height: normal;
letter-spacing: 1.425px;
}
.frgt_password,a{
color: #FFF !important;
font-family: Quicksand;
font-size: 16px;
font-style: normal;
font-weight: 600;
line-height: normal;
letter-spacing: 0.65px;
text-decoration:none;
padding-top:5px;
}
.register_btn, .forg_lg_sg {
display: flex;
height: 35px;
justify-content: center;
align-items: center;
margin: 10px;
}.register_btn{
color:#0e649b;
font-size:20px;
position: relative;
top: -6px;
}.form-check-input{
border-radius: 0.25em;
background-color: transparent;
border: 1px solid white;
}
   
</style>
<body>
    <div class="loading-overlay" id="loadingOverlay" style="display:none">
        <!-- You can add loading spinners or text here -->
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="container">    

    <div class="Image_logo">
        <center><img  src="assets/images/acslogo.png" alt="" style = "height: 100px;"/></center>
    </div>
    <div class="ind_content">
    <center><p class="otrait"><span class="typoghraphy">P</span>ortrait <span class="typoghraphy">L</span>ogin <span class="typoghraphy">F</span>orm </p></center>
    </div>
    <form action="" method="post">
        <!------------- login forms start----------------->
        <div class="login_form">
                    <div class="tab-content login show login_sg_reg" id="pills-login-content">            
                        <form action="#" method="post">
                    <div class="form-outline mb-4">
                        <input type="text" id="loginName" placeholder="Email" class="form-control" name="username" value="" />
                    </div>
                    <!-- Password input -->                          
                   <div class="form-outline mb-4">
                        <div class="password-input-container">
                        <input type="password" id="loginPassword" placeholder="Password" class="form-control" name="password" value="">
                        <span class="icon_eye" id="loginPasswordBtn" onclick="togglePasswordVisibility()">
                            <i class="far fa-eye" id="loginPasswordToggleIcon"></i>
                        </span>
                        </div> 
                    </div>        
                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-start">
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" name="remember_user" value="" id="loginCheck" />
                                <label class="form-check-label" for="remember_user"> Remember me </label>
                            </div>
                        </div>                      
                    </div>
                    <!-- Submit button -->
                    <center>
                        <button type="submit" class="btn btn-primary btn-block mb-4 sign_lg_in" name="signin_login">Sign in</button>
                    
                    
                    <div class="col-md-6 d-flex justify-content-center frgt_password ">
                            <a href="forget_password.php">Forgot password?</a>
                    </div>
                        
                        </center>
                    <!-- Register buttons -->
                    <div class="text-center forg_lg_sg">
                        <p class="forg_lg_sg">Don't have an account <a href="register.php"><span class="register_btn">Register Here</span></a></p>                        
                    </div>                    
        </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
        var passwordInput = document.getElementById('loginPassword');
        var toggleIcon = document.getElementById('loginPasswordToggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('far', 'fa-eye');
            toggleIcon.classList.add('fas', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fas', 'fa-eye-slash');
            toggleIcon.classList.add('far', 'fa-eye');
        }
        }
    </script>
</body>
</html>
