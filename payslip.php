

<?php
session_start(); // Resume the session


include "includes/conn.php";



function generateEmpID($conn)
{
    $query = "SELECT MAX(CAST(SUBSTRING(CODE, 4) AS UNSIGNED)) AS max_id FROM employee_data WHERE CODE LIKE 'EMP%'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $lastEmpID = $row['max_id'];

    if (empty($lastEmpID)) {
        $empID = "EMP001";
    } else {
        $nextEmpID = $lastEmpID + 1;
        $empID = "EMP" . sprintf('%03d', $nextEmpID);
    }
    
    return $empID;
}


// Call the function to get the next available employee code
$nextEmployeeCode = generateEmpID($conn);
?>

    <?php include "includes/header.php";?>

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
    <link rel="stylesheet" href="css/payslip.css"/>
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
  .container1{height: fit-content;}


  
  button.back-btn {
    margin-top: -4.2rem;
    margin-left:  74.7pc;
    border: none;
    height: 33px;
    color: white;
    background-color: #FB5607;
    width: 57px;
    border-radius: 4px;
}
</style>


<body>
 

      <div id="payslipContent">
        <div class="slide-container">                                                           
        <div class="slide" onclick="toggleSidebar()"></div>
      </div>

    
  <div class="whole_container">  
<div class="row buttons"> 

  <button type="text" class="view">
          <a href="save.php">Candidate list</a>
        </button>
        <!-- <img style="width:100px; height:100px;" src="assets/images/back1.jpg" alt="back-img"/> -->

      </div> 
    <form id="myForm" action="inputsave.php" method="post" >
      <div class="button1">     
        <button type="button" class="view2" id="addEmployeeBtn" onclick="toggleForm()">
  +Add New Employee
</button>


</div>     
<div id="form_hide" style="display:none">
      <div class="container1">
        <div class="scroll-container">     
          <div class="row">
            <div class="col-lg-6 rt">
              <div class="col-lg-3 lt"></div>
            </div>
          </div>
          <div class="button1">
  <button type="submit" class="view1" name="submit" value="Submit">Save</button>

</div>



          <div class="row">
            <div class="col-12">Emp Code:
            <input type="text" class="form-control emp_code" name="id" value="<?php echo $nextEmployeeCode; ?>" readonly required>
            </div>
            <div class="col-12">Company:
              <input type="text" class="form-control" name="company" value="Eloiacs Software Pvt Ltd" readonly required>
            </div>
          </div>

          <div class="row">
            <div class="col-12">Candidate Name:
              <input type="text" class="form-control" name="emp_name" required>
            </div>
            <div class="col-12">Department:
              <select name="department" class="form-control des" required>
                <option value="" disabled selected hidden>Select Designation</option>
                <option>Admin</option>
                <option>Project Team</option>
                <option>Developing</option>
                <option>EPub</option>
                <option>BPO</option>
                <option>XML</option>
                <option>Designer</option>
                <option>Trainer</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-12">Designation/nature of work:
              <input type="text" class="form-control des" name="designation" required>
            </div>
            <div class="col-12">Date of Joining:
              <input type="date" name="joining_date" class="form-control date" required min="2023-01-01" max="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-12">Basic Salary:
              <input type="text" class="form-control" name="basic" required pattern="[0-9]*">
            </div>
            <div class="col-12">Bank Name:
              <input type="text" class="form-control" name="bank_name" required>
            </div>
          </div>

          <div class="row">
            <div class="col-12">Account Number:
              <input type="text" class="form-control" name="account_number" required pattern="[0-9]*">
            </div>
            <div class="col-12">IFSC Code:
              <input type="text" class="form-control" name="ifsc_code" required>
            </div>
          </div>

          <div class="row">
            <div class="col-12">Salary Account:
              <select name="salary_account" class="form-control" required>
                <option value="" disabled selected hidden >Select</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
            <div class="col-12">ESI/EPF:
              <select name="esi_epf" id="esi_epf" class="form-control" onchange="toggleFields(this)" required>
                <option value="" disabled selected hidden>Select</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>
                   
          <div class="row">
            <div class="col-12" id="esi_num">ESI Number:
              <input type="text" class="form-control" name="esi_number" id="esi_number" required>
            </div>
            <div class="col-12" id="epf_num">EPF Number:
              <input type="text" class="form-control" name="epf_number" id="epf_number" required>
            </div>
          </div>



          
          <div class="row status">
            <div class="col-12">Status:
              <select name="status" class="form-control" id="employee_status" placeholder="Status" onchange="toggleExitDate(this)" required>
                
                <option value="Working" selected>Working</option>
                <option value="Exit">Exit</option>
              </select>
            </div>
            <div class="col-12"></div>
          </div>
        </div>
        <div class="row">
            <div class="col-12">Mobile Number:
            <input type="text" name="mobile" placeholder="Mobile Number" class="form-control" required pattern="[0-9]*">
            </div>

      </div>
      </div>
    </form>
  </div>
</div>
</div>

<script>
  function toggleForm() {
  var formHideDiv = document.getElementById("form_hide");
  var backButton = document.querySelector(".back-btn");

  if (formHideDiv.style.display === "none") {
    formHideDiv.style.display = "block";
    backButton.style.display = "block";

  } else {
    formHideDiv.style.display = "none";
   backButton.style.display = "none";
  }
}

</script>

<!-- 
<?php



if ($_SERVER['submit'] === 'POST') {
    // Perform form validation and processing here

    // If form validation is successful
    if ($validation_passed) {
        // Perform necessary actions and database operations

        // Echo a success message with a delayed redirect
        $message = "Form submitted successfully!";
        echo "<script>
                alert('$message');
                setTimeout(function() {
                    window.location.href='payslip.php';
                }, 3000); // 3 seconds delay
              </script>";
        exit;
        
    } else {
        // Echo an error message
        $message = "Form submission failed. Please check your input and try again.";
        echo "<script>
                alert('$message');
                setTimeout(function() {
                    history.go(-1);
                }, 3000); // 3 seconds delay
              </script>";
        exit;
    }
}
?> -->




<script>
  document.getElementById("esi_num").style.display="none";
  document.getElementById("epf_num").style.display="none";
  function toggleFields(selectElement) {
    var esi_number = document.getElementById("esi_num");
    var epf_number = document.getElementById("epf_num");

    if (selectElement.value === "Yes") {
      esi_number.style.display = "block";
      epf_number.style.display = "block";
    } 
    else {
      esi_number.style.display = "none";
      epf_number.style.display = "none";
    }
  }
</script>


<script>
  $(document).ready(function() {
    $("#myForm").validate({
      rules: {
        id: {
          required: true,
          minlength: 6,
        },
        emp_name: {
          required: true,
          minlength: 2,
        },
        department: {
          required: true,
        },
        designation: {
          required: true,
        },
        joining_date: {
          required: true,
        },
        company: {
          required: true
        },
        bank_name: {
          required: true,
        },
        account_number: {
          required: true,
          minlength: 10
        },
        ifsc_code: {
          required: true,
          minlength: 8,
          maxlength: 15
        },
        salary_account: {
          required: true
        },
        esi_epf: {
          required: true
        },
        esi_number: {
          required: true
        },
        epf_number: {
          required: true
        },
        status: {
          required: true
        },
      },
      messages: {
        id: {
          required: "Please check",
          minlength: "Name should be at least 6 characters long"
        },
        emp_name: {
          required: "Please enter Employee Name",
          minlength: "Name should be at least 2 characters long"
        },
        department: {
          required: "Please enter department"
        },
        designation: {
          required: "Please enter the designation",
        },
        joining_date: {
          required: "Please enter joining date"
        },
        company: {
          required: "Please enter company name"
        },
        bank_name: {
          required: "Please enter Bank name",
        },
        account_number: {
          required: "Please enter Account Number",
        },
        ifsc_code: {
          required: "Please enter IFSC code",
          minlength: "Please enter below 15 characters"
        },
        salary_account: {
          required: "Please confirm Yes/No"
        },
        esi_epf: {
          required: "Please confirm Yes/No"
        },
        esi_number: {
          required: "Please enter ESI Number"
        },
        epf_number: {
          required: "Please enter EPF Number"
        },
        status: {
          required: "Please confirm status"
        }
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>

<script>
    function toggleSidebar() {
        var slidebar = document.querySelector(".slide");
        slidebar.classList.toggle("active");

        // Check if the sidebar is active
        if (slidebar.classList.contains("active")) {
            // If it's active, redirect to trainee.php
            window.location.href = "trainee.php";
        } else {
            // If it's not active, do nothing or handle it as needed
        }

  var sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("active");


    }
</script>
<!-- <script>
    function toggleSidebar() {
        var slidebar = document.querySelector(".slide");
        var payslipContent = document.getElementById("payslipContent");
        var traineeContent = document.getElementById("traineeContent");

        slidebar.classList.toggle("active");

        if (slidebar.classList.contains("active")) {
            // If the sidebar is active, show trainee.php content and hide payslip.php content
            payslipContent.style.display = "none";
            traineeContent.style.display = "block";
        } else {
            // If the sidebar is not active, show payslip.php content and hide trainee.php content
            payslipContent.style.display = "block";
            traineeContent.style.display = "none";
        }
    }
</script> -->



</body>
</html>