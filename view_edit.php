<?php
session_start(); // Resume the session

// // Check if the user is logged in
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // User is not logged in, redirect to index.php
//     header("Location: index.php");
//     exit; // Terminate the script after redirection
// }
?>
<?php include_once ('includes/header.php'); ?>
<?php

include "INCLUDES/connection.php";
if(isset($_POST["edit"])){
    $id=$_POST['ID'];

    $code = $_POST['code'];

    $name = $_POST['Name'];
    $basic = $_POST['sBASIC'];
    $convenience = $_POST['conveyance'];
    $advance = $_POST['Advance'];
    $Overtime = $_POST['ot'];
    $employworking = $_POST['emp_working'];

    $salary = $_POST['final_salary_fixed'];

    $salarydate = $_POST['salary_date'];
    $EPF12 = $_POST['EPF12'];
    

    $EPF18 = $_POST['EPF18'];
    $ESI075 = $_POST['esi75'];
    $ESI325 = $_POST['esi325'];
    $basicallowance = $_POST['basicallowan'];
    $rentalallowance = $_POST['rentalallowan'];
    $medicalallowance = $_POST['medicalallowan'];
    $lossofpay = $_POST['LOP_DAYS'];
    $finalwrkngdays = $_POST['final_emp_working'];
    $EPF833 = $_POST['EPF833'];
    $EPF367 = $_POST['EPF367'];
    $EPFBASIC=$_POST['EPF_BASIC'];
    

    $query = "UPDATE salary_data SET sCODE='$code', sNAME='$name', sBASIC='$basic', sCONVIENCE='$convenience', sADVANCE='$advance', sOVER_TIME='$Overtime', sEMP_WORKING_DAYS='$employworking', sSALARY='$salary', sSALARY_DATE='$salarydate', sEPF12='$EPF12', sEPF18='$EPF18', sESI075='$ESI075', sESI325='$ESI325', sBASICALLOW='$basicallowance', sRENTALALLOW='$rentalallowance', sMEDICALALLOW='$medicalallowance', sLOSSPAY='$lossofpay', sFINALWORKINGDAYS='$finalwrkngdays',sEMP_COMP833='$EPF833',sEMP_COMP367='$EPF367',SEPFBASIC='$EPFBASIC' WHERE ID='$id'";

    
 
$query_run=mysqli_query($conn,$query);

if($query_run){
    
    ?>

    <script>
alert("Successfully Updated");
window.location.href='salary_storage_view.php';

    </script>

    <?php

}

else{
    ?>
    <script>
alert("Not Updated");
window.location.href='salary_storage_view.php';

    </script>

    <?php
}
}


$result=mysqli_query($conn,"SELECT * FROM salary_data where ID='".$_GET['id']."'");

$row=mysqli_fetch_array($result);

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

    <!-- jQuery Validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Krub:wght@500;700&display=swap"
    />
</head>
<style>
.row
{
    width:100%;
}
.view_edit_id{
  display:none;
}


button.btn-primary:hover{
color: black;
background-color: white;
border: 1px solid #FB5607;
}

.container1{
    margin-bottom: 40px;
    margin-left: 30px;
    margin-bottom: 10px;
    width: 95%;
    height: 80%;
    padding: 20px;
    border-radius: 5px;
    background: rgba(217, 217, 217, 0.40);
}
.col-9 .form-control{
width: 370px;
height: 36px;
flex-shrink: 0;
border-radius: 5px;
border: 0.5px solid #FB5607;
background: #FFF;
margin-bottom: 10px;
margin-right: 10px;
}
.col-9 .col{
color: #000;
font-size: 15px;
font-family: Inter;
font-style: normal;
font-weight: 400;
line-height: normal;
letter-spacing: 0.36px;
margin-bottom:2px;
padding-left: 15px;
}
.col-9 {
    width: 83% !important;
    margin-left: 16%;
}


element.style {
}
.row.view_edit_id {
    display: none;
}
.hidethis
{
  display:none;
}
.col-md-6{
  width:100% !important;
}


@media (max-width:767px){
.col-md-9{
     margin-top:0% !important;
    font-size: 11px;
    width: 100% !important;
    height: 100vh;
}

.container1{
    margin-top:9%;
  margin-left:4%;
}
button.btn-primary {
    margin-top: -12px;
    margin-left: 63%;}

    input#Advance {
    width: 90%;
}
button.btn.btn-primary {
    margin-top: 18px;
    margin-bottom: -15px;
}
}

@media (min-width:768px) and (max-width:1024px){
  .col-md-9{
       margin-top:0% !important;
    font-size: 11px;
    margin-top: 3% !important;
    width: 94% !important;
    height: 100vh;
}

.container1{
   
  margin-left:4%;
}
button.btn-primary {
    margin-top: -12px;
    margin-left: 63%;}
    
    button.btn.btn-primary {
    margin-top: 18px;
    margin-bottom: -15px;
}

    input#Advance {
    width: 90%;
}
.col-md-6{
  width:100% !important;
}
input#Advance {
    width: 96.5%;
}

*{font-size:11px;}
.container1 {
  width:90%;
}


}
input{width: 100%}

.body_contain{
    margin-top: 10%;
    padding-left:15% ;
    padding-right: 15%;
}
.row{margin-bottom: 2%;}
.col-md-2.emp_name {
    width: 25%;
}
.Advance{
    width:25%;
}
.btn{margin-left: 45%;
    margin-top: -10%;
}

</style>

<body>


<div class="row body_contain">

<form class="container1" id="form" action="" method="post">


    <div >
<div class="row view_edit_id hidethis">
                <div class="col-md-6">ID</div>
                <div class="col-md-6"><input type="text"  name="ID" value="<?php echo $row["ID"]; ?>" readonly required></div>               
</div>

<div class="row">
        <div class="col-md-2">Employee Code</div>
        <div class="col-md-3"><input type="text" name="code" readonly value="<?php echo $row["sCODE"]; ?>" class="form-control"></div>
        <div class="col-md-1"></div>
        <div class="col-md-2 ">Employee Name</div>
        <div class="col-md-2 emp_name"><input type="text" name="Name" readonly value="<?php echo $row["sNAME"]; ?>" class="form-control"></div>  
         </div>
<!--readonly  value="<= $row['BASIC']; ?>"-->

<div class="row">
    <div class="col-md-2">Salary Date</div>
<div class="col-md-3"><input type="text" name="salary_date" id="salary_date" value="<?php echo $row["sSALARY_DATE"]; ?>" class="form-control"  required readonly></div>
<div class="col-md-1"></div>
          <div class="col-md-2">Basic</div>
          <div class="col-md-3"><input type="text"id="Basic" name="sBASIC" value="<?php echo $row["sBASIC"]; ?>" class="form-control" readonly></div>
</div>

<div class="row">
          <div class="col hidethis">Monthly Working Days<input name="Total_no_of_days" id="Total_no_of_days"value="<?php echo  $row['sTOTAL_DAYS']; ?>" class="form-control" required readonly></div>

<div class="col hidethis">Conveyance/Final<input type="text" name="conveyance" id="conveyance" value="<?php echo $row["sCONV_GIVEN"]; ?>" class="form-control" required></div>    
          </div>       
<div class="row ">
    <div class="col-md-2">Working days</div>
    <div class="col-md-3"><input type="text" name="emp_working" id="emp_working" value="<?php echo $row["sEMP_WORKING_DAYS"]; ?>" class="form-control"  required></div>
    <div class="col-md-1"></div>
<div class="col-md-2">Conveyance/Others</div>
<div class="col-md-3"><input type="text" name="Convenience" id="Convenience" value="<?php echo $row["sCONVIENCE"]; ?>" class="form-control"  required></div>
</div>   

 <div class="row">
            <div class="col-md-2">OT</div>
            <div class="col-md-3">
        <input type="text" name="ot" id="ot" value="<?php echo $row["sOVER_TIME"]; ?>"  class="form-control"  required></div>
<div class="col-md-1"></div>
            <div class="col-md-2">Advance</div>
            <div class="col-md-2 Advance">
            <input type="text" name="Advance" id="Advance" value="<?php echo $row["sADVANCE"]; ?>" class="form-control"  required>
              
     </div>
 </div>
     
              <div class="row">       
        <div class="col-md-2">Final salary fixed</div>
        <div class="col-md-3"><input type="text" id="final_salary_fixed" name="final_salary_fixed" value="<?php echo $row["sSALARY"]; ?>"class="form-control"></div>
       
     </div>          

<div class="row">
<div class="col hidethis">Final total Working days
<input type="text" name="final_emp_working" id="final_emp_working" value="<?php echo $row["sFINALWORKINGDAYS"]; ?>" class="form-control" required readonly>
</div>
</div>
<div class="row">
    <div class="col hidethis">Total salary
    <input type="text" name="totalsalary" id="totalsalary" value="<?php echo $row["sSALARY"]; ?>" class="form-control"  required readonly>
    </div>
    <div class="col hidethis">ESI_Employee
    <input type="text" name="esi75" id="esi75" value="" class="form-control" readonly>
    </div>
</div>
          <div class="row">
          <div class="col hidethis">ESI_Company<input type="text" name="esi325" id="esi325" value="" class="form-control" readonly></div>
          <div class="col hidethis">EPF_Employee
          <input type="text" name="EPF12" id="EPF12" value="" class="form-control" readonly>
          </div>
          </div>        
          
        <div class="row">
             <div class="col hidethis">EPF_Company
            <input type="text" name="EPF18" id="EPF18" value="" class="form-control" readonly>
            </div>
            <div class="col hidethis">EPF_Company_8.33%
            <input type="text" name="EPF833" id="EPF833" value="" class="form-control" readonly>
            </div>
            <div class="col hidethis">EPF_Company_3.67%
            <input type="text" name="EPF367" id="EPF367" value="" class="form-control" readonly>
            </div>
             <div class="col form-group mb-3 hidethis">
                                                    <label for="">EPF_Basic</label>
                                                    <input type="text" name="EPF_BASIC" id="EPF_BASIC" value="" class="form-control" >
                                                </div>
         </div>
    
    <div class="row">
    <div class="col hidethis">BASIC ALLOWANCE
    <input type="text" name="basicallowan" id="basicallowan"readonly value="" class="form-control">
    </div>
    <div class="col hidethis">RENTAL ALLOWANCE
    <input type="text" name="rentalallowan" id="rentalallowan" readonly value="" class="form-control">
    </div>
</div>

        <div class="row ">
            <div class="col hidethis">MEDICAL ALLOWANCE<input type="text" name="medicalallowan" id="medicalallowan" readonly value="" class="form-control"></div>

            <div class="col hidethis">lop<input name="LOP_DAYS" id="LOP_DAYS" value="" class="form-control" required readonly></div>
              <div class="col hidethis">ESI/EPF:
  <input name="esi_epf" id="esi_epf" value=<?php echo $row ["sESI_EPF"]; ?> class="form-control" required>
</div>
        </div>       
      
          
 <button type="submit" name="edit" class="btn btn-primary">Save</button>

</div>
  </form>  
  </div>            
  </div>                   

                                                   
                                                                    <!-- jQuery library -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <!-- jQuery Validation plugin -->
                                    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

                                <script>
                                    $(document).ready(function() {
                                    $("#salary_details").validate({
                                        rules: {
                                            Total_no_of_days: {
                                                required: true,
                                                minlength: 1,
                                                },
                                                ot: {
                                                    required: true,
                                                        minlength: 1,
     
                                                        },
                                                        Salary_date: {
                                                        required: true,                                                       
                                                        }
                                                },
                                                messages: {
                                                    Total_no_of_days: {
                                                            required: "Please check",
                                                            
                                                        },
                                                        ot: {
                                                            required: "Please check",
                                                            
                                                        },
                                                        Salary_date: {
                                                            required: "Please check",
                                                        
                                                        }
                                                        submitHandler: function(form) {
                                                        form.submit();
                                                        }
                                                    }
                                                    });
                                                    });
                                </script>

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

  document.getElementById('emp_working').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('Basic').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('ot').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('Advance').addEventListener('input', calculateTotalWorkingDays);

  document.getElementById('Convenience').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('conveyance').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('basicallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('rentalallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('medicalallowan').addEventListener('input', calculateTotalWorkingDays);
  document.getElementById('esi_epf').addEventListener('change', calculateTotalWorkingDays);
  document.getElementById('Total_no_of_days').addEventListener('input', calculateTotalWorkingDays);

  function calculateTotalWorkingDays() {
    let esiEpfOption = document.getElementById('esi_epf').value;
    let esi75Input = document.getElementById('esi75');
    let esi325Input = document.getElementById('esi325');
    let epf12Input = document.getElementById('EPF12');
    let epf18Input = document.getElementById('EPF18');
    let epf_367Input = document.getElementById('EPF367');
    let epf_833Input = document.getElementById('EPF833');
    let epf_basicInput = document.getElementById('EPF_BASIC');

    let company_basic_pay = parseFloat(document.getElementById('Basic').value);

    if (!isNaN(company_basic_pay)) {
      let monthlyWorkingDays = parseInt(document.getElementById('Total_no_of_days').value);
      let employee_WorkingDays = parseInt(document.getElementById('emp_working').value);
      let exactDaysInput = document.getElementById('final_emp_working');
      let convenience = parseFloat(document.getElementById('Convenience').value);
      let conv_given = parseFloat(document.getElementById('conveyance').value);
      let ot = parseFloat(document.getElementById('ot').value);
      let advance = parseFloat(document.getElementById('Advance').value);
      let totalsalary = parseFloat(document.getElementById('totalsalary').value);
      let basicAllowance = parseFloat(document.getElementById('basicallowan').value);
      let RentalAllowance = parseFloat(document.getElementById('rentalallowan').value);
      let MedicalAllowance = parseFloat(document.getElementById('medicalallowan').value);
      let lopdays = parseFloat(document.getElementById('LOP_DAYS').value);

     if (parseFloat(employee_WorkingDays) >= parseFloat(monthlyWorkingDays)-1 ) {
    employee_WorkingDays += 1;
} 
else if (parseFloat(employee_WorkingDays) >= parseFloat(monthlyWorkingDays)-2 ) {
    employee_WorkingDays += 1;
} 
 else {
  employee_WorkingDays = parseFloat(employee_WorkingDays); // Convert the value to float
  exactDaysInput.value = employee_WorkingDays; // Assign the value directly to exactDaysInput
}

employee_WorkingDays = parseFloat(employee_WorkingDays); 

      var perDaySalary = company_basic_pay / monthlyWorkingDays;
      var final_BasicSalary = perDaySalary * employee_WorkingDays;
      document.getElementById('totalsalary').value = final_BasicSalary;
      exactDaysInput.value = employee_WorkingDays;

      var epf_basic = 0;
      var epf_employee = 0;
      var epf_company = 0;
      var esi_employee = 0;
      var esi_company = 0;
      var epfcomp833 = 0;
      var epfcomp367 = 0;

      if (company_basic_pay <= 10000) {
        epf_basic = final_BasicSalary * 30 / 100;
      } else {
        epf_basic = (3334 / monthlyWorkingDays) * employee_WorkingDays;
      }


      epf_employee = epf_basic * 0.12;
      epf_company = epf_basic * 0.12;
      esi_employee = epf_basic * 0.0075;
      esi_company = epf_basic * 0.0325;
      epfcomp833 = epf_basic * 0.0833;
      epfcomp367 = epf_basic * 0.0367;

      if (esiEpfOption === 'Yes') {
        esi75Input.value = esi_employee.toFixed(2);
        esi325Input.value = esi_company.toFixed(2);
        epf12Input.value = epf_employee.toFixed(2);
        epf18Input.value = epf_company.toFixed(2);
        epf_367Input.value = epfcomp367.toFixed(2);
        epf_833Input.value = epfcomp833.toFixed(2);
        epf_basicInput.value = epf_basic.toFixed(2);
      } else {
        esi75Input.value = '0';
        esi325Input.value = '0';
        epf12Input.value = '0';
        epf18Input.value = '0';
        epf_367Input.value = '0';
        epf_833Input.value = '0';
        epf_basicInput.value = '0';
      }

      var additional_allow = (company_basic_pay / monthlyWorkingDays) * employee_WorkingDays;
      var basic_allow = additional_allow * 0.45;
      var rental_allow = additional_allow * 0.25;
      var medical_allow = additional_allow * 0.30;
      

var conveyanceOthers = parseFloat(document.getElementById('Convenience').value);
  var conveyanceFinal = (conveyanceOthers / monthlyWorkingDays) * employee_WorkingDays;
  document.getElementById('conveyance').value = conveyanceFinal;
  
  
      var totalsalary_all_value = 0;
if (esiEpfOption === 'Yes') {
  totalsalary_all_value = (conveyanceFinal + ot + final_BasicSalary) - (advance + epf_employee + esi_employee);
} else {
  totalsalary_all_value = (conveyanceFinal + ot + final_BasicSalary) - (advance);
}





      var lopdaysss = monthlyWorkingDays - employee_WorkingDays;
      var increments = basic_allow + medical_allow + rental_allow + ot + convenience;
      var deductions = epf_employee + esi_employee + advance;
    

      document.getElementById('esi75').value = esi75Input.value;
      document.getElementById('esi325').value = esi325Input.value;
      document.getElementById('EPF12').value = epf12Input.value;
      document.getElementById('EPF18').value = epf18Input.value;
      document.getElementById('EPF367').value = epf_367Input.value;
      document.getElementById('EPF833').value = epf_833Input.value;
      document.getElementById('EPF_BASIC').value = epf_basicInput.value;

      document.getElementById('basicallowan').value = basic_allow.toFixed(2);
      document.getElementById('rentalallowan').value = rental_allow.toFixed(2);
      document.getElementById('medicalallowan').value = medical_allow.toFixed(2);
      document.getElementById('final_salary_fixed').value = totalsalary_all_value.toFixed(2);
      document.getElementById('LOP_DAYS').value = lopdaysss;

      document.getElementById('deduction').value = deductions;
      document.getElementById('increment').value = increments;
    } else {
      // Invalid salary value
      document.getElementById('result').innerHTML = 'Please provide a valid basic salary.';
    }
  }

  var inputs = document.querySelectorAll('#Basic');
  inputs.forEach(function (input) {
    input.addEventListener('input', calculateTotalWorkingDays);
  });

  calculateTotalWorkingDays();
</script>
    </div>
</body>
</html>