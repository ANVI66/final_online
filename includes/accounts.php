<?php
include "INCLUDES/login_access.php";
?>















<?php
include "connection.php"; // Include the database connection file

if (isset($_POST['submit'])) {
    // Get current date
    $currentDate = date("Y-m-d");

    // Retrieve form data
    $ourBatch = $_POST["ourbatch"] ?? '';
    $projectID = $_POST["projectid"] ?? '';
    $clientName = $_POST["vendor"] ?? '';
    $contactPerson = $_POST["contactPerson"] ?? '';
    $tlStatus = $_POST["tlstatus"] ?? '';
    $accountStatus = $_POST["accountstatus"] ?? '';
    $receivedDate = $_POST["receivedDate"] ?? '';
    $cost = $_POST["cost"] ?? '';
    $totalPages = $_POST["totalPages"] ?? '';
    $completionDate = $_POST["completionDate"] ?? '';
    $totalCost = $_POST["totalCost"] ?? '';
    $received = $_POST["received"] ?? '';
    $pending = $_POST["pending"] ?? '';

    // Check if a record with the same ourBatch and projectID exists
    $checkSql = "SELECT * FROM accounts WHERE ourBatch = '$ourBatch' AND projectID = '$projectID'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // If the record exists, update it
        $updateSql = "UPDATE accounts SET 
            date = '$currentDate', 
            clientName = '$clientName', 
            contactPerson = '$contactPerson', 
            tlStatus = '$tlStatus', 
            accountStatus = '$accountStatus', 
            receivedDate = '$receivedDate', 
            cost = '$cost', 
            totalPages = '$totalPages', 
            completionDate = '$completionDate', 
            totalCost = '$totalCost', 
            received = '$received', 
            pending = '$pending' 
            WHERE ourBatch = '$ourBatch' AND projectID = '$projectID'";

        if (mysqli_query($conn, $updateSql)) {
            echo "<script>alert('Record Updated Successfully.');</script>";
        } else {
            echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // If the record does not exist, insert it
        $insertSql = "INSERT INTO accounts (date, ourBatch, projectID, clientName, contactPerson, tlStatus, accountStatus, receivedDate, cost, totalPages, completionDate, totalCost, received, pending) 
            VALUES ('$currentDate', '$ourBatch', '$projectID', '$clientName', '$contactPerson', '$tlStatus', '$accountStatus', '$receivedDate', '$cost', '$totalPages', '$completionDate', '$totalCost', '$received', '$pending')";

        if (mysqli_query($conn, $insertSql)) {
            echo "<script>alert('Record inserted successfully.');</script>";
        } else {
            echo "<script>alert('Error inserting record: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Close the database connection
mysqli_close($conn);
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
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/stylesss.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

    <style>
        /* Add this CSS in a separate .css file or within a <style> tag in your HTML document */

        body {
            font-family: Arial, sans-serif;
        margin: 20px;
         /* Prevent scrolling */
        }

        h3 {
            text-align: center;
            color: #ff5e00;
            margin-left: 18rem;
            margin-bottom: 20px;
            font-weight: bold;
            margin-top:10px;
            width:10rem;
        }
        h2{
            margin-top:10%;
    text-align: center;
    color: #ff5e00;
    font-weight:bold;       
    /* margin-left: -7rem; */
    margin-bottom: 20px;
}
        form {
            width: 60%;
            height:max-content;
    margin: 0 auto;
    background-color: #f5f5f5;
    padding: 10px; /* Adjust padding to reduce height */
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: -10px -10px 30px 4px rgba(0,0,0,0.1), 10px 10px 30px 4px rgba(45,78,255,0.15);

    margin-bottom: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
        }

        label {
            display: block;
    font-weight: bold;
    margin-bottom: 3px; /* Adjust margin to reduce height */
    margin-top: 3px;
        }

        input[type="text"],
input[type="date"],
input[type="number"],
select {
    width: calc(100% - 22px);
    padding: 3px;
    margin-top: 3px;
    margin-bottom: 3px;
    border: 1px solid orange; /* Change border color to orange */
    border-radius: 4px;
    box-sizing: border-box;
}

        input[type="checkbox"] {
            margin-left: 5px;
        }

        input[type="submit"] {
    margin-top: -13px;
    margin-left: 44%;
    background-color: #ffa809;
    color: #fff;
    border: none;
    padding: 4px 9px;
    cursor: pointer;
    border-radius: 4px;
    font-weight: bold;
}

        input[type="submit"]:hover {
            background: linear-gradient(180deg, #FC7105 0%, #FFA500 100%);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .hidden-row {
            display: none;
        }

        .col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0px 50px;
}

table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
   
    height: 200px;
    overflow-y: auto;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px;
    border-radius: 10px; 
    overflow: hidden;
}

        table,
        th,
        td {
            border-bottom: 1px solid #ccc;
        }


        /* Add this CSS code to change the background color on hover */
table tr:hover td {
    background-color: #ccc; /* Change this to your desired grey color */
}



 
        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: linear-gradient(180deg, #FC7105 0%, #FFA500 100%);
        }

        .add-button {
            background: linear-gradient(180deg, #FC7105 0%, #FFA500 100%);
    color: #fff;
    border: none;
    padding: 2px 15px;
    cursor: pointer;
    border-radius: 4px;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .add-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        #closeButton {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            width: 2%;
            z-index: 999;
            margin-left:20%;
        }

        th {
            background-color: orange;
            color: white;
            text-align:center;
            text-transform:uppercase;
        }
        

        select#accountstatus {
            width: calc(100% - 22px);
    padding: 03px;
    margin-bottom: 5px;
    border: 1px solid orange; /* Change border color to orange */
    border-radius: 4px;
    box-sizing: border-box;
        }

        /* Add the blur effect to the table when form is displayed */
        .blurred-table {
            filter: blur(5px); /* Adjust the blur amount as needed */
    background-color: rgba(255, 255, 255, 0.1); /* Transparent white background for the blurred effect */
    padding: 20px;
    border-collapse: collapse;
        }

        /* Overlay to cover the blurred table */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 998;
        }
        .cross {
   
    margin-left: 95%;
    margin-top:60px;
}


button.cross {
    font-size: 10px;
    margin-top: 15px;
    margin-left: 280px; 
    background-color: #f5f5f5;
    border: none;
}
.fa-close{
font-weight:normal;
font-size: 20px;
color: #FC7105;
}
    </style>
</head>

<body>


<header  style="" class="navbar_header_fix">
    <nav class="navbar" style="background-color: #e3f2fd;">
        <button class="navbar-toggler-icon navbar-toggler icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" style="color: black;" ><i class="fa-solid fa-bars menu_icon"></i></button>
         <div class="container">
                <div class="company_name">
                    <a class="navbar-brand" href="#">
                        <img src="ASSETS/IMAGES/logo.png" alt="Bootstrap" width="100%" height="75px">                
                    </a>
                </div>
            <ul class="nav nav-tabs">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">ABOUT</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">CONTACT</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link active " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-current="page" href="#">PROFILE</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">ADMIN</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">LOGIN</a></li>
                        </ul>
                    </li>
                    <div class="icon_pro_bell">    
  
                    <li class="nav-item dropdown ">
                        <a class="nav-link active mg_left" data-bs-toggle="dropdown" role="button" aria-expanded="false" aria-current="page" href="#"><i class="fa-regular fa-bell O "></i></a>
                        <ul class="dropdown-menu Profile_dropdown notification_bar">
                        
                            <li class="notification_content"><div class="" id="notificationContent">
                            <hr class="dropdown-divider">
             Notification content goes here.
            You have a new notification!
            <hr class="dropdown-divider">
        </div></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><center><a class="dropdown-item btn_showall" type="button" href="">Show All</a></center></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                    <a class="nav-link active mg_left" data-bs-toggle="dropdown" role="button" aria-expanded="false" aria-current="page" href="#"><i class="far fa-user O"></i></a>
                        <ul class="dropdown-menu Profile_dropdown">
                            <li><a class="dropdown-item" href="#">Profile Details</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="INCLUDES/logout.php">Sign out</a></li>
                        </ul>
                    </li>
                    </div>
                </div>
            </ul>
        </div>
        </header>
    </nav>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"                    aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo $employeeName; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="color: black;">
                            </button>
                </div>
 <div class="offcanvas-body">
 <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
 <li class="nav-item">
 <li><hr class="dropdown-divider"></li>
 <a class="nav-link active" aria-current="page" href="dashboard.php">DASHBOARD</a>
 <li><hr class="dropdown-divider"></li>
 </li>


 
 <li class="nav-item dropdown">
 <?php if ($user_position == "Project Manager" || $user_position == "General Manager" ){?> 
    <a class="nav-link active" aria-current="page" href="employee list.php">EMPLOYEE</a>
 <?php } else{ ?>
    <ul class="dropdown-menu dropdown-menu-dark">
    <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
    </ul>
<?php }?>

 </li>

 
 <li><hr class="dropdown-divider"></li>
 <li class="nav-item dropdown">
 <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 TIME OFF
 </a>
 <ul class="dropdown-menu dropdown-menu-dark">
 <?php if($user_position == "General Manager" || $user_position == "Human Resource Manager" || $user_position == "Admin") {?>
 <li><a class="dropdown-item" href="timetracking.php">Requested Timeoff / My Report </a></li>
 <li>
 <hr class="dropdown-divider">
 </li>
 <li><a class="dropdown-item" href="#">Calendar</a></li> 
 <?php }else { ?> 
 <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
<?php } ?> 
 </ul>
 <li><hr class="dropdown-divider"></li>


 


 <li><hr class="dropdown-divider"></li>
 <li class="nav-item dropdown">
 <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 EMPLOYEE'S LIST
 </a> 
 <ul class="dropdown-menu dropdown-menu-dark">
<?php if($user_position == "Human Resource Manager" || $user_position == "Admin") {?>
 <li><a class="dropdown-item" href="#">EMPLOYEE</a></li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="#">TRAINEE</a></li>
 <?php } else { ?>
  
     <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
 <?php }?>



 </ul>

 <li><hr class="dropdown-divider"></li>
 </li>
 <li><hr class="dropdown-divider"></li>
 <li class="nav-item dropdown">
 <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 SALARY
 </a>
 <ul class="dropdown-menu dropdown-menu-dark">
 <?php if($user_position == "General Manager" || $user_position == "Human Resource Manager") {?>
 <li><a class="dropdown-item" href="#">EMPLOYEE</a></li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="#">TRAINEE</a></li>
 <?php }else { ?>
 <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
<?php } ?>
 </ul>
 <li><hr class="dropdown-divider"></li>
 </li>



 <li><hr class="dropdown-divider"></li>
 <li class="nav-item dropdown">
 <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 PAYSLIP
 </a>
 <ul class="dropdown-menu dropdown-menu-dark">
 <?php if($user_position == "General Manager" || $user_position == "Human Resource Manager" || $user_position == "Admin") {?>
 <li><a class="dropdown-item" href="#">EMPLOYEE</a></li>
 <li>
 <hr class="dropdown-divider">
 </li>
 <li><a class="dropdown-item" href="#">TRAINEE</a></li> 
 <?php }else { ?> 
 <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
<?php } ?> 
 </ul>
 <li><hr class="dropdown-divider"></li>
 <li><hr class="dropdown-divider"></li>





 <li class="nav-item dropdown">
 <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">WORK ASSIGN </a>
 <ul class="dropdown-menu dropdown-menu-dark">
 <?php if (($user_position == "Employee" && $EMP_TEAMLEADER == "YES") || $user_position == "Project Manager") { ?>
 <li><a class="dropdown-item" href="#">Assign</a></li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="#">View</a></li>
 <li><hr class="dropdown-divider"></li>
 <?php } else { ?>
 <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
 <?php } ?>
</ul>
 </li>
 <li><hr class="dropdown-divider"></li>
 <li><hr class="dropdown-divider"></li>
 <li class="nav-item dropdown">
 <a class="nav-link " href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">PROJECTS</a>
 <ul class="dropdown-menu dropdown-menu-dark">
 <?php if ($user_position == "Project Manager" || $user_position == "General Manager" ) {?>
 <li><a class="dropdown-item" href="project.php">PROJECTS</a></li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="project assign.php">VIEW DETAILS</a></li>
 <li><hr class="dropdown-divider"></li>
 <?php } else { ?>
 <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
 <?php } ?>
</ul>
 </li>

 <li><hr class="dropdown-divider"></li>
 <?php if ($user_position == "Project Manager" || $user_position == "General Manager" ) {?> 
 <li><hr class="dropdown-divider"></li>
 <li class="nav-item">

 <a class="nav-link active" aria-current="page" href="report.php">REPORT</a>
 </li>
 <li><hr class="dropdown-divider"></li>
 <?php } ?>



  
 <li class="nav-item dropdown">
 <?php if ($user_position == "Project Manager" || $user_position == "General Manager" ){?> 
    <a class="nav-link active" aria-current="page" href="accounts.php">ACCOUNTS</a>
 <?php } else{ ?>
    <ul class="dropdown-menu dropdown-menu-dark">
    <li><p class="dropdown-item">Authorization Blocked by Admin</p></li>
    </ul>
<?php }?>

 </li>
 
 </ul>
 </div>
 </div>
</div>
</nav>











    <h2>ACCOUNTS</h2>
    <!-- <p>Current Date: <php echo date("Y-m-d"); ?></p> -->
    <p><i class="fa fa-calendar" style="color:orange; margin-left:10px; font-weight:bold;"></i>&nbsp;Current Date: <?php echo date("Y-m-d"); ?></p>


    <table border="1">
        <tr>
            <th>Our Batch</th>
            <th>projectid</th>
            <th>Title</th>
            <th>Client Name</th>
            <th>Contact Person</th>
            <!-- <th>COST</th> -->

            <th>Total Pages</th>
            <th hidden>Status</th>
            <th>Action</th>
        </tr>

        <?php
        include "connection.php"; // Add a semicolon here
        $sql = "SELECT WORKTITLE, RECEIVEDDATE, OURBATCH, PROJECTID, CLIENTNAME, CONTACTPERSON, RECEIVEDPAGES, COMPLETIONDATE, STATUS, TL_STATUS FROM projects WHERE STATUS = 'COMPLETED'";

        $result = mysqli_query($conn, $sql);

        // Loop through the query result and generate table rows
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['OURBATCH'] . "</td>";
                echo "<td>" . $row['PROJECTID'] . "</td>";
                echo "<td>" . $row['WORKTITLE'] . "</td>";
                echo "<td>" . $row['CLIENTNAME'] . "</td>";
                echo "<td>" . $row['CONTACTPERSON'] . "</td>";
                echo "<td>" . $row['RECEIVEDPAGES'] . "</td>";
                echo "<td hidden>" . $row['STATUS'] . "</td>";
           
                
                // echo "<td><button type='button' class='add-button' data-projectid='" . $row['PROJECTID'] . "' data-clientname='" . $row['CLIENTNAME'] . "' data-contactperson='" . $row['CONTACTPERSON'] . "' data-receivedpages='" . $row['RECEIVEDPAGES'] . "' data-ourbatch='" . $row['OURBATCH'] . "' data-tlstatus='" . $row['STATUS'] . "' data-receiveddate='" . $row['RECEIVEDDATE'] . "' data-completiondate='" . $row['COMPLETIONDATE'] .      "' data-tlstatus='" . $row['TL_STATUS'] . "'>Add</button></td>";

                
                echo "<td style=\"text-align:center;\"><button type='button' class='add-button' data-projectid='" . $row['PROJECTID'] . "' data-clientname='" . $row['CLIENTNAME'] . "' data-contactperson='" . $row['CONTACTPERSON'] . "' data-receivedpages='" . $row['RECEIVEDPAGES'] . "' data-ourbatch='" . $row['OURBATCH'] . "' data-tlstatus='" . $row['TL_STATUS'] . "' data-receiveddate='" . $row['RECEIVEDDATE'] . "' data-completiondate='" . $row['COMPLETIONDATE'] . "'>ADD</button></td>";

               
 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </table>
    <div class="overlay" id="overlay" style="display: none;"></div>
    <form action="" method="post" id="accountsForm" style="display: none;">
    <div class="row">
        <div class="col">
        <h3>ADD COST</h3>
        </div>
        <div class="col">
        <button class="cross" ><i class="fa fa-close" ></i></button>
        </div>
    </div>



       
        <div class="row">
            <div class="col-md-6">
                <label for="vendor">Vendor:</label>
                <input type="text" id="vendor" name="vendor" readonly>
            </div>

            <div class="col-md-6">
                <label for="ourbatch">OurBatch:</label>
                <input type="text" id="ourbatch" name="ourbatch" value="<?php echo $ourBatch; ?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="projectid">Projectid:</label>
                <input type="text" id="projectid" name="projectid" readonly>
            </div>

            <div class="col-md-6">
                <label for="receivedDate">Received Date:</label>
                <input type="date" id="receivedDate" name="receivedDate" readonly>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <label for="accountstatus">Accounts Status:</label>
                <select id="accountstatus" name="accountstatus">
                    <option value="HOLD"></option>
                    <option value="HOLD">Hold</option>
                    <option value="PENDING">Pending</option>
                    <option value="PROCESS">Process</option>
                    <option value="CLOSED">completed</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tlstatus"> TL Status:</label>
                <input type="text" id="tlstatus" name="tlstatus" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="cost">Cost:</label>
                <input type="text" id="cost" name="cost" value="<?php echo $cost; ?>" >
            </div>  
            <div class="col-md-6">
                <label for="totalPages">Total Pages:</label>
                <input type="number" id="totalPages" name="totalPages" ><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="contactPerson">Contact Person:</label>
                <input type="text" id="contactPerson" name="contactPerson" readonly>
            </div>
            <div class="col-md-6">
                <label for="completionDate">Completion Date:</label>
                <input type="date" id="completionDate" name="completionDate" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="totalCost">Total Cost:</label>
                <input type="text" id="totalCost" name="totalCost" value="<?php echo $totalCost; ?>">
            </div>
            <div class="col-md-6">
                <label for="received">Received:</label>
                <input type="text" id="received" name="received" value="<?php echo $received; ?>">
            </div>
        </div>

        <div class="row">
        <div class="col-md-6">
            <label for="pending">Pending:</label>
            <input type="text" id="pending" name="pending" value="<?php echo $pending; ?>"><br><br>
        </div></div>

        <input type="submit" name="submit" value="Submit" style="margin-bottom: 10px;">
        <div style="position: absolute; top: 10px; right: 10px;">
            <img src="CLOSING.png" alt="Close" id="closeButton" style="cursor: pointer;" onclick="closeForm()">
        </div>
    </form>
    <script>
        function closeForm() {
            var accountsForm = document.getElementById('accountsForm');
            var overlay = document.getElementById("overlay");
            var table = document.querySelector("table");
            accountsForm.style.display = 'none';

            // Hide the overlay and remove the blur effect from the table
            overlay.style.display = "none";
            table.classList.remove("blurred-table");
        }

        var costInput = document.getElementById("cost");
var totalPagesInput = document.getElementById("totalPages");
var totalCostInput = document.getElementById("totalCost");
var receivedInput = document.getElementById("received");
var pendingInput = document.getElementById("pending");

costInput.addEventListener("input", calculateTotalCost);
totalPagesInput.addEventListener("input", calculateTotalCost);
receivedInput.addEventListener("input", calculateTotalCost);

function calculateTotalCost() {
    var cost = parseFloat(costInput.value) || 0;
    var totalPages = parseInt(totalPagesInput.value) || 0;
    var totalCost = (cost * totalPages).toFixed(2); // Format as float with two decimal places
    totalCostInput.value = totalCost;

    var receivedValue = parseFloat(receivedInput.value) || 0;
    var pendingValue = (totalCost - receivedValue).toFixed(2); // Format as float with two decimal places
    pendingInput.value = pendingValue;
}
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var accountsForm = document.getElementById("accountsForm");
        var addButton = document.querySelectorAll(".add-button");

        for (var i = 0; i < addButton.length; i++) {
            addButton[i].addEventListener("click", function () {
                var projectID = this.getAttribute("data-projectid");

                // Use AJAX to check if the project ID exists in the "accounts" table
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "check_project_exists.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Define the data to send to the server
                var data = "projectID=" + projectID;

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var exists = JSON.parse(xhr.responseText);

                        // Check if the project ID exists in the "accounts" table
                        if (exists) {
                            // If it exists, populate the form with "accounts" table data
                            fetchAccountData(projectID);
                        } else {
                            // If it doesn't exist, populate the form with "projects" table data
                            fetchProjectData(projectID);
                        }
                    }
                };

                // Send the request to check if the project ID exists
                xhr.send(data);
            });
        }
    });

    function fetchProjectData(projectID) {
    // Use AJAX to fetch data from the "projects" table
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_project_data.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Define the data to send to the server
    var data = "projectID=" + projectID;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);

            // Populate the form fields with retrieved data from the "projects" table
            document.getElementById("receivedDate").value = data.RECEIVEDDATE;
            document.getElementById("completionDate").value = data.COMPLETIONDATE;
            document.getElementById("vendor").value = data.CLIENTNAME;
            document.getElementById("ourbatch").value = data.OURBATCH;
            document.getElementById("projectid").value = data.PROJECTID;
            document.getElementById("receivedDate").value = data.RECEIVEDDATE;
            document.getElementById("accountstatus").value = data.STATUS;

            // Populate the "TL Status" field with data from the "projects" table
            document.getElementById("tlstatus").value = data.TL_STATUS;

            document.getElementById("cost").value = ""; // Clear cost
            document.getElementById("totalPages").value = data.RECEIVEDPAGES;
            document.getElementById("contactPerson").value = data.CONTACTPERSON;
            document.getElementById("totalCost").value = ""; // Clear totalCost
            document.getElementById("received").value = ""; // Clear received
            document.getElementById("pending").value = ""; // Clear pending

            // Show the form
            accountsForm.style.display = "block";

            // Show the overlay and blur the table
            overlay.style.display = "block";
            table.classList.add("blurred-table");
        }
    };

    // Send the request to fetch data from the "projects" table
    xhr.send(data);
}

    function closeForm() {
        var accountsForm = document.getElementById('accountsForm');
        var overlay = document.getElementById("overlay");
        var table = document.querySelector("table");
        accountsForm.style.display = 'none';

        // Hide the overlay and remove the blur effect from the table
        overlay.style.display = "none";
        table.classList.remove("blurred-table");
    }
</script>





<script>
document.addEventListener("DOMContentLoaded", function () {
    var accountsForm = document.getElementById("accountsForm");
    var addButton = document.querySelectorAll(".add-button");

    for (var i = 0; i < addButton.length; i++) {
        addButton[i].addEventListener("click", function () {
            var projectID = this.getAttribute("data-projectid");

            // Use AJAX to fetch data from the "accounts" or "projects" table
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_accounts_data.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Define the data to send to the server
            var data = "projectID=" + projectID;

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);

                    if (data.source === 'accounts') {
                        // If the data source is "accounts" table
                        // Populate the form fields for "accounts" data
                        document.getElementById("receivedDate").value = data.receiveddate;
                        document.getElementById("completionDate").value = data.completiondate;
                        document.getElementById("vendor").value = data.clientname;
                        document.getElementById("ourbatch").value = data.ourbatch;
                        document.getElementById("projectid").value = data.projectid;
                        document.getElementById("receivedDate").value = data.receiveddate;
                        document.getElementById("accountstatus").value = data.accountstatus;
                        document.getElementById("tlstatus").value = data.tlstatus;
                        document.getElementById("cost").value = data.cost;
                        document.getElementById("totalPages").value = data.totalpages;
                        document.getElementById("contactPerson").value = data.contactperson;
                        document.getElementById("totalCost").value = data.totalcost;
                        document.getElementById("received").value = data.received;
                        document.getElementById("pending").value = data.pending;
                    } else if (data.source === 'projects') {
                        // If the data source is "projects" table
                        // Populate the form fields for "projects" data
                        document.getElementById("receivedDate").value = data.RECEIVEDDATE;
                        document.getElementById("completionDate").value = data.COMPLETIONDATE;
                        document.getElementById("vendor").value = data.CLIENTNAME;
                        document.getElementById("ourbatch").value = data.OURBATCH;
                        document.getElementById("projectid").value = data.PROJECTID;
                        document.getElementById("receivedDate").value = data.RECEIVEDDATE;
                        document.getElementById("accountstatus").value = data.STATUS;
                        document.getElementById("tlstatus").value = data.TL_STATUS; // Clear tlstatus
                        document.getElementById("cost").value = ""; // Clear cost
                        document.getElementById("totalPages").value = data.RECEIVEDPAGES;
                        document.getElementById("contactPerson").value = data.CONTACTPERSON;
                        document.getElementById("totalCost").value = ""; // Clear totalCost
                        document.getElementById("received").value = ""; // Clear received
                        document.getElementById("pending").value = ""; // Clear pending
                    }

                    // Show the form
                    accountsForm.style.display = "block";

                    // Show the overlay and blur the table
                    overlay.style.display = "block";
                    table.classList.add("blurred-table");
                }
            };
            xhr.send(data);
        });
    }
});
</script>
</body>
</html>