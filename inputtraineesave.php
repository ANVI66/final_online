<?php
include "INCLUDES/conn.php";

// Get data from POST request
$id = $_POST['id'];
// $code = isset($_POST['emp_code']) ? $_POST['emp_code'] : '';
$emp_name = $_POST['emp_name'];
$department = $_POST['department'];
$designation = $_POST['designation'];
$joining_date = $_POST['joining_date'];
$company = $_POST['company'];
$basic = $_POST['basic'];
$bank_name = $_POST['bank_name'];
$account_number = $_POST['account_number'];
$ifsc_code = $_POST['ifsc_code'];
$salary_account = $_POST['salary_account'];
$esi_epf = isset($_POST['esi_epf']) ? $_POST['esi_epf'] : '';
$esi_number = isset($_POST['esi_number']) ? $_POST['esi_number'] : '';
$epf_number = isset($_POST['epf_number']) ? $_POST['epf_number'] : '';
$status = $_POST['status'];
$mobile = $_POST['mobile'];

// Insert data into database
$sql = "INSERT INTO employee_data (
    -- ID,
    CODE,
    NAME,
    DEPARTMENT,
    WORKNATURE,
    JOININGDATE,
    BRANCH,
    BASIC,
    BANKNAME,
    ACCOUNTNO,
    IFSCCODE,
    SALARYACCOUNT,
    ESI_EPF,
    ESINO,
    EPFNO,
    STATUS,
    MOBILE
)
VALUES (
    '$id',
    -- '$code',
    '$emp_name',
    '$department',
    '$designation',
    '$joining_date',
    '$company',
    '$basic',
    '$bank_name',
    '$account_number',
    '$ifsc_code',
    '$salary_account',
    '$esi_epf',
    '$esi_number',
    '$epf_number',
    '$status',
    '$mobile'
)";


if (mysqli_query($conn, $sql)) {
    // Registration successful - show popup and refresh page
    echo '<script>alert("Registration successful!");</script>';
    echo '<script>location.replace("trainee.php");</script>';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>