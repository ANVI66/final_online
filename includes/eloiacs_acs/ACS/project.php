<?php
    include "includes/connection.php";
    $nextBatchNumber = '';function generateBatchNumber($conn) {
    $lastBatchNumberQuery = "SELECT batchnumber FROM client ORDER BY batchnumber DESC LIMIT 1";
        $result = $conn->query($lastBatchNumberQuery);    if ($result->num_rows > 0) {
        $lastBatchNumber = $result->fetch_assoc()['batchnumber'];
        $numericPortion = intval(substr($lastBatchNumber, 2)) + 1;
        return 'EP' . str_pad($numericPortion, 4, '0', STR_PAD_LEFT);
    } else {
        return 'EP0001'; // Start with EP0001 if no previous records
    }
}
    $nextBatchNumber = generateBatchNumber($conn);function generateEmpID($conn) {
        $currentYear = date('Y');
        $numericPortionQuery = "SELECT MAX(CAST(SUBSTRING(PROJECTID, 9) AS SIGNED)) AS max_numeric_portion 
                                FROM projects 
                                WHERE SUBSTRING(PROJECTID, 4, 4) = '$currentYear'";    $numericPortionResult = $conn->query($numericPortionQuery);
        $numericPortionRow = $numericPortionResult->fetch_assoc();
            $maxNumericPortion = intval($numericPortionRow['max_numeric_portion']);
                if (!empty($maxNumericPortion)) {
                    $numericPortion = $maxNumericPortion + 1;
                } else {
                    $numericPortion = 1;
                  } return 'XP-' . $currentYear . '-' . str_pad($numericPortion, 6, '0', STR_PAD_LEFT);
                } $new_project_id = generateEmpID($conn);  $sql_get = "SELECT batchnumber, clientname, contactperson, department FROM client ORDER BY batchnumber DESC LIMIT 1";  $result = $conn->query($sql_get);  if (!$result) 
                { echo "Error: " . $conn->error;
                } else {
                if ($result->num_rows > 0) 
                {
                        $row = $result->fetch_assoc();  
                        $BatchNumber = $row['batchnumber'];  
                        $lastClientName = $row['clientname'];  
                        $lastContactPerson = $row['contactperson']; 
                        $lastDepartment = $row['department']; 
                }}
                if (!empty($msg))
                    {
                    echo "<script>alert('$msg');</script>";  
                    }
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
    <link rel="stylesheet" href="Acscss/styless.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>body{width:99%;}
/* Add a CSS class for the blur effect */
.blur {
    filter: blur(15px); /* Adjust the blur intensity as needed */
}

/* Apply the blur class to the form_one_for_client div */
.form_one_for_client {
    /* Other styles for the div */
}

/* Initially blur the div */
.form_one_for_client.blur {
    filter: blur(15px); /* Adjust the blur intensity as needed */
}
*{font-size:16px;}
label#pro_pm_import {
    font-size: 60%;
}
</style>
</head>
<body>
<!----------------------- start header section  ---------------------------------->
<?php require_once "includes/header.php";?>
<!-----------------------end header section  ---------------------------------->
<div class="conatiner imp_pro_container">



<center>
    <div class="row import_row">
    <form action="controllers/project_controller.php" method="post" enctype="multipart/form-data">
        <div class="custom-file-upload">
        <i class="fa fa-times" id="clear-file" style="display: none;"></i>
        <label for="file-upload" class="pro_pm_import" id="pro_pm_import">
            <i class="fas fa-cloud-upload-alt"></i> Upload File
        </label>
        <input id="file-upload" type="file" name="excel-file" style="display: none;">
        <span id="file-name" style="display: none;"></span>
        <button type="submit" class="btn btn-primary" id="upload-button" style="display: none;">Upload</button>
        </div>
    </form>
            </div>
            <div class="row form_one">
                                    <div class="col-1"></div>
                    <div class="col-4" style="text-transform:uppercase;"></div>
                    <div class="col-2"></div>
                    <div class="col-4"  style="text-transform:uppercase;"></div>
                    <div class="col-1"></div>
            </div>
    </center>
            <div class="row form_one_second">
                                <div class="col-2"></div>
                        <div class="col-4 form_one_for_client">
                                <form method="post" action="controllers/project_controller.php">
                                    <input type="hidden" name="firstFormSubmit" value="1"> 
                                    <h4 class="center projectpg">Project</h4>
                                    <div class="row">
                                    <div class="col-lg-6 project_date">    
                                    <label for="date">Date:</label>                               
                                    <input style="display:inline; border:none; font-weight:600;" type="text" class="form-control" id="date" name="date" value=" <?php echo date('Y-m-d'); ?>" readonly required>  </div>
                                    <div class="col-lg-6 project_batch">   
                                    <label for="batchnumber" class="label_batch">Batch Number:</label>
                                    <input class="form-control"type="text" id="batchnumber1" name="batchnumber" value="<?php echo $nextBatchNumber; ?>" readonly></div></div>                               
                                    <label for="clientname">Client Name:</label>
                                    <input  class="form-control"type="text" id="clientname" name="clientname" placeholder="Type client name & click enter" required>
                                    <label for="contactperson">Contact Person:</label>
                                    <input class="form-control"type="text" id="contactperson" name="contactperson" required>
                                    <label for="department">Department:</label>
                                    <input class="form-control"type="text" id="department" name="department" required>
                                    <button class=" btn btn-primary frst-form-btn"type="submit"  name="submit_form_client">SUBMIT</button>
                                </form>
                        </div>       
                <div class="col-4" id="addClientFormContainer">         
                <div class="form_one_for_client blur" id="form_one_for_client"> <!-- Initial blur -->
                    <i class="far fa-times-circle close-icon" style="color: #ef6001;" style="display: none;"></i>
                        <form id="secondForm" style="    margin-top: -55px;" class="second_cl-form" method="post" action="controllers/project_controller.php">                        
                            <input type="hidden" name="secondFormSubmit" value="1">  
                            <h4 class="center addpg">Add Client</h4>
                            <label for="date" style="display: none;">Date:</label>
                            <input class="form-control"type="date" id="date" value="<?php echo date('Y-m-d')?>" name="date" style="display: none;" >
                            <label for="clientname" style="margin-top:10px;">Client Name:</label>
                            <input class="form-control"type="text" id="clientname1" name="clientname" required>
                            <label for="contactperson">Contact Person:</label>
                            <input class="form-control"type="text" id="contactperson1" name="contactperson" required>                         
                            <label for="department">Department:</label> 
                                <select type="text" class="form-select" id="department" name="department">
                            <option value=""><?php echo "$lastDepartment"; ?></option>
                            <option value="">*—Select the department—*</option>
                            <?php
                                $sql = "SELECT `DEPARTMENT_ELOIACS` FROM `department_company` WHERE `DEPARTMENT_ELOIACS` IS NOT NULL";
                                          $result = mysqli_query($conn, $sql);
                                          if ($result && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $department = $row['DEPARTMENT_ELOIACS']; 
                                                echo "<option value='$department'>$department</option>";
                                            }} else {
                                                echo "<option value=''>No department found</option>"; 
                                                }?>
                        </select>
                        </form>
                        <button class="btn btn-primary frst-form-btn" type="submit" id="submitbutton" form="secondForm">SUBMIT</button>
                    </div>
                    <button class="btn btn-primary addButton" type="submit" id="addButton_blur" onclick="toggleAddClientForm()">ADD NEW CLIENTS</button>
                </div> 
                </div>               
            </div>
            <div class="row form_one_end">
            </div>
            <!-- the submitted form -->
            <div class="manual_addbtn">
            <input type="button" value="Click here to enter Project Manually !..."  id="manual_form_toggle" onclick="toggleManualForm()">
            <div class="contain-form" id="manual_form_details" style="display: none;"> 
                <form action="controllers/project_controller.php" method="post">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                        <label class="form-contain-label" for="ourbatchnumber" class="small-label">OUR BATCH:</label>
                        <input type="text" class="form-control" id="ourbatchnumber" name="ourbatchnumber" value="<?php echo $BatchNumber; ?>">
                    </div>
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                        <label class="form-contain-label" for="project_id">PROJECT ID</label>
                        <input type="text" class="form-control" id="new_project_id" name="new_project_id" value="<?php echo $new_project_id; ?>">
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                        <label class="form-contain-label" for="department" class="small-label">DEPARTMENT</label>
                        <select type="text" class="form-select" id="department" name="department">
                      
                            <option value=""><?php echo "$lastDepartment"; ?></option>
                            <option value="">*—Select the department—*</option>
                            <?php
                                $sql = "SELECT `DEPARTMENT_ELOIACS` FROM `department_company` WHERE `DEPARTMENT_ELOIACS` IS NOT NULL";
                                          $result = mysqli_query($conn, $sql);
                                          if ($result && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $department = $row['DEPARTMENT_ELOIACS']; 
                                                echo "<option value='$department'>$department</option>";
                                            }} else {
                                                echo "<option value=''>No department found</option>"; 
                                                }?>
                        </select>
                    </div>
                </div>                
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="client_name">CLIENT NAME:</label>
                        <input type="text" class="form-control" id="clientname" name="clientname" value="<?php echo $lastClientName; ?>">
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                        <label class="form-contain-label" for="contact_person" class="small-label">CONTACT PERSON:</label>
                        <input type="text" class="form-control" id="contactperson" name="contactperson" value="<?php echo $lastContactPerson; ?>">
                    </div>
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="batch_number">BATCH NUMBER:</label>
                        <input type="text" class="form-control" id="batchnumber" name="batchnumber" required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                    <label class="form-contain-label" for="work_title">WORK COVER TITLE:</label>
                        <input type="text" class="form-control" id="worktitle" name="worktitle" required>
                    </div>
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="isbn_number">ISBN NUMBER:</label>
                        <input type="text" class="form-control" id="isbnnumber" name="isbnnumber" required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                    <label class="form-contain-label" for="isbn_number">COMPLEXITY:</label>
                        <input type="text" class="form-control" id="complexity" name="complexity" required>
                    </div>
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="TYPE-OF-SCOPE">TYPE OF SCOPE:</label>
                        <input type="text" class="form-control" id="typescope" name="typescope" required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                    <div class="form-group">
                    <label class="form-contain-label" for="reference_number">REFERENCE NUMBER:</label>
                        <input type="text" class="form-control" id="refrencenumber" name="refrencenumber" required>
                    </div>
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="receivedpages">RECEIVED PAGES:</label>
                        <input type="text" class="form-control" id="receivedpages" name="receivedpages"required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                <div class="form-group">
                <label class="form-contain-label" for="received_date">RECEIVED DATE:</label>
                        <input type="date" class="form-control" id="receiveddate" name="receiveddate" required>
                    </div>                    
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="due_date">VENDOR TAT:</label>
                        <input type="date" class="form-control" id="duedate" name="duedate" required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form">
                <div class="form-group">
                <label class="form-contain-label" for="due_date">DUE DATE:</label>
                        <input type="date" class="form-control" id="ourtat" name="ourtat" required>
                    </div>                    
                </div>
                <div class="col-5 input_client-form right">
                <div class="form-group">
                <label class="form-contain-label" for="total_days">UNIT:</label>
                        <input type="text" class="form-control" id="unit" name="unit"required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 input_client-form" style="display:none">
                <div class="form-group">
                <label class="form-contain-label" for="total_days">TOTAL DAYS:</label>
                        <input type="text" class="form-control" id="totaldays" name="totaldays"  readonly required>
                    </div>                    
                </div>
                <div class="col-5 input_client-form right" style="display:none;">
                <div class="form-group">
                <label class="form-contain-label" for="">LOP DAYS:</label>
                        <input type="text" class="form-control" id="lopdays" name="lopdays" readonly required>
                    </div>                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">   
                <div class="col-3"></div> 
                <center>       
                   <div class="col-6"> <button type="submit" class="btn btn-primary client_pro_entryform" name="client_pro_entryform">SAVE</button></div></center>     
                   <div class="col-3"></div>        
            </div>
        </form>
    </div>
</div> 
          
    </div>
</body>
<div class="authorization_footer_if">
        <?php  require_once "includes/footer.php";?>
    </div>
    <script src="js/project.js"></script>
</html>