<?php
session_start();
include "connection.php";

// Function to populate a dropdown with values from the database
function populateDropdown($sql, $columnName)
{
    include "connection.php"; // Include your database connection
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row[$columnName];
            echo "<option value='$value'>$value</option>";
        }
    } else {
        echo "<option value=''>No options found</option>";
    }

    mysqli_close($conn); // Close the database connection
}

// Initialize filter variables
$fromDate = "";
$toDate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted
    if (isset($_POST["submit_filter"])) {
        // Get the selected date range from the form
        $fromDate = $_POST["From_report"];
        $toDate = $_POST["To_report"];

        // Modify your SQL query to include date filtering
        $sql = "SELECT Date, EmployeeID, EmployeeName, Department, BatchNumber, ProjectID, TotalPages, Target, Completed, Pending FROM new WHERE Date BETWEEN '$fromDate' AND '$toDate'";

        // Execute the query and display the filtered results
        $result = mysqli_query($conn, $sql);
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
    <link href="Acscss/styless.css" rel="stylesheet"/>
    <link href="Acscss/report.css" rel="stylesheet"/>
  
</head>

<style>
    span#page-info {
        margin-top: 33px;
    }
</style>


<body>

<?php include "acsincludes/header.php" ?>



            <div class="container1 pro_report">
        <center>
            <form method="post" id="filter-form">
                <div class="input-group mb-3">
                    <input type="text"  id="searchBox"  class="form-control" placeholder="Search by Project ID or Client Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary filter_style" type="button" id="toggle-filter" name="submit_filter"><i class="fas fa-filter"></i></button>
                
                </div>       

                <div class="filter_options">
    
        <div class="filter_table">
        <div class="row">
        <div class="col">
            <label for="From_report">From:</label>
            <input type="date" class="form-control" name="From_report" id="From_report" value="<?php echo $fromDate; ?>" />
        </div>
        <div class="col">
            <label for="To_report">To:</label>
            <input type="date" class="form-control" name="To_report" id="To_report" value="<?php echo $toDate; ?>" />
        </div>
    </div>
    <br>

            <div class="row">
                <div class="col">
                    <!-- <label for="client_name">Client Name:</label> -->
                    <select HIDDEN class="form-control pro_report_select" name="client_name" id="client_name">
                    <option value="">All</option> <!-- Add an option to show all records -->
    <option value="our_batch">Our Batch</option>
    <option value="daily">Daily</option>
    <option value="project_id">Project ID</option>
                      
                    </select>
                </div>
            </div><br>
    


            <div class="row">
                <div class="col">
                    <!-- <label for="status">Status:</label> -->
                    <select class="form-control pro_report_select" name="status" id="status">
                     
                        <option value="">Select Status</option>
            <option value="Assign">ASSIGN</option>
            <option value="INPROGRESS">INPROGRESS</option>
            <option value="ON HAND">ON HAND</option>
            <option value="Pending">PENDING</option>
            <option value="Hold">HOLD</option>
            <option value="RETURN">RETURN</option>
            <option value="REASSIGN">REASSIGN</option>
            
                     
                    </select>
                </div>
            </div><br>

            <div class="row">
                <div class="col">
                    <!-- <label for="department">Department:</label> -->
                    
                    <select class="form-control pro_report_select" name="department" id="department">
            <option value="">Select Department</option>
            <option value="XML">XML</option>
            <option value="PDF">PDF</option>
            <option value="DATAENTER">DATAENTER</option>
            <option value="EPUB">EPUB</option>
            <option value="DEVELOPING">DEVELOPING</option>
        </select>
    
                    </select>
                </div>
            </div>          

   
            <div class="btn_pro_report">
        <button type="submit" class="btn  downlaod_pro_report" id="downloadExcel">close</button>
        <button class="btn  downlaod_pro_report" type="submit" id="button-addon2" name="submit_filter">Filter</button>
    </div>
</form>
</div>
</div>
</form>
</center>
</div>





        <div class="container2">
        <form method="post">
        <div class="downlaod_pro_report ">
            <button class="btn btn-primary downlaod_pro_report " type="submit" name="save" onclick="hideCompletedRows();">Save</button>
            </div>
            <div class="tableclass_pro_report">
            <div class="search-container">
  <!-- <input type="text" id="searchBox" placeholder="Search by Project ID or Client Name"> -->
        </div>     
        
        <!DOCTYPE html>
<html>
<head>
    <title>Table Styling</title>
    
</head>
<body>

<div class="container2">
    <form method="post">
        <div class="table-responsive">
        <table class="table" id="report-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Batch Number</th>
                        <th>Our Batch</th>
                        <th>Project ID</th>
                        <th>Total Pages</th>
                        <th>Target</th>
                        <th>Completed</th>
                        <th>Pending</th>
                        <th>Status </th>
                    </tr>
                </thead>
                <tbody>
               <?php
include "connection.php";

// First SQL query to fetch data from "new" table
$query1 = "SELECT Date, EmployeeID, EmployeeName, Department, BatchNumber, ProjectID, TotalPages, Target, Completed, Pending, status FROM new";
$query2 = "SELECT OURBATCH, ProjectID, RECEIVEDPAGES FROM projects";

// Execute the first query
$result1 = $conn->query($query1);

// Initialize an empty array to store the data from the second query
$data2 = [];

// Execute the second query and store the data in the $data2 array
if ($result2 = $conn->query($query2)) {
    while ($row2 = $result2->fetch_assoc()) {
        $data2[$row2["ProjectID"]] = [
            "OURBATCH" => $row2["OURBATCH"],
            "RECEIVEDPAGES" => $row2["RECEIVEDPAGES"]
        ];
    }
    $result2->free(); // Free the result set

    // Fetch data from the first query and display it in the table
    while ($row1 = $result1->fetch_assoc()) {
        $projectID1 = $row1["ProjectID"];
                                 $projectID1 = $row1["ProjectID"];
                            if (empty($projectID1)) {
      continue;
  }
         

        // Check if the project ID exists in the data2 array
        if (isset($data2[$projectID1])) {
            $ourBatch = $data2[$projectID1]["OURBATCH"];
            $receivedPages = $data2[$projectID1]["RECEIVEDPAGES"];
            
        } else {
            $ourBatch = ''; // Set to an empty string if not found
            $receivedPages = '';
        }
        ?>
        <?php

$totalReceivedPages = 0; // Initialize totalReceivedPages
$totalPages = 0; // Initialize totalPages
$totalCompleted = 0; // Initialize totalCompleted
$pendingPages = 0; // Initialize pendingPages
$totalPending = 0; // Initialize totalPending

// ... (Rest of your code) ...

$totalReceivedPages += intval($receivedPages); // Convert $receivedPages to an integer
$totalPages += intval($row1["TotalPages"]); // Convert TotalPages to an integer
$totalCompleted += intval($row1["Completed"]); // Convert Completed to an integer
$totalPending += intval($pendingPages); // Convert pendingPages to an integer

        echo "<tr>
                <td>" . $row1["Date"] . "</td>
                <td>" . $row1["EmployeeID"] . "</td>
                <td>" . $row1["EmployeeName"] . "</td>
                <td>" . $row1["Department"] . "</td>
                <td>" . $row1["BatchNumber"] . "</td>
                <td>" . $ourBatch . "</td>
                <td>" . $projectID1 . "</td>
                <td>" . $receivedPages . "</td> 
                <td>" . $row1["Target"] . "</td>
                <td>" . $row1["Completed"] . "</td>
                <td>" . $pendingPages . "</td>
                <td>" . $row1["status"] . "</td>
              </tr>";
        }
        
  
        echo '</tr>';
        
echo "</table>";
        
        }
     
        
        // Close the database connection
        $conn->close();
        ?>

        
                </tbody>
            </table>

            </div>

            <div class="pagination">
                <div class="row" style="margin-top: 2.3pc;">
                    <div class="col-lg-2">
    <a href="#" id="prev-page"><span class="iconn"> &laquo; </span> <span class="skip_button"></span></a>
    </div>
    <!-- <div class="col-lg-6">
    <div id="page-numbers"></div>
    </div> -->
    <div class="col-lg-8">
    <span id="page-info">Page 1</span>
    </div>
    <div class="col-lg-2 ">
    <a href="#" class="next" id="next-page"> <span class="iconn"> &raquo;</span></a></div>
    <!-- <div id="page-numbers"></div> -->
</div>




    </form>
</div>




      

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Function to update column visibility based on selected options
    function updateColumnVisibility() {
        // Get an array of selected column values
        var selectedColumns = $('#columnSelect').val() || [];

        // Add th elements for selected columns to the table header
        for (var i = 0; i < selectedColumns.length; i++) {
            var columnName = selectedColumns[i];
            if ($('th[data-column="' + columnName + '"]').length === 0) {
                $('table thead tr').append('<th data-column="' + columnName + '">' + columnName + '</th>');
            }
        }
    }
    $('#columnSelect').change(function () {
        updateColumnVisibility();
    });
    updateColumnVisibility();
});
</script>
</div>
</div></div>
<?php include_once "acsincludes/footer.php"; ?>
</body>
</html>



<script>
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





<!-- =----------------------fileter option works here ------------------------------->

<script>

$(document).ready(function () {
    $(".filter_options").show();
    $("#toggle-filter").click(function () {
        $(".filter_options").toggle();
    });
    $(".filter_options").hide();
    function filterTableRows() {
        if ($(".filter_options").is(":hidden")) {
            $(".filter_options").show();
        }
    }
    $("#button-addon2").click(function () {

        filterTableRows();
    });
    $("tbody tr").show();
});

$("#button-addon2").click(function (e) {
    e.preventDefault(); 
     filterTableRows();
});




$(document).ready(function () {
    // Add these variables to track pagination
    var currentPage = 1;
    var rowsPerPage = 10;

    // Function to show rows for the current page
    function showRowsForPage() {
        var startIndex = (currentPage - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        // Hide all rows and show only the rows for the current page
        $("table tbody tr").hide();
        $("table tbody tr").slice(startIndex, endIndex).show();

        // Update the page info text
        var totalPages = Math.ceil($("table tbody tr").length / rowsPerPage);
        $("#page-info").text("Page " + currentPage + " of " + totalPages);

        // Update pagination links
        updatePaginationLinks(totalPages);
    }

    // Initial page load
    showRowsForPage();

    // Next page button click event
    $("#next-page").click(function (e) {
        e.preventDefault();
        var totalPages = Math.ceil($("table tbody tr").length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            showRowsForPage();
        }
    });


    // Previous page button click event
    $("#prev-page").click(function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showRowsForPage();
        }
    });

    // Function to update pagination links
    function updatePaginationLinks(totalPages) {
        var pageNumbersHtml = '';
        for (var i = 1; i <= totalPages; i++) {
            pageNumbersHtml += '<a href="#" class="page-number">' + i + '</a>';
        }
        $("#page-numbers").html(pageNumbersHtml);

        // Add click event handlers to page number links
        $(".page-number").click(function (e) {
            e.preventDefault();
            currentPage = parseInt($(this).text());
            showRowsForPage();
        });
    }
});


// $("#status").change(function () {
//     filterTableRows();
// });

function filterTableRows() {
        var fromDate = $("#From_report").val();
        var toDate = $("#To_report").val();
        var clientName = $("#client_name").val();
        var status = $("#status").val(); // Get the selected status
        var department = $("#department").val();

        // Hide all rows initially
        $("#report-table tbody tr").hide();

        $("#report-table tbody tr").each(function () {
            var row = $(this);
            var date = row.find("td:eq(0)").text();
            var client = row.find("td:eq(5)").text();
            var statusText = row.find("td:eq(11)").text(); // Update the column index to match the Status column
            var departmentText = row.find("td:eq(3)").text();
            var projectID = row.find("td:eq(6)").text();
            var dateMatches = (fromDate === "" || toDate === "" || (date >= fromDate && date <= toDate));
            var clientMatches = (clientName === "" || client === clientName);
            var statusMatches = (status === "" || statusText === status); // Check status filter
            var departmentMatches = (department === "" || departmentText === department);
            var projectIDNotEmpty = projectID.trim() !== "";

            if (dateMatches && clientMatches && statusMatches && departmentMatches && projectIDNotEmpty) {
                row.show(); // Show rows that match the filter criteria
            }
        });
    }

    // Initial page load
    showRowsForPage();

    // Filter button click event
    $("#button-addon2").click(function (e) {
        e.preventDefault();
        filterTableRows();
        showRowsForPage(); // Update the pagination
    });

    // ... Rest of your code ...

</script>

<SCRIPT>


function getCurrentDate() {
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    var day = currentDate.getDate().toString().padStart(2, '0');
    return year + "-" + month + "-" + day;
}
$("#button-addon2").click(function () {
    filterTableRows();
});
$("table tbody tr").show();
$(document).ready(function () {
    function filterTableBySearch() {
        var searchTerm = $("#searchBox").val().toLowerCase();
        $("table tbody tr").each(function () {
            var row = $(this);
            var rowData = row.text().toLowerCase();
            if (rowData.includes(searchTerm)) {
                row.show();
            } else {
                row.hide();
            }
        });
    }
    $("#searchBox").keyup(function () {
   
        filterTableBySearch();
    });
});
$("table tbody tr").show();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Add a click event listener to the export button
    document.addEventListener("DOMContentLoaded", function () {
        const exportButton = document.getElementById("downloadExcel");

        exportButton.addEventListener("click", function () {
            // Send an AJAX request to your export PHP script
            $.ajax({
                url: 'excel.php', // Update with the correct path to your PHP script
                type: 'POST',
                success: function (data) {
                    // Check if the response is empty or an error message
                    if (data.trim() === "") {
                        alert('Error exporting data: Empty response');
                        return;
                    }

                    // Create a Blob from the response data
                    const blob = new Blob([data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                    const url = window.URL.createObjectURL(blob);

                    // Create a temporary link and trigger a click event to download the file
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = 'report.xlsx'; // Update with the desired file name
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                },
                error: function () {
                    // Handle errors if any
                    alert('Error exporting data: AJAX request failed');
                }
                $.ajax({
    url: 'excel.php', // Update with the correct path to your PHP script
    type: 'POST',
    success: function (data) {
        // ...
    },
    error: function () {
        // ...
    }
});

            });
        });
    });

    
</script>







