<?php
session_start(); // Resume the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to index.php
    header("Location: index.php");
    exit; // Terminate the script after redirection
}
?>
  <?php include_once ('includes/header.php'); ?>
<?php

include_once 'includes/conn.php';
if(isset($_POST['edit'])){
    $id=$_POST['ID'];
    $name = $_POST['NAME'];                                   
$department = $_POST['DEPARTMENT'];
$workNature = $_POST['WORKNATURE'];
$joiningDate = $_POST['JOININGDATE'];
// $company = $_POST['COMPANY'];
$basic = $_POST['BASIC'];             
$bankName = $_POST['BANKNAME'];
$accountNo = $_POST['ACCOUNTNO'];
$ifscCode = $_POST['IFSCCODE'];
$salaryAccount = $_POST['SALARYACCOUNT'];
$esiEpf = $_POST['ESI_EPF'];
$esiNo = $_POST['ESINO'];
$epfNo = $_POST['EPFNO'];
$status = $_POST['STATUS'];
$exitdate=$_POST['EXITDATE'];
$mobile=$_POST['mobile'];


$query="UPDATE employee_data SET NAME='$name',DEPARTMENT='$department',WORKNATURE='$workNature',JOININGDATE='$joiningDate',BASIC='$basic',BANKNAME='$bankName',ACCOUNTNO='$accountNo',IFSCCODE='$ifscCode',SALARYACCOUNT='$salaryAccount',ESI_EPF='$esiEpf',ESINO='$esiNo',EPFNO='$epfNo',STATUS='$status',EXITDATE='$exitdate',MOBILE='$mobile' where CODE='$id'";

$query_run=mysqli_query($conn,$query);

if($query_run){


  
    
    ?>

    <script>
alert("Successfully Updated");
window.location.href='traineesave.php';
    </script>

    <?php

}

else{
    ?>
    <script>
alert("Not Updated");
window.location.href='traineesave.php?error';
    </script>

    <?php
}
}

$result=mysqli_query($conn,"SELECT * FROM employee_data where id='".$_GET['id']."'");

$row=mysqli_fetch_array($result);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Update Form</title>
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
    <link href="css/traineeupdate.css" rel="stylesheet"/>
<style>

</style>

<body>
  
<div class="row">
  <div class="col-md-1"></div>
<div class="col-md-11">

<div class="container">

<form action="" method="post" >
<button class="btn btn-success" type="submit" id="edit" name="edit" >Save</button> 
<div class="container1">

<div class="row">
<div class="col-md-2">Employee Code :</div>
<div class="col-md-3"><input type="text"  name="ID" value="<?php echo $row["CODE"]; ?>"required></div>
<div class="col-md-1"></div>
<div class="col-md-2">Company :</div>
<div class="col-md-3"><input type="text" name="COMPANY" value="Eloiacs Software" required></div>
</div>

<div class="row">
<div class="col-md-2">Candidate Name :</div>
<div class="col-md-3"><input type="text"  name="NAME"  value="<?php echo $row["NAME"]; ?>" required></div>
<div class="col-md-1"></div>
<div class="col-md-2">Department :</div>
<div class="col-md-3"><select type="text" name="DEPARTMENT" required>
<option value="">Select Designation :</option>
<option <?php if ($row["DEPARTMENT"] == "Admin") echo "selected"; ?>>Admin</option>
<option <?php if ($row["DEPARTMENT"] == "Project Team") echo "selected"; ?>>Project Team</option>
<option <?php if ($row["DEPARTMENT"] == "Developing") echo "selected"; ?>>Developing</option>
<option <?php if ($row["DEPARTMENT"] == "EPub") echo "selected"; ?>>EPub</option>
<option <?php if ($row["DEPARTMENT"] == "BPO") echo "selected"; ?>>BPO</option>
<option <?php if ($row["DEPARTMENT"] == "XML") echo "selected"; ?>>XML</option>
<option <?php if ($row["DEPARTMENT"] == "Designer") echo "selected"; ?>>Designer</option>
<option <?php if ($row["DEPARTMENT"] == "Trainer") echo "selected"; ?>>Trainer</option>
</select>
</div>           
</div>

<div class="row">
<div class="col-md-2">Designation/nature of work :</div>
<div class="col-md-3"><input type="text" name="WORKNATURE" value="<?php echo $row["WORKNATURE"]; ?>" required></div>
<div class="col-md-1"></div>
<div class="col-md-2">Date of Joining :</div>
<div class="col-md-3"><input type="date" name="JOININGDATE" value="<?php echo $row["JOININGDATE"]; ?>" required></div>
</div>

<div class="row">

<div class="col-md-2">Basic Salary :</div>
<div class="col-md-3"><input type="text" name="BASIC" value="<?php echo $row["BASIC"]; ?>" required></div>
<div class="col-md-1"></div>
<div class="col-md-2">Bank Name :</div>
<div class="col-md-3"><input type="text" name="BANKNAME" value="<?php echo $row["BANKNAME"]; ?>" required></div>
</div>
<div class="row">
<div class="col-md-2">Account Number :</div>
<div class="col-md-3"><input type="text" name="ACCOUNTNO" value="<?php echo $row["ACCOUNTNO"]; ?>" required></div>
<div class="col-md-1"></div>
<div class="col-md-2">IFSC Code :</div>
<div class="col-md-3"><input type="text" name="IFSCCODE" value="<?php echo $row["IFSCCODE"]; ?>" required></div>
</div>

  <div class="row">
    <div class="col-md-2">Salary Account :</div>
    <div class="col-md-3">
      <select type="text" name="SALARYACCOUNT" required>
        <option value="">Select</option>
        <option <?php if ($row["SALARYACCOUNT"] == "Yes") echo "selected"; ?>>Yes</option>
        <option <?php if ($row["SALARYACCOUNT"] == "No") echo "selected"; ?>>No</option>
      </select>
    </div>
    <div class="col-md-1">></div>
    <div class="col-md-2">Mobile Number :</div>
<div class="col-md-3"><input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo $row["MOBILE"]; ?> " required></div>
</div>
    <div class="row" style="display:none">
    <div class="col-md-1"></div>
    <div class="col-md-2">ESI/EPF :</div>
    <div class="col-md-3">
      <select type="text" name="ESI_EPF" required onchange="updateESI_EPFFields(this)">
        <option value="">Select</option>
        <option <?php if ($row["ESI_EPF"] == "Yes") echo "selected"; ?>>Yes</option>
        <option <?php if ($row["ESI_EPF"] == "No") echo "selected"; ?>>No</option>
      </select>
    </div>
 
    <div class="col-md-2">ESI Number :</div>
    <div class="col-md-3">
      <input type="text" name="ESINO" id="esino" value="<?php echo $row["ESINO"]; ?>" >
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">EPF Number :</div>
    <div class="col-md-3">
      <input type="text" name="EPFNO" id="epfno" value="<?php echo $row["EPFNO"]; ?>" >
    </div>
  </div>
<div class="row">
<div class="col-md-2">
Status :</div>
<div class="col-md-3">
<select type="text" name="STATUS" id="exit" onchange="showHide()" required>
<option value="">Select Employee status :</option>
<option value="Working" <?php if ($row["STATUS"] == "Working") echo "selected"; ?>>Working</option>
<option value="Exit" <?php if ($row["STATUS"] == "Exit") echo "selected"; ?>>Exit</option>
</select>
</div>

<div class="col-md-1"></div>

</div>


<div name="hidden-panel" id="hidden-panel">
  <div class="row">
<div class="col-md-2">
Exit Date :</div>
<div class="col-md-3">
<input type="date" name="EXITDATE" id="exitdate">
</div>
</div>
</div>

<div class="row">


</div>
</div>
</form>
</div>
</div>
</div>   
<div>     
</div>                                                                                                                        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>


function showHide() {
    let travelhistory = document.getElementById('exit')
    if (travelhistory.value == 'Exit') {
        document.getElementById('hidden-panel').style.display = 'block'
    } else {
        document.getElementById('hidden-panel').style.display = 'none'
    }
}

  $(document).ready(function() {
    $('form').validate({
      rules: {
        ID: {
          required: true,
          rangelength: [1, 8]
        },
        NAME: {
          required: true,
          rangelength: [1, 20]
        },

        // Add the same rules for other input fields that require a character limit
        // DEPARTMENT, WORKNATURE, JOININGDATE, COMPANY, BASIC, BANKNAME, ACCOUNTNO, IFSCCODE, SALARYACCOUNT, ESI_EPF, STATUS


        DEPARTMENT: {
          required: true,
          rangelength: [1, 20]
        },WORKNATURE: {
          required: true,
          rangelength: [1, 20]
        },JOININGDATE: {
          required: true,
          rangelength: [1, 20]
        },COMPANY: {
          required: true
        },BASIC: {
          required: true,
          rangelength: [1, 20]
        },BANKNAME: {
          required: true,
          rangelength: [1, 20]
        },ACCOUNTNO: {
          required: true,
          rangelength: [1, 20]
        },IFSCCODE: {
          required: true,
          rangelength: [1, 20]
        },SALARYACCOUNT: {
          required: true,
          rangelength: [1, 20]
        },ESI_EPF: {
          required: true,
          rangelength: [1, 20]
        },STATUS: {
          required: true,
          rangelength: [1, 20]
        }
       
      },
      messages: {
        ID: {
            required: 'Please Enter this field',
            rangelength: 'the lenth is too long'
        },
        NAME: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        // Add the same messages for other input fields
        DEPARTMENT: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        WORKNATURE: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        JOININGDATE: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        COMPANY: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        BASIC: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        }, 
        BANKNAME: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        ACCOUNTNO: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        IFSCCODE: {
          required: 'Field is empty , Fill This',
          rangelength: 'the lenth is too long'
        },
        SALARYACCOUNT: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
       
        EPFNO: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },
        STATUS: {
          required: 'Please Enter this field',
          rangelength: 'the lenth is too long'
        },

      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>

<script>
  function updateESI_EPFFields(selectElement) {
    var esiNumberField = document.getElementById("esino");
    var epfNumberField = document.getElementById("epfno");

    if (selectElement.value === "No") {
      esiNumberField.value = "0";
      epfNumberField.value = "0";
      esiNumberField.setAttribute("disabled", "disabled");
      epfNumberField.setAttribute("disabled", "disabled");
    } else {
      esiNumberField.removeAttribute("disabled");
      epfNumberField.removeAttribute("disabled");
    }
  }
</script>



</body>
</html>

