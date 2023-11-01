<?php
session_start(); // Resume the session

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/dashboard_pro.css">
    <link rel="stylesheet" href="css/stylesss.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
 
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container-box {
            position: fixed;
            top: 0;
            left: 157px;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
/*            backdrop-filter: blur(10px);*/
           
        }

        .container-box-inner {
            
            margin-right:25%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 27%;
        }
        h1
        {
            font-weight:700;
        }
        h4
        {
            text-align:right;
            font-size:15px;
            border:none;
           
           
        }
        button.btn
        {
            background-color:#FB5607;
            color:white;
            font-weight:500;
        }
        
        button.btn:hover
        {
            background-color:#ffffff;
            border:1px solid #FB5607;
            color:black;
        }
       a.fas.fa-times {
    text-decoration: none;
     color:#FB5607;
}


@media (max-width:767px){
    .container-box {
           left:45px;
           backdrop-filter: unset;
        }
        .container-box-inner {
             width: 75%;
            height: 38%;
}
h1 {
    font-size: 20px;
}
* {
    font-size: 11px;
}

}

@media (min-width:768px) and (max-width:1024px){
.container-box {
  left:0% !important;
}
.container-box-inner {
  width:50% !important;
  margin-right:0%;
}
}
    </style>
</head>
    <?php include ('includes/header.php');
?>
<body>

<!----------------------- start header section  ---------------------------------->

<!-----------------------end header section  ---------------------------------->
<div class="container1">
    <?php
    include "includes/connection.php";
    if ($user_position == "Admin" || $user_position == "General Manager") {
        ?>
<div class="container-box">
    <div class="container-box-inner">
        <h4><a href="Salary_details_payroll.php"> <i class="fas fa-times"></i></a></h4>
        <h1>ELOIACS</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="workingDays" class="form-label">Total Working Days:</label>
                <input type="number" class="form-control" id="workingDays" name="workingDays" required>
            </div>
            <input type="hidden" id="salary_date" name="salary_date" value="<?php echo date('d-m-Y'); ?>">

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</div>
<?php
// Assuming you have already established a database connection
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the working days and current date from the form submission
    $workingDays = $_POST["workingDays"];
    $salaryDate = $_POST["salary_date"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO workingdays (WORKING_DAYS, SALARY_DATE) VALUES (?, ?)");
    $stmt->bind_param("ss", $workingDays, $salaryDate);

    if ($stmt->execute()) {
        echo "Working days saved successfully!";
        echo '<script>window.location.href="Salary_details_payroll.php";</script>';
        exit;
    } else {
        echo "Error saving working days: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<?php
    } else {
        // Unauthorized user content here
        ?>
        <div class="authorization">
            <h1 class="unauth">Unauthorized</h1>
            <p><?php echo $user_position; ?></p>
            <h4 class="unauthorization">Apologies, you don't have the authorization for this action.</h4>
        </div>
        <div class="authorization_footer">
            <?php require_once "INCLUDES/footer.php"; ?>
        </div>
        <?php
    }
    ?>
    <style>
        .authorization { background-color: aliceblue; }
        .unauthorization { width: 97%; color: black; position: relative; }
        .authorization_footer { position: relative; top: 100vh; }
        .authorization {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
            height: auto; /* Adjust the height as needed */
            padding: 20px; /* Add padding to the authorization box */
        }
        .unauthorization {
            padding-top: 3%;
            text-align: center;
            /* height: 150px; Remove height to let it adjust automatically */
        }
        .unauth {
            color: red;
            text-align: center;
            padding-top: 3%;
        }
    </style>
</div>
<!-----------------------start Footer section  ---------------------------------->
<?php require_once "INCLUDES/footer.php";?>
<!-----------------------end Footer section  ---------------------------------->
</body>
</html>
