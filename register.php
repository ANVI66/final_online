<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/ind.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap" rel="stylesheet">
</head>
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
        height: 685px;    
        background: rgba(117, 110, 110, 0.05);
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(10px);
        margin-top: 100px;
        padding: 35px;
    }
    
.icon_eye {
    position: absolute;
    top: 50%;
    right: 53px;
    transform: translateY(-50%);
    cursor: pointer;
    color: black;
    z-index: 1;
    opacity: 0.5;
}

#registerRepeatPassword {
    padding-right: 30px; /* Add space on the right for the icon */
}

/* CSS for loading overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it's on top of other content */
}

.spinner-border {
width: 8rem;
height: 8rem;
position: absolute;
top: 200px;
left: 250px;
}

.text-primary {
color:#fb5607 !important;
display: inline-block;
width: 8rem;
height: 8rem;
vertical-align: -0.125em;
border: 0.25em solid currentColor;
border-right-color: transparent;
border-radius: 50%;
-webkit-animation: .75s linear infinite spinner-border;
animation: .75s linear infinite spinner-border;
}

/* CSS to blur the background */
body.loading {
    filter: blur(5px); /* Adjust the blur intensity as needed */
    pointer-events: none; /* Prevent interactions with the blurred background */
}
.message
{
  background-color:green;
  color:White;
  font-size:20px;
}.loading-overlay
{
  display:none;
}.sign_lg_in_border
{
  width: 185px;
height: 48px;
background-color:#fb5607;
color:White;
font-size:16px;
border:1px solid transparent;
}
.register_btn, .forg_lg_sg {
display: flex;
height: 35px;
justify-content: center;
align-items: center;
margin: 10px;
}.register_btn{
color:#fb5607;
font-size:20px;
position: relative;
top: -6px;
}.frgt_password,a{
color: #FFF !important;
font-family: Quicksand;
font-size: 16px;
font-style: normal;
font-weight: 600;
line-height: normal;
letter-spacing: 0.65px;
text-decoration:none;
padding-top:15px;
}.hidden
{
    display:none;
}

</style>
<body>
<body>


<!--                     registeration page                          -->
<div class="container">
      <!-- Loading Overlay -->
      
  <form action="controller.php" method="post">
          <div class="form-outline mb-4 registerpg">
            <label class="form-label" for="registerName">Employee ID</label>
            <input type="text" id="registerName" placeholder="Employee ID" class="form-control" value="" name="name" required/>
          </div>
          <div class="form-outline mb-4 registerpg" hidden>
            <label class="form-label" for="registerEmail">Place</label>
            <input class="form-select" id="department" name="department"  value="Eloiacs" > 
          </div>
          <div class="form-outline mb-4 hidden">
            <label class="form-label" for="registerEmail">Position</label>
            <input type="text" id="position" class="form-control hidden" name="position" value="Employee" readonly required />
          </div>
          <div class="form-outline mb-4 registerpg">
            <label class="form-label" for="registerEmail">Email</label>
            <input type="email" id="registerEmail" placeholder="Email" class="form-control" value="" name="email" required/>
          </div>
          <div class="form-outline mb-4 registerpg" >
            <label class="form-label" for="registerPassword">Password</label>
            <input type="password" id="registerPassword" placeholder="Password" name="password"  value="" class="form-control" required/>
          </div>
          <div class="form-outline mb-4">          
            <label class=" form-label" for="registerRepeatPassword">Confirm password</label>
          <div class="password-input-container">
            <input type="password" id="registerRepeatPassword" placeholder="Confirm Password" name="cpassword" value="" class="form-control" required/>
            <span class="icon_eye" id="loginPasswordBtn" onclick="togglePasswordVisibility()">                            
                            <i class="far fa-eye" id="cpasswordToggleIcon"></i>
            </span>            
          </div>
</div>
    

          <div class="form-check d-flex justify-content-center mb-4">
            <input class="form-check-input me-2" type="checkbox" checked value="" id="registerCheck" aria-describedby="registerCheckHelpText" required/>
            <label class="form-check-label" for="registerCheck">
              I have read and agree to the terms
            </label>
          </div>
          <div class="form-outline mb-4">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Enter OTP" id="otpInput" aria-label="Recipient's OTP" aria-describedby="button-addon2" name="otp" style="display: none;">        
            </div>
          <div id="message"></div> <!-- To display messages to the user -->
          </div>
          
          <center>
          <button class="btn btn-outline-primary sign_lg_in_border" type="button" id="getOTP" name="signup"> GET OTP</button>
          <button class="btn btn-outline-primary sign_lg_in_border" type="submit" id="verifyOTP" style="display: none;" name="check">VERIFY OTP</button>
          </center>
          </form>
          <div class="text-center forg_lg_sg">
                        <p class="forg_lg_sg">Already have an account <a href="index.php"><span class="register_btn">Sign in</span></a></p>                        
                    </div>    
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
</body>
    <script src="js/index_register.js"></script>

</html>
