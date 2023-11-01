<?php
require '../connection.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empcode = $_POST["empcode"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $image_path = "";

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $targetDirectory = "assets/empimages/";

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image_path = $targetFile;
        }

        // Update image path in employee_data
        $sqlImageUpdate = "UPDATE employee_data SET image_path = ? WHERE CODE = ?";
        $stmtImageUpdate = $conn->prepare($sqlImageUpdate);
        $stmtImageUpdate->bind_param("ss", $image_path, $empcode);

        if ($stmtImageUpdate->execute()) {
            echo "<script>alert('Data saved successfully');</script>";
        } else {
            echo "Error updating image path in employee_data: " . $stmtImageUpdate->error;
        }

        $stmtImageUpdate->close();
    }

    // Update mobile number in the database
    $sqlMobileUpdate = "UPDATE employee_data SET MOBILE = ? WHERE CODE = ?";
    $stmtMobileUpdate = $conn->prepare($sqlMobileUpdate);
    $stmtMobileUpdate->bind_param("ss", $mobile, $empcode);

    if ($stmtMobileUpdate->execute()) {
        echo "<script>alert('Data saved successfully');</script>";
    } else {
        echo "Error updating mobile number in employee_data: " . $stmtMobileUpdate->error;
    }

    $stmtMobileUpdate->close();

    // Update email in the usertable table
    $sqlEmailUpdate = "UPDATE usertable SET email = ? WHERE name = ?";
    $stmtEmailUpdate = $conn->prepare($sqlEmailUpdate);
    $stmtEmailUpdate->bind_param("ss", $email, $empcode);
    
    if ($stmtEmailUpdate->execute()) {
        echo "<script>alert('Data saved successfully');</script>";
    } else {
        echo "Error updating email in usertable: " . $stmtEmailUpdate->error;
    }
    
    $stmtEmailUpdate->close();
    

    $conn->close();
}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.5/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style> 
 .profile_contain
 {
    text-align:center;
    margin-top:25px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
 }

        /* Style the submit button */
        input[type="submit"] {
    background-color: #007bff;
    height: 38px;
    color: white;
    border: none;
    width: 68px;
    border-radius: 5px;
    padding: 8px 13px;
    margin-top: -1px;
    cursor: pointer;
}
/* 
.branch-label {
    display: inline-block;
    float: left;
    margin-left: 20px;
}


.branch-input {
    background-color: orange;
    margin-left: -104%;
    margin-bottom: 58px;
} */

        /* Style the circle image */
        .circle-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        .form-control {
    display: block;
    
    width: 95%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;}
        /* Style the form container */
        .form-horizontal {
            width: 40%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        }

        /* Style form fields and labels */
        .form-group {
            margin-bottom: 20px;
        }

        /* Add a margin between the form fields and icons */
        .input-group i {
            margin-left: 10px;
            cursor: pointer;
        }

        /* Style for the left and right columns */
        .col-lg-6 {
            text-align: left;
        }

        /* Style for the Save and Cancel buttons */
        .form-buttons {
            text-align: center;
        }
        .form-control.project-department {
    background-color: #f0f0f0;
    color: #333;
    margin-left: -218px;
}
.project-department-label {
    color: black;
    margin-left: -218px;
}
.input-group .edit-icon {
    
    line-height: 38px;
}

.input-group {
            position: relative;
        }
        .edit-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        label {
    display: inline-block;
    float: left;
    margin-left: 20px;
}
    .edit-icon:hover {
        color: #0056b3;
    }
    input[type="text"] {
        background-color: #f0f0f0;
    }
    .input-group .editable-field {
    background-color: white;
}
.centered {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Style the round image */
.rounded-image {
    margin-top: 10px;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  overflow: hidden;
}

/* Style the image within the rounded container */
.rounded-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
    </style>
</head>
<body>

<?php 
include_once "../connection.php";
include_once "../includes/header.php";

$sql_employee = "SELECT image_path,EMAIL,DEPARTMENT,Project_department,BRANCH,BASIC,BANKNAME,ACCOUNTNO,ESINO,EPFNO,MOBILE,STATUS FROM employee_data WHERE DELSTATUS = '1' AND CODE = '$employeeCode' AND NAME ='$employeeName' AND STATUS = 'Working'";

$result = mysqli_query($conn, $sql_employee);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<div class="container profile_contain">
    <?php // Now, you can fetch data from the result set.
while ($row = mysqli_fetch_assoc($result)) { 
    $emp_mobile = $row['MOBILE'];
    $empstatus = $row['STATUS'];
    $basic = $row['BASIC'];
    $esino = $row['ESINO'];
    $projectdepartment = $row['Project_department'];
    $bankname = $row['BANKNAME'];
    $accountno = $row['ACCOUNTNO'];
    $epfno = $row['EPFNO'];
    $branch = $row['BRANCH'];
    $image_path = $row['image_path'];

    ?>

    <h3>Personal Info</h3>

    <form method="POST" enctype="multipart/form-data">
    <div class="mb-3 centered">
    <div class="rounded-image">
    <img id="profile-image" src="<?php echo $image_path; ?>" alt="Profile Image" onclick="document.getElementById('image-file').click();" style="cursor: pointer;">
</div>
<input type="file" name="image" id="image-file" style="display: none;">

</div>



        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input class="form-control" name="empname" type="text" value="<?php echo $employeeName?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Emp ID:</label>
                    <input class="form-control" name="empcode" type="text" value="<?php echo $employeeCode?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Department:</label>
                    <input class="form-control" name="department" type="text" value="<?php echo $EMP_DEPARTMENT; ?>" readonly>
                </div>
                <div class="mb-3">
        <label class="form-label">Mobile:</label>
        <input class="form-control" name="mobile" type="text" value="<?php echo $emp_mobile; ?>">
    </div>


                <div class="mb-3">
                    <label class="form-label">Basic:</label>
                    <input class="form-control" name="basic" type="text" value="<?php echo $basic; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">ESI No:</label>
                    <input class="form-control" name="esino" type="text" value="<?php echo $esino; ?>" readonly>
                </div>
            </div>

            <div class="col-md-6">
            <div class="mb-3">
        <label class="form-label">Email:</label>
        <input class="form-control" name="email" type="text" value="<?php echo $useremail; ?>">

    </div>
                <div class="mb-3">
                    <label class="form-label">EMP Status:</label>
                    <input class="form-control" name="empstatus" type="text" value="<?php echo $empstatus; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Project Dept:</label>
                    <input class="form-control" name="projectdepartment" type="text" value="<?php echo $projectdepartment; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank Name:</label>
                    <input class="form-control" name="bankname" type="text" value="<?php echo $bankname; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account No:</label>
                    <input class="form-control" name="accountno" type="text" value="<?php echo $accountno; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">EPF No:</label>
                    <input class="form-control" name="epfno" type="text" value="<?php echo $epfno; ?>" readonly>
                </div>
                <div class="mb-3">
    <label class="form-label branch-label" style="margin-left: -34.5rem; margin-top: -36px;">Branch:</label>
    <input class="form-control branch-input" style="margin-left: -35.5rem; margin-top: 43px;"  name="branch" type="text" value="<?php echo $branch; ?>" readonly>
</div>
            </div>
        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Save" name = ""  onclick="updateImageSrc();">
            <a href="profile.php" class="btn btn-default">Cancel</a>
        </div>
        <script>
    function updateImageSrc() {
        // Get the selected file input element
        var imageInput = document.getElementById("image-file");

        // Get the image element
        var profileImage = document.getElementById("profile-image");

        // Check if a file has been selected
        if (imageInput.files && imageInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Update the image source with the newly selected image
                profileImage.src = e.target.result;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }
</script>



    </form>


</div>

<?php } ?>

</body>
</html>
<script>
 
    var empcode = "<?php echo $empcode; ?>";
    var mobile = "<?php echo $mobile; ?>";
    var department = "<?php echo $department; ?>";

    function populateInputBoxes() {
        document.getElementsByName("empcode")[0].value = empcode;
        document.getElementsByName("mobile")[0].value = mobile;
        document.getElementsByName("department")[0].value = department;

        var empStatusInput = document.getElementsByName("empstatus")[0];

        if (empStatusInput) {
            if (empcode.startsWith("EMP")) {
                empStatusInput.value = "Employee";
            } else if (empcode.startsWith("TR")) {
                empStatusInput.value = "Trainee";
            } else {
                empStatusInput.value = "";  // Set a default value if needed
            }
        }
    }

    window.onload = populateInputBoxes;
    populateInputBoxes();
</script>
