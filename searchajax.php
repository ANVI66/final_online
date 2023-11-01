<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>payment entry</title>
<script src="https://kit.fontawesome.com/cac3eb7948.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<style>

.container11{
width:105%;
height:100%;
}


.input-group .btn {
background: none;
border: none;
color: #FB5607;
}
.card-header.text-center {
padding-top: 17px;
/* float: left; */
COLOR: white;
/* width: 666px; */
height: 70px;
flex-shrink: 0;
border-radius: 10px;
background: #FC7305;
}
h4 {
padding-top: 6px;
padding-left: 7px;
float: left;
color: #FFF;
font-size: 30px;
font-family: sans-serif;
font-style: normal;
font-weight: 700;
line-height: normal;
letter-spacing: 0.6px;
font-size: 1.3em;
}
.input-group-append {
position: relative;
top: 2px;
left: -57px;
}

.searchid{
width: 590px;
height: 62px;
flex-shrink: 0;

border-radius: 10px;
border: 0.5px solid #000;
}
.searchid::placeholder {
color: #000;
font-size: 13px;
font-family: sans-serif;
font-style: normal;
font-weight: 500;
line-height: normal;
letter-spacing: 0.4px;
}
.searchid:focus {
border:none;
outline: none;
}
.input-group-append {
z-index: 100;
}
button.btn.icon {
padding-top: 16px;
}
button.btn.icon:hover {
color:orangered;
}
/*
.hidethis{
display:none;
}
*/
.card-body {
background-color: #F0F0F0;
border: 1px solid rgba(0,0,0,.125);
border-radius: 0.25rem;
}
.card{
border:none !important;
}
input.form-control.searchid {
text-transform: uppercase;
}
button.btn.btn-primary {
color: #FFF;
border:1px orangered solid;
font-size: 20px;
font-family: sans-serif;
font-style: normal;
font-weight: 600;
line-height: normal;
letter-spacing: 0.4px;
border-radius: 5px;
background: #FB5607;
margin-top: 2%;
margin-left:15px;
}
button.btn.btn-danger {
margin-left:5px;
border:1px green solid;
color: #FFF;
font-size: 20px;
font-family: sans-serif;
font-style: normal;
font-weight: 600;
line-height: normal;
letter-spacing: 0.4px;
border-radius: 5px;
background: green;
margin-top: 2%;
}
input.form-control {
margin-left: 13px;
width: 94%;
}
label {
margin-bottom: 2px;
margin-left: 15px;
display: inline-block;
}
.move{
margin-top:7%;
margin-left:345px;
width:76%;
}
.image_mobile img {
width: 500px;
right:10px;
position: absolute;
top: 5%;
/* float: right; */
height: 400px;
}
button.btn.btn-link {
margin-top:20px;
text-decoration:none;
margin-right: 18%;
float: right;
}
button.btn.btn-link a {
font-weight:600;
letter-spacing:1px;
font-size:20px;
color: #FB5607;
}
.link-with-spacing {
text-decoration: none;
border-bottom: 1px solid;
padding-bottom: 5px;
}


@media (max-width: 767px) {
.container11 {
display: flex;
flex-direction: column;
align-items: center;
}

.image_mobile {
display: none;
}

.move {
margin: 7% 0;
}

.input-group .btn {
color: #FB5607;
}

.card-header.text-center {
height: auto;
}

h4 {
padding-top: 6px;
padding-left: 7px;
float: none;
font-size: 24px;
}

.searchid {
width: 100%;
height: 52px;
}

.searchid::placeholder {
font-size: 12px;
}

.input-group-append {
position: relative;
top: initial;
left: initial;
margin-left: 10px;
}

button.btn.icon {
padding-top: 10px;
}

button.btn.btn-primary,
button.btn.btn-danger {
margin-top: 10px;
margin-left: 5px;
width: 48%;
}

input.form-control {
margin-left: 0;
width: 100%;
}

label {
margin-left: 0;
}

button.btn.btn-link {
margin-top: 10px;
margin-right: 0;
float: none;
}
.row
{
width:100%;
}
.col-9 {
width: 83% !important;
margin-left: 16%;
}
.col-md-3
{
width: 17% !important;

}
}

/* Desktop Styles */
@media (min-width: 768px) {
.image_mobile {
position: absolute;
right: 150px;
top: 25%;
width: 500px;
height: 400px;
}

button.btn.btn-link {
margin-right: 18%;
}
}



/*
.input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
border-top-right-radius: 5PX;
border-bottom-right-radius: 5PX;
}*/

</style>
<body>


<div class="row">
<!-- <div class="col-md-3">
<php
include "nav.php";
?>
</div> -->

<div class="col-md-9">
<div class="container11">
<div class="acnt-view">

<button type="submit2" class="btn btn-link"><a href="salary_storage_view.php" class="link-with-spacing">View salary details</a></button>
</div>
<div class="image_mobile">
<img src="assets/images/mobile.png" alt="image">
</div>
<div class="scrollable-container">
<div class="row move">
<div class="col-md-7">

<div class="card mt-5">
<div class="card-header text-center">
<h4>PAYROLL</h4>
</div>
<div class="card-body">

<form action="" method="GET">
<div class="row">
<div class="col-md-8 input-group">

<input type="text" name="stud_id" value="<?php if(isset($_GET['stud_id'])){echo $_GET['stud_id'];} ?>" class="form-control searchid" placeholder=" Employee ID">

<div class="input-group-append">
<button type="submit1" class="btn icon"><i class="fas fa-search"></i></button>
</div>
</div>


</div>
</form>

<div class="row">
<div class="col-md-12">
<hr>
<?php 

include "includes/connection.php";

if(isset($_GET['stud_id']))
{
$stud_id = $_GET['stud_id'];

// Retrieve data from employee_data table
$employee_query = "SELECT * FROM employee_data WHERE id='$stud_id' or NAME='$stud_id'";

$employee_result = mysqli_query($conn, $employee_query);

// Retrieve data from workingdays table (last entered details)
$workingdays_query = "SELECT * FROM workingdays ORDER BY id DESC LIMIT 1";
$workingdays_result = mysqli_query($conn, $workingdays_query);

if(mysqli_num_rows($employee_result) > 0 && mysqli_num_rows($workingdays_result) > 0)
{
    $employee_row = mysqli_fetch_assoc($employee_result);
    $workingdays_row = mysqli_fetch_assoc($workingdays_result);
    ?>
                                            
        <form action="salary_details_payroll_db.php" id="salary_details" method="post">
        
        <div class="form-group mb-3">
            <label for="">Employee Name</label>
            <input type="text" name="Name" readonly value="<?= $employee_row['NAME']; ?>" class="form-control">
        </div>


<!--readonly  value="<= $employee_row['BASIC']; ?>"-->


        <div class="form-group mb-3">
            <label for="">Gross Salary</label>
            <input type="text" id="Basic" name="Basic" value="<?= $employee_row['BASIC']; ?>"   class="form-control">
        </div>



        <div class="form-group mb-3 hidethis">
                <label for="">Total Working Days</label>
                <input name="Total_no_of_days" id="Total_no_of_days" value="<?= $workingdays_row['WORKING_DAYS']; ?>" required>
            </div>
                    
        
        <div class="form-group mb-3">
            <label for="">Employee Working days</label>
            <input type="text" name="emp_working" id="emp_working" value="" class="form-control"  required>
        </div>


        <div class="form-group mb-3 hidethis">
            <label for="">Final total Working days</label>
            <input type="text" name="final_emp_working" id="final_emp_working" value="" class="form-control" required>
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
            <input type="text" name="EPF367" id="EPF367" value="" class="form-control" >

        </div>

        
    
        
        <div class="form-group mb-3">
            <label for="">Conveyance/Others</label>
            <input type="text" name="Convenience" id="Convenience" value="" class="form-control"  required>
        </div>



        <div class="form-group mb-3 hidethis" >
            <label for="">Conveyance Final</label>
            <input type="text" name="conveyance" id="conveyance" value="" class="form-control"  required>
        </div>

        <div class="form-group mb-3">
            <label for="">Advance</label>
            <input type="text" name="Advance" id="Advance" value="" class="form-control"  required>
        </div>


        
        <div class="form-group mb-3">
            <label for="">OT</label>
            <input type="text" name="ot" id="ot" value="" class="form-control"  required>
        </div>
        <div class="form-group mb-3">
            <label for="">Total ssalary</label>
            <input type="text" id="final_salary_fixed" value="" name="final_salary_fixed" class="form-control">
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

                                                                            
        <div class="form-group mb-3 hidethis">
                <label for="">Net Paid</label>
                <input name="netpaid" id="netpaid" value="" required>
            </div>



        <div class="form-group mb-3 hidethis">
            <label for="">Status</label>
            <input type="text" name="Status" readonly value="<?= $employee_row['STATUS']; ?>" class="form-control">
        </div>




        <div class="col">ESI/EPF:
<select name="esi_epf" class="form-control" required>
<option value="" <?php if ($employee_row['ESI_EPF'] == '') echo 'selected'; ?>>Select</option>
<option value="Yes" <?php if ($employee_row['ESI_EPF'] == 'Yes') echo 'selected'; ?>>Yes</option>
<option value="No" <?php if ($employee_row['ESI_EPF'] == 'No') echo 'selected'; ?>>No</option>
</select>
</div>




        
</form>                                        

            <?php } ?>


        
<?php
mysqli_close($conn);
}
else
{
    echo "No Record Found";
}


?>


<script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'searchajax.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });
</script>


<!----refresh the page------>

<script>
function resetPage(){
location.reload();
}
</script>




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
},
submitHandler: function(form) {
form.submit();

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
</div>

<script>

document.getElementById('emp_working').addEventListener('input', calculateTotalWorkingDays);
document.getElementById('Basic').addEventListener('input', calculateTotalWorkingDays);
document.getElementById('ot').addEventListener('input', calculateTotalWorkingDays);
document.getElementById('Advance').addEventListener('input', calculateTotalWorkingDays);
document.getElementById('Convenience').addEventListener('input', calculateTotalWorkingDays);
document.getElementById('basicallowan').addEventListener('input',calculateTotalWorkingDays);
document.getElementById('rentalallowan').addEventListener('input',calculateTotalWorkingDays);
document.getElementById('medicalallowan').addEventListener('input',calculateTotalWorkingDays);

function calculateTotalWorkingDays() {


let esiEpfOption = document.querySelector('select[name="esi_epf"]').value;
let esi75Input = document.getElementById('esi75');
let esi325Input = document.getElementById('esi325');
let epf12Input = document.getElementById('EPF12');
let epf18Input = document.getElementById('EPF18');



let company_basic_pay = parseFloat(document.getElementById('Basic').value);

if (!isNaN(company_basic_pay)) {
if (company_basic_pay <= 7000 || (company_basic_pay > 7000 && company_basic_pay <= 10000)) {

let monthlyWorkingDays = parseInt(document.getElementById('Total_no_of_days').value);
let employee_WorkingDays = parseInt(document.getElementById('emp_working').value);
let exactDaysInput = document.getElementById('final_emp_working');
let convenience = parseFloat(document.getElementById('Convenience').value);
let ot = parseFloat(document.getElementById('ot').value);
let advance = parseFloat(document.getElementById('Advance').value);
let totalsalry = parseFloat(document.getElementById('totalsalary').value);
let basicAllowance=parseFloat(document.getElementById('basicallowan').value);
let RentaAllowance=parseFloat(document.getElementById('rentalallowan').value);
let MedicalAllowance=parseFloat(document.getElementById('medicalallowan').value);
let lopdays = parseFloat(document.getElementById('LOP_DAYS').value);




if (monthlyWorkingDays === employee_WorkingDays) {
employee_WorkingDays = monthlyWorkingDays - (-1);
} else if (monthlyWorkingDays === employee_WorkingDays + 1) {
employee_WorkingDays = monthlyWorkingDays;
} else if (monthlyWorkingDays === employee_WorkingDays - (-2)) {
employee_WorkingDays = monthlyWorkingDays - 1;
} else if (monthlyWorkingDays === employee_WorkingDays - (-3) || monthlyWorkingDays > -(-3)) {
exactDaysInput.value = employee_WorkingDays;
}



var perDaySalary = company_basic_pay / monthlyWorkingDays;
var final_BasicSalary = perDaySalary * employee_WorkingDays;
document.getElementById('totalsalary').value = final_BasicSalary;
exactDaysInput.value = employee_WorkingDays;

if (esiEpfOption === 'No') {
esi75Input.value = '0.00';
esi325Input.value = '0.00';
epf12Input.value = '0.00';
epf18Input.value = '0.00';
}

var epf_basic = final_BasicSalary * 30 / 100;
var epf_employee = epf_basic * 0.12;
var epf_company = epf_basic * 0.12;
var esi_employee = epf_basic * 0.0075;
var esi_company = epf_basic * 0.0325;
var additional_allow = (company_basic_pay/monthlyWorkingDays)*employee_WorkingDays;
var basic_allow = additional_allow *0.45;
var rental_allow = additional_allow *0.25;
var medical_allow = additional_allow *0.30;

var convenience_final=(convenience/monthlyWorkingDays)*employee_WorkingDays

var totalsalary_all_value = (convenience_final + ot + final_BasicSalary)-(advance+epf_employee+esi_employee);
var lopdaysss= monthlyWorkingDays - employee_WorkingDays;


var increments=basic_allow + medical_allow + rental_allow+ot+convenience;

var deductions=epf_employee+esi_employee+advance;
var epfcomp833=epf_basic*0.0833;
var epfcomp367=epf_basic*0.0367;





document.getElementById('esi75').value = esi_employee.toFixed(2);
document.getElementById('esi325').value = esi_company.toFixed(2);
document.getElementById('EPF12').value = epf_employee.toFixed(2);
document.getElementById('EPF18').value = epf_company.toFixed(2);
document.getElementById('basicallowan').value = basic_allow.toFixed(2);
document.getElementById('rentalallowan').value = rental_allow.toFixed(2);
document.getElementById('medicalallowan').value = medical_allow.toFixed(2);
document.getElementById('final_salary_fixed').value = totalsalary_all_value;
document.getElementById('LOP_DAYS').value = lopdaysss;
document.getElementById('EPF_BASIC').value = epf_basic;

document.getElementById('deduction').value = deductions;
document.getElementById('increment').value = increments;
document.getElementById('EPF833').value = epfcomp833;
document.getElementById('EPF367').value = epfcomp367;

document.getElementById('conveyance').value = convenience_final;


return;
}


else if (company_basic_pay > 10000) {
let monthlyWorkingDays = parseInt(document.getElementById('Total_no_of_days').value);
let employee_WorkingDays = parseInt(document.getElementById('emp_working').value);
let exactDaysInput = document.getElementById('final_emp_working');
let convenience = parseFloat(document.getElementById('Convenience').value);
let ot = parseFloat(document.getElementById('ot').value);
let advance = parseFloat(document.getElementById('Advance').value);
let totalsalry = parseFloat(document.getElementById('totalsalary').value);
let lopdays = parseFloat(document.getElementById('LOP_DAYS').value);
let employee_WorkingDays_epf = parseInt(document.getElementById('emp_working').value);


if (monthlyWorkingDays === employee_WorkingDays) {
employee_WorkingDays = monthlyWorkingDays - (-1);
} else if (monthlyWorkingDays === employee_WorkingDays + 1) {
employee_WorkingDays = monthlyWorkingDays;
} else if (monthlyWorkingDays === employee_WorkingDays - (-2)) {
employee_WorkingDays = monthlyWorkingDays - 1;
} else if (monthlyWorkingDays === employee_WorkingDays - (-3) || monthlyWorkingDays > -(-3)) {
exactDaysInput.value = employee_WorkingDays;
}

var perDaySalary = company_basic_pay / monthlyWorkingDays;
var final_BasicSalary = perDaySalary * employee_WorkingDays;
document.getElementById('totalsalary').value = final_BasicSalary;
exactDaysInput.value = employee_WorkingDays;



var epf_basic = (3334/monthlyWorkingDays)*employee_WorkingDays;
var epf_employee = epf_basic * 0.12;
var epf_company = epf_basic * 0.12;
var esi_employee = epf_basic * 0.0075;
var esi_company = epf_basic * 0.0325;
var additional_allow = (company_basic_pay/monthlyWorkingDays)*employee_WorkingDays;
var basic_allow = additional_allow *0.45;
var rental_allow = additional_allow *0.25;
var medical_allow = additional_allow *0.30;
var convenience_final=(convenience/monthlyWorkingDays)*employee_WorkingDays
var totalsalary_all_value = (convenience_final + ot + final_BasicSalary)-(advance+epf_employee+esi_employee);
var lopdaysss= monthlyWorkingDays - employee_WorkingDays;
var increments=basic_allow + medical_allow + rental_allow+ot+convenience;

var deductions=epf_employee+esi_employee+advance;
var epfcomp833=epf_basic*0.0833;
var epfcomp367=epf_basic*0.0367;


document.getElementById('esi75').value = esi_employee.toFixed(2);
document.getElementById('esi325').value = esi_company.toFixed(2);
document.getElementById('EPF12').value = epf_employee.toFixed(2);
document.getElementById('EPF18').value = epf_company.toFixed(2);
document.getElementById('basicallowan').value = basic_allow.toFixed(2);
document.getElementById('rentalallowan').value = rental_allow.toFixed(2);
document.getElementById('medicalallowan').value = medical_allow.toFixed(2);
document.getElementById('final_salary_fixed').value = totalsalary_all_value;
document.getElementById('LOP_DAYS').value = lopdaysss;
document.getElementById('EPF_BASIC').value = epf_basic;
document.getElementById('deduction').value = deductions;
document.getElementById('increment').value = increments;
document.getElementById('EPF833').value = epfcomp833;
document.getElementById('EPF367').value = epfcomp367;


document.getElementById('conveyance').value = convenience_final;

return;

}


}
else {
// Invalid salary value
document.getElementById("result").innerHTML = "Please provide a valid basic salary.";
}
}
var inputs = document.querySelectorAll("#Basic");
inputs.forEach(function(input) {
input.addEventListener("input", calculateTotalWorkingDays);
});
calculateTotalWorkingDays();
</script>

</body>
</html>