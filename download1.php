<?php
include "includes/connection.php";

    if (isset($_GET['month']) && isset($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];

        // Construct the filter query
        $formattedDate = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT); // Format: yyyy-mm
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'EMP%' AND DATE_FORMAT(STR_TO_DATE(sSALARY_DATE, '%d-%m-%Y'), '%Y-%m') = '$formattedDate'";
    } else {
        // Fetch all data if no filter is applied
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'EMP%'";
    }

    $result = $conn->query($query);

    // Create a temporary file to store the CSV data
    $csvFile = fopen('php://temp', 'w');

    // Write the CSV header
    $header = ['Employee Code', 'Employee Name','BANK NAME','ACCOUNT NO','IFSC','Salary'];
    fputcsv($csvFile, $header);

    // Fetch and write the data rows to the CSV file
    while ($row = $result->fetch_assoc()) {
        $data = '';
        $data = [
            $row['sCODE'],
            $row['sNAME'],                                                                                                                                                                                                                                  
            $row['sBANK_NAME'],
            $row['sACCOUNT_NUMBER'],
            $row['sIFSC_CODE'],
            $row['sSALARY'],
        
        ];
        fputcsv($csvFile, $data);
    }

    // Set the CSV file headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="salary_data.csv"');

    // Seek to the beginning of the file
    rewind($csvFile);

    // Output the CSV file contents
    fpassthru($csvFile);

    // Close the file handle
    fclose($csvFile);
    ?>
