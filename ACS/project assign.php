<?php
  
  include "acsincludes/connection.php"; // Include your database 


// Function to populate a dropdown with values from the database
function populateDropdown($sql, $columnName)
{
    include "acsincludes/connection.php"; // Include your database  
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row[$columnName];
            echo "<option value='$value'>$value</option>";
        }
    } else {
        echo "<option value=''>No options found</option>";
    }
   // Close the database connection
}



if (isset($_POST['save_project_assign'])) {
    foreach ($_POST['data'] as $id => $values) {
        $id = mysqli_real_escape_string($conn, $id);

        // Use null coalescing operator to set default values
        $status = mysqli_real_escape_string($conn, $values['STATUS'] ?? '');
        $File_target = mysqli_real_escape_string($conn, $values['File_target'] ?? '');
        $remark = mysqli_real_escape_string($conn, $values['REMARK'] ?? '');
        // $qc = mysqli_real_escape_string($conn, $values['QC'] ?? '');
        $qcCheck = mysqli_real_escape_string($conn, $values['QC_TARGET'] ?? '');
        $accounts = mysqli_real_escape_string($conn, $values['ACCOUNTS'] ?? '');        
        $current_date = mysqli_real_escape_string($conn, $values['CURRENTDATE'] ?? '');
        $branch = mysqli_real_escape_string($conn, $values['BRANCH'] ?? '');

        // Add other fields you want to update
        $updateQuery = "UPDATE projects SET STATUS = '$status', File_target = '$File_target', REMARK = '$remark', QC_TARGET = '$qcCheck', ACCOUNTS = '$accounts', CURRENTDATE='$current_date', BRANCH='$branch' WHERE PROJECTID = '$id'";
           mysqli_query($conn, $updateQuery);        
           echo "<script>alert('Updated Successfully')</script>";
    
    echo '<script> window.location.href = window.location.href;</script>';
}} else {
    echo '<script> window.location.href = error.php;</script>';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
// the employee project's for the each
if (isset($_POST['save_prod'])) {
    // Handle "save_prod" form submission
    $target_prod = $_POST['new_target_PROD'];
    $projectids = $_POST['projectid_PROD'];
    $newCompletedValues = $_POST['new_completed_PROD'];
    $newPendingValues = $_POST['new_pending_PROD'];

    // Loop through the submitted data and update the records
    for ($i = 0; $i < count($projectids); $i++) {
        $projectid = $projectids[$i];
        $newCompleted = $newCompletedValues[$i];
        $newPending = $newPendingValues[$i];

        $update_query_prod = "UPDATE new SET completed = '$newCompleted', pending = '$newPending' WHERE projectid = '$projectid' AND employeename = '$employeeName'";

        if ($conn->query($update_query_prod) === TRUE) {
            echo "Changes saved successfully!";
            echo '<script>alert("Data saved successfully.");window.location.href = "../dashboard.php";</script>';
        } else {
            header("Location: ../error.php");
            exit;
        }
    }
}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <link rel="stylesheet" href="Acscss/project_assignn.css">
    <link rel="stylesheet" href="Acscss/styless.css">
</head>
<style>body{width:99% !important;}


</style>

<body>
 
   <!-- Header Section -->
   <?php require_once "acsincludes/header.php"; ?>
<!-- End Header Section -->
    <div class="container1 pro_report">

    <center>
        <form action="project assign.php" method="post" id="filter-form">
            <div class="input-group mb-3">
                <input type="text" id="searchBox" class="form-control" placeholder="Search by Project ID or Client Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary filter_style" type="button" id="toggle-filter" name="submit_filter"><i class="fas fa-filter"></i></button>
            </div>

            <div class="filter_options">
                <div class="filter_table">
                    <div class="row">
                        <div class="col">
                            <label for="From_report">From:</label>
                            <input type="date" class="form-control" name="From_report" id="From_report" />
                        </div>
                        <div class="col">
                            <label for="To_report">To:</label>
                            <input type="date" class="form-control" name="To_report" id="To_report" value="<?php echo date('Y-m-d'); ?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <select class="form-control pro_report_select" name="client_name" id="client_name">
                                <option value="">Select Client Name</option>
                                <?php
                                $clientSql = "SELECT CLIENTNAME FROM projects WHERE DEL_STATUS = 1";
                                populateDropdown($clientSql, "CLIENTNAME");
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <select class="form-control pro_report_select" name="status" id="status">
                                <option value="">Select Status</option>
                                <?php
                                $statusSql = "SELECT STATUS FROM department_company WHERE STATUS IS NOT NULL AND STATUS != ''";
                                populateDropdown($statusSql, "STATUS");
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <select class="form-control pro_report_select" name="department" id="department">
                                <option value="">Select Department</option>
                                <?php
                                $departmentSql = "SELECT DEPARTMENT_ELOIACS FROM department_company WHERE DEPARTMENT_ELOIACS IS NOT NULL AND DEPARTMENT_ELOIACS != ''";
                                populateDropdown($departmentSql, "DEPARTMENT_ELOIACS");
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="btn_pro_report">
                        <button class="btn btn-primaryy downlaod_pro_report" id="downloadExcel">Close</button>
                        <button class="btn btn-primaryy downlaod_pro_report" type="submit" id="button-addon2">Filter</button>
                    </div>
                </div>
            </div>
        </form>
    </center>
</div>
<div class="container2">
        <form method="post">
            <div class="downlaod_pro_report">
                <button class="downlaod_pro_reportt" type="submit" name="save_project_assign">Save</button>
            </div>
            <div class="tableclass_pro_report">
            <div class="search-container">
        </div>   
        <div class="container2_table">            
        <table >
            <thead>
                <tr>               
                    <th>Project ID</th>
                    <th>Client Name</th>
                    <th style="display:none">Contact Person</th>
                    <th style="display:none">Batch Number</th>
                    <th >Work Cover Title</th> 
                    <th>ISBN Number</th>
                    <th>DEPARTMENT</th>
                    <th >Scope Of Work</th>
                    <th style="display:none">Type of Scope</th>
                    <th>Complexity</th>
                    <th>Unit</th>
                    <th style="display:none">Reference Number</th>
                    <th style="display:none">Project Type</th>
                    <th >Received Pages</th>
                    <th style="display:none">Blank Pages</th>
                    <th style="display:none">Worked Pages</th>
                    <th style="display:none">Cost / page</th>
                    <th>Received Date</th>
                    <th>Client Date</th>
                    <th style="display:none">Total Days</th>                    
                    <th >LOP Days</th>
                    <th >Due date</th>
                    <th style="display:none">Completion Date</th>
                    <th>Status</th>
                    <th>File Target</th>
                    <th>TL status</th>                    
                    <th>QC Checking</th>
                    <th>Accounts</th>
                    <th>Remark</th>  
                    <th style="display:none">Current Date</th>
                                                         
            </tr>
            </thead>
            <tbody>

<?php 
include "connection.php";
$retrieve = "SELECT * FROM projects";
$result = mysqli_query($conn, $retrieve); 
while ($row = mysqli_fetch_assoc($result)) {
                         $id = $row['PROJECTID'];
                        $client_name = $row['CLIENTNAME'];
                        $contact_person = $row['CONTACTPERSON'];
                        $batch_number = $row['BATCHNUMBER'];
                        $cover_title = $row['WORKTITLE'];
                        $isbn_number = $row['ISBNNUMBER'];
                        $department = $row['DEPARTMENT'];
                        $scope_of_work = $row['WORKSCOPE'];
                        $type_of_scope = $row['TYPESCOPE'];
                        $complexity = $row['COMPLEXITY'];
                        $unit = $row['UNIT'];
                        $ref_number = $row['REFERENCENUMBER'];
                        $project_type = $row['PROJECTTYPE'];
                        $received_pgs = $row['RECEIVEDPAGES'];  
                        $blank_pgs = $row['BLANKPAGES'];
                        $worked_pgs = $row['WORKEDPAGES'];
                        $cost_per_page = $row['COST'];
                        $total_cost = $row['TOTALCOST'];
                        $received_date = $row['RECEIVEDDATE'];
                        $vendor_tat = $row['DUEDATE'];
                        $total_days = $row['TOTALDAYS'];
                        $lop_days = $row['LOPDAYS'];
                        $our_tat= $row['OURTAT'];
                        $completion_data = $row['COMPLETIONDATE'];
                        $status = $row['STATUS'];
                        $File_target=$row['File_target'];
                        $remark = $row['REMARK'];
                        $tl = $row['TL_STATUS'];
                        // $qc = $row['QC'];
                        $qc_check = $row['QC_TARGET'];
                        $accounts = $row['ACCOUNTS'];
                        $current_date = date('Y-m-d');   
                       ?>                           
                        <tr class="employee-row">                         
                        <td><input type="text" name="data[<?php echo $id; ?>][PROJECTID]" value="<?php echo $id; ?>" readonly></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][CLIENTNAME]" value="<?php echo $client_name; ?>"readonly></td>
                        <td style="display:none"><input type="text" name="data[<?php echo $id; ?>][CONTACTPERSON]" value="<?php echo $contact_person; ?>"readonly></td>
                        <td style="display:none"><input type="text" name="data[<?php echo $id; ?>][BATCHNUMBER]" value="<?php echo $batch_number; ?>"readonly></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][WORKTITLE]" value="<?php echo $cover_title; ?>"readonly></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][ISBNNUMBER]" value="<?php echo $isbn_number; ?>"readonly></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][DEPARTMENT]" value="<?php echo $department; ?>"readonly></td>
                        
                        
                        <td><input type="text" name="data[<?php echo $id; ?>][WORKSCOPE]" value="<?php echo $scope_of_work; ?>"readonly></td>
                        <td style="display:none"><input type="text" name="data[<?php echo $id; ?>][TYPESCOPE]" value="<?php echo $type_of_scope; ?>"readonly></td>
                        <td><input readonly type="text" name="data[<?php echo $id; ?>][COMPLEXITY]" value="<?php echo $complexity; ?>"></td>
                        <td><input readonly type="text" name="data[<?php echo $id; ?>][UNIT]" value="<?php echo $unit; ?>"></td>
                         <td style="display:none"><input type="text" name="data[<?php echo $id; ?>][REFERENCENUMBER]" value="<?php echo $ref_number; ?>"></td> 
                        <td style="display:none"><input type="text" name="data[<?php echo $id; ?>][PROJECTTYPE]" value="<?php echo $ref_number; ?>"></td>
                        <td><input type="text" class="receivedpages" name="data[<?php echo $id; ?>][RECEIVEDPAGES]" value="<?php echo $received_pgs; ?>"readonly></td>
                        <td style="display:none"><input type="text" class="blankpages" name="data[<?php echo $id; ?>][BLANKPAGES]" value="<?php echo $blank_pgs; ?>"></td>
                        <td style="display:none"><input type="text" class="workedpages" name="data[<?php echo $id; ?>][WORKEDPAGES]" value="<?php echo $worked_pgs; ?>"readonly></td>
                        <td style="display:none"><input type="text" class="cost" name="data[<?php echo $id; ?>][COST]" value="<?php echo $cost_per_page; ?>"></td>
                        <td><input type="text" class="receiveddate" name="data[<?php echo $id; ?>][RECEIVEDDATE]" value="<?php echo $received_date; ?>"readonly></td>
                        <td><input type="text" class="duedate" name="data[<?php echo $id; ?>][DUEDATE]" value="<?php echo $vendor_tat; ?>"readonly></td>
                        <td style="display:none"><input type="text" class="totaldays" name="data[<?php echo $id; ?>][TOTALDAYS]" value="<?php echo $total_days; ?>"readonly></td>
                        <td><input type="text" class="lopdays" name="data[<?php echo $id; ?>][LOPDAYS]" value="<?php echo $lop_days; ?>"readonly></td>
                        <td style="display:block"><input type="text" name="data[<?php echo $id; ?>][OURTAT]" value="<?php echo $our_tat; ?>"readonly></td>
                        <td style="display:none"><input type="text" class="completiondate" id="completionDate_<?php echo $id; ?>" name="data[<?php echo $id; ?>][COMPLETIONDATE]" value="<?php echo $completion_data; ?>"></td>    
                        <td> <select class="pro_report_select" name="data[<?php echo $id; ?>][STATUS]" onchange="updateCompletionDate(this)">
                        <option value=""></option>            
                        <option value="Assign" <?php if ($status === 'Assign') echo 'selected'; ?>>Assign</option>
                        <option value="Completed" <?php if ($status === 'Completed') echo 'selected'; ?>>Completed</option>
                        <option value="On Hand" <?php if ($status === 'On Hand') echo 'selected'; ?>>On Hand</option>
                        <option value="Pending" <?php if ($status === 'Pending') echo 'selected'; ?>>Pending</option>
                        </select></td>                    
                        <td><input type="text" class="cost" name="data[<?php echo $id; ?>][File_target]" value="<?php echo $File_target; ?>"></td> 
                        <td><input type="text" name="data[<?php echo $id; ?>][TL_STATUS]" value="<?php echo $tl; ?>"readonly></td>
                        <!-- <td><input type="text" name="data[<php echo $id; ?>][QC]" value="<php echo $qc; ?>"></td> -->
                        <td><input type="text" name="data[<?php echo $id; ?>][QC_TARGET]" value="<?php echo $qc_check; ?>"></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][ACCOUNTS]" value="<?php echo $accounts; ?>"></td>
                        <td><input type="text" name="data[<?php echo $id; ?>][REMARK]" value="<?php echo $remark; ?>"></td>
                        <td><input type="" name="data[<?php echo $id; ?>][CURRENTDATE]" value="<?PHP echo $current_date; ?>" style="display:none"readonly></td>
</tr>                 
<?php } ?>                
</tbody> 
</table> 
</div>

</div>
</form>
</body>
</html>

<script>
$(document).ready(function () {
    // Initialize the filter options to be displayed
    $(".filter_options").show();

    // Toggle the visibility of .filter_options when #toggle-filter is clicked
    $("#toggle-filter").click(function () {
        $(".filter_options").toggle();
    });

    // Initially, hide the .filter_options
    $(".filter_options").hide();

    // Function to filter table rows
    function filterTableRows() {
        // Initialize filter criteria
        var fromDate = $("#From_report").val();
        var toDate = $("#To_report").val();
        var clientName = $("#client_name").val();
        var status = $("#status").val();
        var department = $("#department").val();

        // Loop through table rows and hide/show based on filter criteria
        $("tbody tr").each(function () {
            var receivedDate = $(this).find(".receiveddate").val();
            var client = $(this).find("input[name*='[CLIENTNAME]']").val();
            var rowStatus = $(this).find("select[name*='[STATUS]']").val();
            var rowDepartment = $(this).find("select[name*='[DEPARTMENT]']").val();
            var currentDate = $(this).find("input[name*='[CURRENTDATE]']").val();

            // Parse the dates as JavaScript Date objects
            var fromDateObj = new Date(fromDate);
            var toDateObj = new Date(toDate);
            var receivedDateObj = new Date(receivedDate);
            var currentDateObj = new Date(currentDate);
            var showRow = true;

            // Check the date range for receivedDate
            if ((fromDate !== "" && receivedDateObj < fromDateObj) ||
                (toDate !== "" && receivedDateObj > toDateObj)) {
                showRow = false;
            }

            // Check other criteria
            if (showRow && (clientName !== "" && client !== clientName)) {
                showRow = false;
            }
            if (showRow && (status !== "" && rowStatus !== status)) {
                showRow = false;
            }
            if (showRow && (department !== "" && rowDepartment !== department)) {
                showRow = false;
            }

            // Check the date range for currentDate
            if (showRow && (fromDate !== "" && currentDateObj < fromDateObj) ||
                (toDate !== "" && currentDateObj > toDateObj)) {
                showRow = false;
            }

            if (showRow) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Scroll to the table
        var tableOffset = $(".tableclass_pro_report").offset().top;
        $("html, body").animate({ scrollTop: tableOffset }, 100); // Adjust the duration as needed
    }
    // Attach the filterTableRows function to the "submit_filter" button click event
    $("#button-addon2").click(function (e) {
        e.preventDefault(); // Prevent the form from submitting and the page from refreshing
        // Apply the filter
        filterTableRows();
    });

    // Event listener for the "Clear All" button
    $("#downloadExcel").click(function () {
        // Reset the input fields
        $("#searchBox").val('');
        $("#From_report").val('');
        $("#To_report").val('<?php echo date('Y-m-d'); ?>');
        $("#client_name").val('');
        $("#status").val('');
        $("#department").val('');
        // Trigger the filter function to show all rows
        filterTableRows();
    });

    // Initially, show all rows
    $("tbody tr").show();
});
</script>

<script>
  $(document).ready(function () {
    $('#searchBox').on('input', function () {
      var searchText = $(this).val().toLowerCase();
      var noRecordsFoundRow = $('#noRecordsFound');
      var matchingRecordsExist = false; // Track if any matching records are found
      $('.employee-row').each(function () {
        var row = $(this);
        var projectId = row.find('input[name^="data["][name$="[PROJECTID]"]').val().toLowerCase();
        var clientName = row.find('input[name^="data["][name$="[CLIENTNAME]"]').val().toLowerCase();     
        if (projectId.includes(searchText) || clientName.includes(searchText)) {
          row.show();
          matchingRecordsExist = true; // Matching record found
        } else {
          row.hide();
        }
      });

      // Show/hide the "No records found" row
      if (matchingRecordsExist) {
        noRecordsFoundRow.hide();
      } else {
        noRecordsFoundRow.show();        
      }
    });
  });

function updateCompletionDate(selectElement) {
    var completionDateInputId = "completionDate_" + selectElement.name.match(/\[(.*?)\]/)[1]; // Extract the ID
    var completionDateInput = document.getElementById(completionDateInputId);
    if (selectElement.value === "Completed") {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + "-" + month + "-" + day;
        completionDateInput.value = formattedDate;
        completionDateInput.readOnly = true; // Make the field non-editable
    } else {
        completionDateInput.value = ""; // Clear the field if status is not "Completed"
        completionDateInput.readOnly = false; // Make the field editable
    }
}
</script>  

  