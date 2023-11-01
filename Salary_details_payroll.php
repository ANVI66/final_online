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
       <link rel="stylesheet" href="css/Salary_details_payroll.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- jQuery Validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<style>
.hidethis{
    display:none;
}
</style>
<body>
<!----------------------- start header section  ---------------------------------->
<?php require_once "includes/header.php";?>
<!-----------------------end header section  ---------------------------------->
<div class="container container1">
    <?php
    include "includes/connection.php";
    if ($user_position == "Admin" || $user_position == "General Manager") { ?>

<div class="row">
<!-- <div class="col-md-3">
<php
include "nav.php";
?>
</div> -->

<div class="col-md-9">
<div class="container11">
<div class="acnt-view">

<button type="submit2" class="btn1 btn-link"><a href="salary_storage_view.php" class="link-with-spacing">View salary details</a></button>
</div>
<div class="image_mobile">
<img src="assets/images/mobile.png" alt="image">
</div>
<div class="scrollable-container">
<div class="row move">
<div class="col-md-9 mt-4" style="margin-left: -69px;">

<div class="card">
<div class="card-header text-center">
<h4>PAYROLL</h4>
</div>
<div class="card-body">

<form action="" method="GET">
<div class="row" >
<div class="col-md-8 input-group" >
<input type="text" name="stud_id" id="search" value="<?php if(isset($_GET['stud_id'])){echo $_GET['stud_id'];} ?>" class="form-control searchid" placeholder=" Employee ID">
<div class="input-group-append">
<button type="submit1" class="btn icon"><i class="fas fa-search"></i></button>
</div>
</div>

<div class="col-md-9 payroll">
<div class="list-group" id="show-list">

</div>
</div>
</div>
</form>

<div class="row">
<div class="col-md-12">
<hr>
<?php

include "includes/connection.php";

if (isset($_GET['stud_id'])) {
$stud_id = $_GET['stud_id'];


   // Retrieve data from employee_data table
    $employee_query = "SELECT * FROM employee_data WHERE CODE LIKE 'EMP%' AND (CODE LIKE '$stud_id%' OR NAME LIKE '$stud_id%') AND STATUS != 'exit'";

$employee_result = mysqli_query($conn, $employee_query);

if (mysqli_num_rows($employee_result) > 0) {
    $employee_exists = false; // Flag to check if employee exists (not exited)
    while ($employee_row = mysqli_fetch_assoc($employee_result)) {
        $employee_exists = true; // Set flag to true since employee exists
        // Retrieve data from workingdays table (last entered details)
        $workingdays_query = "SELECT * FROM workingdays ORDER BY id DESC LIMIT 1";
        $workingdays_result = mysqli_query($conn, $workingdays_query);
        $workingdays_row = mysqli_fetch_assoc($workingdays_result);

        ?>                       
        <form action="salary_details_payroll_db.php" id="salary_details" method="post">
            <table>
            <tr>
                <td>
            <div class="form-group mb-3">
                <label for="">Employee Name</label>
                <input type="text" name="Name" readonly value="<?= $employee_row['NAME']; ?>" class="form-control">
            </div></td>
            <td>  <div class="form-group mb-3">
                <label for="">Employee  Code</label>
                <input type="text" name="stu_id" readonly value="<?= $employee_row['CODE']; ?>" class="form-control">
            </div></td>
    </tr>   

<tr>
<td>
<div class="form-group mb-3 ">

<label for="bas_inc">BASIC</label>
<input type="text" id="Basic" name="Basic" value="" class="form-control" readonly required >
    </div>
    </td>
    <td>
    <div class="form-group mb-3">
<label for="">Increment</label>
<input type="text" name="increse" id="increse" value="0" class="form-control"  required>
</div>
    </td>
</tr>
    </table>

<div class="form-group mb-3 ">                                  
<label for="">Gross salary</label>
<input type="text" name="bas_inc" id="bas_inc" value="<?= $employee_row['BASIC']; ?>" class="form-control" readonly required>
</div>       
                    
            <div class="form-group mb-3 hidethis">
                    <label for="">Total Working Days</label>
                    <input type="number" name="Total_no_of_days" id="Total_no_of_days" value="<?= $workingdays_row['WORKING_DAYS']; ?>" step="0.01"  required>
                </div>                        
            
                <div class="form-group mb-3">
<label for="">Employee Working days</label>
<input type="number" name="emp_working" id="emp_working" value="" class="form-control" step="0.01" required>
</div>
            <div class="form-group mb-3 hidethis">
                <label for="">Final total Working days</label>
                <input type="number" name="final_emp_working" step="0.01"  id="final_emp_working" value="" class="form-control" required>
                </div>

            <div class="form-group mb-3 hidethis">
                <label for="">Total salary</label>
                <input type="text" name="totalsalary" id="totalsalary" value="" class="form-control"  required>
            </div>

            <div class="form-group mb-3 hidethis">
                <label for="">ESI_Employee</label>
                <input type="text" name="esi75" id="esi75" value="" class="form-control" readonly>
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">ESI_Company</label>
                <input type="text" name="esi325" id="esi325" value="" class="form-control" readonly>
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">EPF_Employee</label>
                <input type="text" name="EPF12" id="EPF12" value="" class="form-control" readonly>
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">EPF_Company_12%</label>
                <input type="text" name="EPF18" id="EPF18" value="" class="form-control" readonly>
            </div>

            <div class="form-group mb-3 hidethis">
                <label for="">EPF_Basic</label>
                <input type="text" name="EPF_BASIC" id="EPF_BASIC" value="" class="form-control" >
            </div>

            <div class="form-group mb-3 hidethis">
                <label for="">EPF_Company_8.33%</label>
                <input type="text" name="EPF833" id="EPF833" value="" class="form-control" >

            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">EPF_Company_3.67%</label>
                <input type="text" name="EPF367" id="EPF367" value="" class="form-control">

            </div>                                                                                         
                    
            <div class="form-group mb-3">
                <label for="">Conveyance/Others</label>
                <input type="text" name="Convenience" id="Convenience" value="0" class="form-control"  required>
            </div>

            <div class="form-group mb-3 hidethis" >
                <label for="">Conveyance Final</label>
                <input type="text" name="conveyance" id="conveyance" value="" class="form-control"  required>
            </div>

            <div class="form-group mb-3">
                <label for="">Advance</label>
                <input type="text" name="Advance" id="Advance" value="0" class="form-control"  required>
            </div>
            
            <div class="form-group mb-3">
                <label for="">OT</label>
                <input type="text" name="ot" id="ot" value="0" class="form-control"  required>
            </div>
            <div class="form-group mb-3">
                <label for="">Total salary</label>
                <input type="text" id="final_salary_fixed" value="" name="final_salary_fixed" class="form-control" readonly>
            </div>
            

            <div class="form-group mb-3">
            <button type="submit" name="submit" class="btn btn-primary" onclick="showpoPup()">Save</button>
            <button type="submit" name="Code" class="btn btn-danger" onclick="resetPage()">Reset</button>
    </div>
    

            <div class="form-group mb-3 payslip">
            
            <div class="form-group mb-3 hidethis">
                <label for="">BASIC ALLOWANCE</label>

                <input type="text" name="basicallowan" id="basicallowan"readonly value="" class="form-control">
            </div>

            <div class="form-group mb-3 hidethis">
                <label for="">RENTAL ALLOWANCE</label>
                <input type="text" name="rentalallowan" id="rentalallowan" readonly value="" class="form-control">
            </div>

            <div class="form-group mb-3 hidethis">
                <label for="">MEDICAL ALLOWANCE</label>
                <input type="text" name="medicalallowan" id="medicalallowan" readonly value="" class="form-control">
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">Employee Code</label>
                <input type="text" name="Code" readonly value="<?= $employee_row['ID']; ?>" class="form-control">
            </div>
                                                                            
            <div class="form-group mb-3 hidethis">
                <label for="">Salary account</label>
                    <input type="text" name="Salary_Account" readonly value="<?= $employee_row['SALARYACCOUNT']; ?>" class="form-control">
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">Bank Name</label>
                <input type="text" name="Bank_name" readonly value="<?= $employee_row['BANKNAME']; ?>" class="form-control">
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">Account no</label>
                <input type="text" name="Account_no" readonly value="<?= $employee_row['ACCOUNTNO']; ?>" class="form-control">
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">Ifsc code</label>
                <input type="text" name="Ifsc_code" readonly value="<?= $employee_row['IFSCCODE']; ?>" class="form-control">
            </div>
            
            <div class="form-group mb-3 hidethis">
                <label for="">ESI Number</label>
                <input type="text" name="ESI_no" readonly value="<?= $employee_row['ESINO']; ?>" class="form-control">
            </div>
            <div class="form-group mb-3 hidethis">
                <label for="">EPF Number</label>
                <input type="text" name="EPF_no" readonly value="<?= $employee_row['EPFNO']; ?>" class="form-control">
            </div>


            <div class="form-group mb-3 hidethis">
                    <label for="">Designation</label>
                    <input name="designation" id="designation" value="<?= $employee_row['WORKNATURE']; ?>" required>
                </div>
                <div class="form-group mb-3 hidethis">
                    <label for="">department</label>
                    <input name="deptmnt" id="deptmnt" value="<?= $employee_row['DEPARTMENT']; ?>" required>
                </div>
                
                <div class="form-group mb-3 hidethis">
                    <label for="">lop</label>
                    <input name="LOP_DAYS" id="LOP_DAYS" value="" required>
                </div>
                <div class="form-group mb-3 hidethis">
                    <label for="">joining date</label>
                    <input name="joindate" id="joindate" value="<?= $employee_row['JOININGDATE']; ?>" required>
                </div>
        
                    
            <div class="form-group mb-3 hidethis">
                    <label for="">Salary date</label>
                    <input name="salary_date" id="salary_date" value="<?= $workingdays_row['SALARY_DATE']; ?>" required>
                </div>
                        
            <div class="form-group mb-3 hidethis">
                    <label for="">Increments</label>
                    <input name="increment" id="increment" value="" required>
                </div>
                        
            <div class="form-group mb-3 hidethis">
                    <label for="">Deductions</label>
                    <input name="deduction" id="deduction" value="" required>
                </div>

            <div class="col hidethis">ESI/EPF:
        <select name="esi_epf_value" id="esi_epf" class="form-control" required>
            <option value="Yes" <?php if ($employee_row['ESI_EPF'] == 'Yes') echo 'selected'; ?>>Yes</option>
            <option value="No" <?php if ($employee_row['ESI_EPF'] == 'No') echo 'selected'; ?>>No</option>
        </select>
        </div>

        <div class="form-group mb-3 hidethis">
                <label for="">Mobile Number</label>
                <input type="text" name="mobile" readonly value="<?= $employee_row['MOBILE']; ?>" class="form-control" readonl>
            </div>

                <div class="form-group mb-3 hidethis">
                <label for="">Status</label>
                <input type="text" name="Status" readonly value="<?= $employee_row['STATUS']; ?>" class="form-control">
            </div> 

</div>

     <div class="form-group mb-3 hidethis">
                                                    <label for="">currentmonth</label>
                                                    <input type="text" name="currentmonth" readonly value="<?php echo date('m-y'); ?>" class="form-control">
                                                </div>  
</form>


<?php
}






if (!$employee_exists) {
echo "<p class='list-group-item border-1'>Employee has exited.</p>";
}
} else {
// No existing employee records found
$no_records_found = true;

// Check if there are any exited employee records
$exited_employee_query = "SELECT * FROM employee_data WHERE (CODE LIKE '$stud_id%' OR NAME LIKE '$stud_id%') AND STATUS = 'exit'";
$exited_employee_result = mysqli_query($conn, $exited_employee_query);
if (mysqli_num_rows($exited_employee_result) > 0) {
echo "<p class='list-group-item border-1'>Employee has exited.</p>";
} else {
echo "<p class='list-group-item border-1'>No Records</p>";
}
}
} else {
echo "<p class='list-group-item border-1'>No Records</p>";
}

mysqli_close($conn);
?>



</div>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

<script>    
//   $(document).ready(function(){
//   $('#getName').on("keyup", function(){
//      var getName = $(this).val();
//      $.ajax({
//       method:'POST',
//       url:'searchajax.php',
//       data:{name:getName},
//       success:function(response)
//       {
//             $("#showdata").html(response);
//       } 
//      });
//   });
//   });
 </script>

<script>
        $(document).ready(function() {
            // Send Search Text to the server
            $("#search").keyup(function() {
                let searchText = $(this).val();
                if (searchText != "") {
                    $.ajax({
                        url: "conn.php",
                        method: "post",
                        data: {
                            query: searchText
                        },
                        success: function(response) { 
                            $("#show-list").html(response);
                        }
                    });
                } else {
                    $("#show-list").html("");
                }
            });

            // Set searched text in input field on click of search button
            $(document).on("click", "a", function() {
                $("#search").val($(this).text());
                $("#show-list").html("");
            });
        });
    </script>

<!-- </body>
</html> -->

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
            <?php require_once "includes/footer.php"; ?>
        </div>
        <?php
    }
    ?>
    <style>
      
    </style>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/salary_details_payroll.js"></script>
</body>
</html>
