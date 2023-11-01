<?php
include "conn.php";
if (isset($_POST['submit'])) {
    
    $code = $_POST['Code'];
    $current_month = $_POST['currentmonth'];

    // Check if the salary date and employee code already exist
    $existingQuery = "SELECT * FROM salary_data WHERE sCODE = '$code' AND   sCURRENTMONTH = '$current_month'";
    $existingResult = mysqli_query($conn, $existingQuery);

    if (mysqli_num_rows($existingResult) > 0) {
        // Error message if the salary date and employee code already exist
        echo '<script>alert("you already upload the salary for this employee");</script>';
        echo '<script>window.location.replace("trainee_salary_payroll.php");</script>';
    } else {

            $code = $_POST['Code'];
            $name = $_POST['Name'];
            $basic = $_POST['Basic'];
            $salaryacnt = $_POST['Salary_Account'];
            $bankname = $_POST['Bank_name'];
            $acntno = $_POST['Account_no'];
            $ifsccode = $_POST['Ifsc_code'];
            $esino = $_POST['ESI_no'];
            $epfno = $_POST['EPF_no'];
            $status = $_POST['Status'];
            $Overtime = $_POST['ot'];
            $total_working_days = $_POST['Total_no_of_days'];
            $esi75 = $_POST['esi75'];
            $esi325 = $_POST['esi325'];
            $epf12 = $_POST['EPF12'];
            $epf18 = $_POST['EPF18'];
            $totalsalary = $_POST['final_salary_fixed'];
            $basicallowance = $_POST['basicallowan'];
            $rentalallowance = $_POST['rentalallowan'];
            $medicalallowance = $_POST['medicalallowan'];
            $employworking = $_POST['emp_working'];
            $convenience = $_POST['Convenience'];
            $conv_final = $_POST['conveyance'];
            $advance = $_POST['Advance'];
            $DESIGNATION = $_POST['designation'];
            $deprtmnt = $_POST['deptmnt'];
            $lop_dys = $_POST['LOP_DAYS'];
            $joindate = $_POST['joindate'];
            $salarydate = $_POST['salary_date'];
            $increment = $_POST['increment'];
            $deduction = $_POST['deduction']; 
            $esi_epf = $_POST['esi_epf_value']; 
            $epf_basi = $_POST['EPF_BASIC'];
            $mobile = $_POST['mobile']; 
            $EPF833 = $_POST['EPF833']; 
            $EPF367 = $_POST['EPF367']; 
            $final_Working = $_POST['final_emp_working'];
            $current_month = $_POST['currentmonth'];
           
   


        
        
            $final = "INSERT INTO salary_data(sCODE, sNAME, sBASIC, sSALARY_ACCOUNT, sBANK_NAME, sACCOUNT_NUMBER, sIFSC_CODE, sESI_NUMBER, sEPF_NUMBER, sSTATUS, sOVER_TIME, sTOTAL_DAYS, sESI075, sESI325, sEPF12, sEPF18, sSALARY, sSALARY_DATE, sEMP_WORKING_DAYS,sCONV_GIVEN, sCONVIENCE, sADVANCE, sBASICALLOW, sMEDICALALLOW, sRENTALALLOW, sDESIGNATION, sDEPARTMENT, sLOSSPAY, sJOINING_DATE,sINCREMENT,sDEDUCTION, sESI_EPF,sEPFBASIC,sMOBILE,sEMP_COMP833,sEMP_COMP367,sFINALWORKINGDAYS,sCURRENTMONTH) VALUES ('$code', '$name', '$basic', '$salaryacnt', '$bankname', '$acntno', '$ifsccode', '$esino', '$epfno', '$status', '$Overtime', '$total_working_days', '$esi75', '$esi325', '$epf12', '$epf18', '$totalsalary', '$salarydate', '$employworking','$conv_final', '$convenience', '$advance', '$basicallowance', '$medicalallowance', '$rentalallowance', '$DESIGNATION', '$deprtmnt', '$lop_dys', '$joindate','$increment','$deduction','$esi_epf',' $epf_basi','$mobile','$EPF833','$EPF367','$final_Working','$current_month')";
        
            if (mysqli_query($conn, $final)) {
                // Update the BASIC value in the employee_data table
                $update_basic_query = "UPDATE employee_data SET BASIC = '$basic' WHERE id = '$code'";
                $update_basic_result = mysqli_query($conn, $update_basic_query);
    
                if ($update_basic_result) {
                    // The BASIC value has been updated successfully.
                    echo '<script>alert("Salary details saved successfully and BASIC value updated.");</script>';
                    echo '<script>window.location.replace("trainee_salary_payroll.php");</script>';
                } else {
                    echo "Error updating BASIC value in employee_data: " . mysqli_error($conn);
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    
    mysqli_close($conn);
    ?>