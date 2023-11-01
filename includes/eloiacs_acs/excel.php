<?php
// Start the session (only once at the beginning)
session_start();

// Include necessary files (e.g., connection.php)
include "connection.php";
require 'vendor/autoload.php'; // Include the PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Your SQL query here
$query = "SELECT Date, EmployeeID, EmployeeName, Department, BatchNumber, ProjectID, TotalPages, Target, Completed, Pending FROM new";
$result = mysqli_query($conn, $query);

$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

// Add headers to the Excel sheet
$worksheet->setCellValue('A1', 'Date');
$worksheet->setCellValue('B1', 'Employee ID');
$worksheet->setCellValue('C1', 'Employee Name');
$worksheet->setCellValue('D1', 'Department');
$worksheet->setCellValue('E1', 'Batch Number');
$worksheet->setCellValue('F1', 'Project ID');
$worksheet->setCellValue('G1', 'Total Pages');
$worksheet->setCellValue('H1', 'Target');
$worksheet->setCellValue('I1', 'Completed');
$worksheet->setCellValue('J1', 'Pending');

// Add data from the database to the Excel sheet
$row = 2; // Start from row 2
while ($data = mysqli_fetch_assoc($result)) {
    $worksheet->setCellValue('A' . $row, $data['Date']);
    $worksheet->setCellValue('B' . $row, $data['EmployeeID']);
    $worksheet->setCellValue('C' . $row, $data['EmployeeName']);
    $worksheet->setCellValue('D' . $row, $data['Department']);
    $worksheet->setCellValue('E' . $row, $data['BatchNumber']);
    $worksheet->setCellValue('F' . $row, $data['ProjectID']);
    $worksheet->setCellValue('G' . $row, $data['TotalPages']);
    $worksheet->setCellValue('H' . $row, $data['Target']);
    $worksheet->setCellValue('I' . $row, $data['Completed']);
    $worksheet->setCellValue('J' . $row, $data['Pending']);
    $row++;
}

// Set the headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report.xlsx"');
header('Cache-Control: max-age=0');

// Create a new Excel writer object and save the Excel file to the PHP output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit; // Ensure no further code execution
?>
