<?php
session_start(); // Resume the session


include "includes/connection.php";



function generateTRID($conn)
{
    $query = "SELECT MAX(ID) AS max_id FROM trainee_data";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $lastID = $row['max_id'];

    if (empty($lastID)) {
        $empID = "TR001";
    } else {
        $empID = "TR" . sprintf('%03d', ($lastID % 999) + 1);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainee Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <!-- jQuery library -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>


<style>
.row{
  width: 100%;
  margin-bottom:9px;
}

.row.status {
    display: none;
}
.container1 { 
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    margin: 14% 5% 4% 21%;
    width: 93%;
    height: 100%;
    border-radius: 5px;
background: rgba(217, 217, 217, 0.40);
}
button.view1 {
    padding: 2px 12px;
    border-radius: 5px;
    color: white;
    border: none;                 
    right: 24%;
    top: 111px;
    position: absolute;
    background-color: #FB5607;
}
button.view1:hover{                       
  color: black;
background-color: white;
border: 1px solid #FB5607;
}
button.view {
  width:10%;
  padding: 5px 16px;
  border-radius: 5px;
background-color: #FB5607;
box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border:none;
  top: 108px;
    right: 29.5%;
    position: absolute;
}
button.view:hover{                       
  color: black;
background-color: white;
border: 1px solid #FB5607;
}
button.view a{
  color: white;
  text-decoration: none;
}


input{

width: 425px;
height: 35px;
flex-shrink: 0;
border-radius: 5px;
border: 1px solid #ced4da;
background: #FFF;
margin-bottom: 10px;
margin-right: 10px;
}

select{
width: 370px;
height: 36px;
flex-shrink: 0;
border-radius: 5px;
border: 0.5px solid #FB5607;
background: #FFF;
margin-bottom: 10px;
}
.form-check-input{
width: 18px;
height: 16px;
flex-shrink: 0;
border: 1px solid #000;
}
.form-check-label{
color: #000;
font-size: 11px;
font-family: Inter;
font-style: normal;
font-weight: 400;
line-height: normal;
letter-spacing: 0.3px;
margin-top: 4px;
}
.col {
    font-size: 13px;
    margin-bottom: 2px;
}
.view:hover a{
  color: black;
}


button.view2 {
    padding: 6px 12px;
    border-radius: 5px;
    color: white;
    border: none;
    right: 29%;
    top: 12px;
    position: absolute;
    background-color: #FB5607;
}

/*  Mobile responsive  */
  @media (max-width: 767px) {
    button#addEmployeeBtn {
    left: 65px;
    margin-top: 4.5px;
    padding: 2.5px;
    width: 115px;
    font-size: 11px;
}
button.view {
    margin-top: 4px;
    font-size: 11px;
    padding: 2px 5px;
    right: 15%;
    width: 24%;
    margin-right: 6%;
}
button.view1 {
    width: 32px;
    margin-top: 2.1px;
    font-size: 11px;
    padding: 2px 5px;
    right: 15%;
}
* {
    font-size: 11px;
}
button#addEmployeeBtn {
  
    margin-top: 4.5px;
    padding: 2.5px;
    width: 115px;
    font-size: 11px;
}
.col-md-9 {
    margin-top: 10% !important;
    width: 84% !important;
    margin-left: 18% !important;
    height: 100vh;
}
 


  }

  @media (min-width: 768px) and (max-width:1024px) {    
    button#addEmployeeBtn {
      width:150px;
    left: 270px;
}
button.view {
    margin-top: 4px;
    font-size: 15px;
    padding: 2px 5px;
    right: 15%;
    width: 24%;
    margin-right: 6%;
}
button.view1 {
    width: 53px;
    margin-top: 2.1px;
    font-size: 15px;
    padding: 2px 5px;
    right: 11% !important;
}
* {
    font-size: 15px;
}
button#addEmployeeBtn {
    margin-top: 4.5px;
    padding: 3px;
    width: 163px;
    font-size: 15px;
}
.box {
    margin-left: 6% !important;
}
  .col-md-9 {
    margin-top: 10%;
    width: 82% !important;
    margin-left: 19%;
    height: 100vh;
}
  }

  .btn-outline-secondary{
    margin-left: -43px;
    height: 35px;
    background-color:#FB5607;
}



.dropdown-menu.show {
    display: block;
    width: 19rem;
    margin-left: -135px;
}

</style>




<body>
<!----------------------- start header section  ---------------------------------->
<?php require_once "INCLUDES/header.php";?>
<!-----------------------end header section  ---------------------------------->
<div class="container">
    <?php
    include "connection.php";
    if ($user_position == "Admin" || $user_position == "General Manager") {
        ?>









<div class="row">
  <!-- <div class="col-md-3">
    <php include "nav.php";?>
  </div> -->
  <button type="text" class="view">
          <a href="trainee_empsave.php">Trainee list</a>
        </button>
  <div class="col-md-9">
    <form id="myForm" action="inputtraineesave.php" method="post" >
      <!-- <div class="button1">
      
        <button type="button" class="view2" id="addEmployeeBtn" onclick="toggleForm()">
  +Add New Trainee
</button>
      </div> -->
      
<div id="form_hide">
      <div class="container1">
        <div class="scroll-container">     
          <div class="row">
            <div class="col-lg-6 rt">
              <div class="col-lg-3 lt"></div>
            </div>
          </div>
          <div class="button1">
  <button type="submit" name="submit" class="view1" value="Submit">Save</button>
</div>


          <div class="row">
            <div class="col-md-6">Trainee Code:
              <input type="text" class="form-control emp_code" name="id" value="<?php echo generateTRID($conn); ?>" readonly required>
            </div>
            <div class="col-md-6">Company:
              <input type="text" class="form-control" name="company" value="Eloiacs Software Pvt Ltd" readonly required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Candidate Name:
              <input type="text" class="form-control" name="emp_name" required>
            </div>
            
            <div class="col-md-6">
            Department:




            

              <div class="input-group mb-3">
        <input type="text" class="form-control" id="department1" name="department" aria-label="Text input with dropdown button">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: -10px; color:white;">▼</button>
        <ul class="dropdown-menu dropdown-menu-end">
            <?php
            $sql = "SELECT `DEPARTMENT_ELOIACS` FROM `department_company` WHERE `DEPARTMENT_ELOIACS` IS NOT NULL";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $department = $row['DEPARTMENT_ELOIACS'];
                    echo "<li class='department-option'>" . $department . "</li>";
                }
            } else {
                echo "<li>No department found</li>";
            }
            ?>
        </ul>
    </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Designation/nature of work:
              <input type="text" class="form-control des" name="designation" required>
            </div>
            <div class="col-md-6">Date of Joining:
              <input type="date" name="joining_date" class="form-control date" required min="2023-01-01" max="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Basic Salary:
              <input type="text" class="form-control" name="basic" required pattern="[0-9]*">
            </div>
            <div class="col-md-6">Bank Name:
              <input type="text" class="form-control" name="bank_name" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Account Number:
              <input type="text" class="form-control" name="account_number" required pattern="[0-9]*">
            </div>
            <div class="col-md-6">IFSC Code:
              <input type="text" class="form-control" name="ifsc_code" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Salary Account:
              <select name="salary_account" class="form-control" required>
                <option value="" disabled selected hidden >Select</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
            <div class="col-md-6">ESI/EPF:
             <select name="esi_epf" id="esi_epf" class="form-control" onchange="toggleFields(this)" disabled required>
    <option value="" disabled selected hidden>Select</option>
    <option>Yes</option>
    <option selected>No</option>
</select>

            </div>
          </div>
                   
          <div class="row">
            <div class="col-lg-6" id="esi_num">ESI Number:
              <input type="text" class="form-control" name="esi_number" id="esi_number" required>
            </div>
            <div class="col-md-6" id="epf_num">EPF Number:
              <input type="text" class="form-control" name="epf_number" id="epf_number" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">Mobile Number:
            <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" class="form-control" required pattern="[0-9]*">
            </div>
            <div class="col-md-6">Project Department:
            <input type="text" class="form-control"  name="project_department" id="project_department">
            </div>
          </div>

                    
          <div class="row status">
            <div class="col-md-6">Status:
              <select name="status" class="form-control" id="employee_status" placeholder="Status" onchange="toggleExitDate(this)" required>
                
                <option value="Working" selected>Working</option>
                <option value="Exit" >Exit</option>
              </select>
            </div>
            <div class="col-md-6"></div>
          </div>

<!--           
          <div class="row status">
            <div class="col-md-6">Status:
              <select name="status" class="form-control" id="employee_status" placeholder="Status" onchange="toggleExitDate(this)" required>
               
              <option value="" disabled selected hidden>Select Employee status</option>
                <option value="Working">Working</option>
                <option value="Exit">Exit</option>
              </select>
            </div>
            <div class="col-md-6"></div>
          </div> -->
        </div>
      </div>
      </div>
    </form>
  </div>
</div>

<!-- <script>
  function toggleForm() {
  var formHideDiv = document.getElementById("form_hide");
  if (formHideDiv.style.display === "none") {
    formHideDiv.style.display = "block";
    
  } else {
    formHideDiv.style.display = "none";
   
  }
}
</script> -->

<!-- <php

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
          minlength: 5,
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
          minlength: "Name should be at least 5 characters long"
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





<!-- <script>
    // JavaScript to handle selecting dropdown menu items
    const departmentInput = document.getElementById('department1');
    const departmentOptions = document.querySelectorAll('.department-option');

    departmentOptions.forEach((option) => {
        option.addEventListener('click', () => {
            departmentInput.value = option.textContent;
        });
    });
</script> -->




<script>
    // JavaScript to handle selecting dropdown menu items
    const departmentInput = document.getElementById('department1');
    const departmentOptions = document.querySelectorAll('.department-option');

    departmentOptions.forEach((option) => {
        option.addEventListener('click', () => {
            departmentInput.value = option.textContent;
        });
    });

    // Add event listener to update project department when selecting from the dropdown
    departmentInput.addEventListener('input', function () {
        const selectedValue = this.value;
        const projectDepartmentInput = document.getElementById('project_department');
        projectDepartmentInput.value = selectedValue;
    });
</script>






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
</body>
</html>

<!-----------------------start Footer section  ---------------------------------->
<!-- <php require_once "INCLUDES/footer.php";?> -->
<!-----------------------end Footer section  ---------------------------------->
