<?php
session_start(); // Resume the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to index.php
    header("Location: index.php");
    exit; // Terminate the script after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/stylesss.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>View Candidates</title>
     <link rel="stylesheet" href="css/save.css"/>
    <style>  

     button.back-btn {

    margin-left: 78.3pc;
    border: none;
    height: 33px;
    color: white;
    background-color: #FB5607;
    width: 57px;
    border-radius: 4px;
}   
button.back-btn a{
    text-decoration:none;
    color:white;
    </style>
}
</head>
<body>
    <?php include_once ("includes/header.php");?>
    <div class="row" style="margin-top:4.5rem;">
        <div class="box">
      <div class="searc">
        <div class="row">
             <div class="col">
                 <input type="text" id="search" placeholder="Search">
             </div>
             <div class="col">
                 <button class="back-btn"><a href="payslip.php"> Back</a></button>
             </div>
        </div>
     
     
     </div> 
        <div class="salary_details" style="margin-top:1%;">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bc">
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>DEPARTMENT</th>
                        <th>WORK NATURE</th>
                        <th>JOINING DATE</th>     
                        <th>BASIC</th>
                        <th>BANKNAME</th>
                        <th>ACCOUNT NO</th>
                        <th>IFSCCODE</th>
                        <th>SALARY ACCOUNT</th>
                        <th>ESI_EPF</th>
                        <th>ESI NO</th>
                        <th>EPF NO</th>
                        <th>STATUS</th>
                        <th>MOBILE</th>
                        <th colspan="2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "includes/conn.php";
                    $sve = "SELECT * FROM employee_data where CODE like 'emp%' and DELSTATUS = 1";                            

$ddd = mysqli_query($conn, $sve);

                    // Loop through each employee
                    while ($row = mysqli_fetch_assoc($ddd)) {
                        $id = $row['CODE'];
                        $name = $row['NAME'];
                        $dept = $row['DEPARTMENT'];
                        $worknature = $row['WORKNATURE'];
                        $datejoining = $row['JOININGDATE'];                     
                        $basic = $row['BASIC'];
                        $bankname = $row['BANKNAME'];
                        $acntno = $row['ACCOUNTNO'];
                        $ifsc = $row['IFSCCODE'];
                        $salaryacnt = $row['SALARYACCOUNT'];
                        $Esi_epf = $row['ESI_EPF'];
                        $Esino = $row['ESINO'];
                        $Epfno = $row['EPFNO'];
                        $Status = $row['STATUS'];
                        $mobile=$row['MOBILE'];
                    ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $dept ?></td>
                            <td><?php echo $worknature ?></td>
                            <td><?php echo $datejoining ?></td>
                               <td><?php echo $basic ?></td> <!-- Updated the BASIC value here -->
                            <!-- <td><php echo $basic ?></td> -->
                            <td><?php echo $bankname ?></td>
                            <td><?php echo $acntno ?></td>
                            <td><?php echo $ifsc ?></td>
                            <td><?php echo $salaryacnt ?></td>
                            <td><?php echo $Esi_epf ?></td>
                            <td><?php echo $Esino ?></td>
                            <td><?php echo $Epfno ?></td>
                            <td><?php echo $Status ?></td>
                            <td><?php echo $mobile?></td>
                            <td><a href="update.php?id=<?php echo $row["ID"]; ?>" class="btn btn-primary btn-sm" role="button">Edit</a></td>
                            <td><a href="delete.php?code=<?php echo $row["CODE"]; ?>" i class="fa fa-trash" aria-hidden="true" onclick='return checkdelete()'></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    </div>
        </div>
        <div class="bottom">
            <label class="filt" for="filter">Filter by Status:</label>
            <select id="filter" onchange="filterTable()">
                <option value="all">All</option>
                <option value="working">Working</option>
                <option value="exit">Exit</option>
            </select>
            <button class="btn  btn-primary down" onclick="downloadFilteredData()">Download</button>
        </div>
    </div>
<script src="js/save.js"></script>

</body>
</html>