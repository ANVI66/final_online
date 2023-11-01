<?php
include "includes/connection.php";

if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];

    // Construct the filter query
    $formattedDate = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT); // Format: yyyy-mm
    $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'TR%' AND DATE_FORMAT(STR_TO_DATE(sSALARY_DATE, '%d-%m-%Y'), '%Y-%m') = '$formattedDate'";
} else {
    // Fetch all data if no filter is applied
    $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'TR%'";
}


$result = $conn->query($query);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Create a temporary file to store the CSV data
$csvFile = fopen('php://temp', 'w');

// Write the CSV header
$header = ['Employee Code', 'Employee Name', 'Basic', 'Salary Date', 'Working Days', 'Convenience', 'Advance', 'Over Time', 'Salary', 'EPF 12%', 'EPF 18%', 'ESI 0.75%', 'ESI 3.25%', 'BASIC ALLOWANCE', 'RENTAL ALLOWANCE', 'MEDICAL ALLOWANCE'];
fputcsv($csvFile, $header);

// Fetch and write the data rows to the CSV file
while ($row = $result->fetch_assoc()) {
    $data = [
        $row['sCODE'],
        $row['sNAME'],
        $row['sBASIC'],
        $row['sSALARY_DATE'],
        $row['sEMP_WORKING_DAYS'],
        $row['sCONVIENCE'],
        $row['sADVANCE'],
        $row['sOVER_TIME'],
        $row['sSALARY'],
        $row['sEPF12'],
        $row['sEPF18'],
        $row['sESI075'],
        $row['sESI325'],
        $row['sBASICALLOW'],
        $row['sRENTALALLOW'],
        $row['sMEDICALALLOW']
    ];
    fputcsv($csvFile, $data);
    
}

// Set the CSV file headers for download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="EmployeeSalary_data.csv"');

// Seek to the beginning of the file
rewind($csvFile);

// Output the CSV file contents
fpassthru($csvFile);

// Close the file handle
fclose($csvFile);
?>
