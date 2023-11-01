<?php
include "acsincludes/connection.php";

function generateEmpID($conn)
{
    $query = "SELECT MAX(CAST(SUBSTRING(CODE, 4) AS UNSIGNED)) AS max_code FROM employee_data WHERE CODE LIKE 'EMP%'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxCode = $row['max_code'];

    if (empty($maxCode)) {
        $nextCodeNumber = 1;
    } else {
        $nextCodeNumber = $maxCode + 1;
    }

    $newCode = "EMP" . sprintf('%04d', $nextCodeNumber);

    return $newCode;
}

$newEmpCode = generateEmpID($conn);
echo $newEmpCode;
?>
