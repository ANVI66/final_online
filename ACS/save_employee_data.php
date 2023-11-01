<?php
// Include your database connection code (connection.php)
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['save_btn_nn'])) {
        $projectID = $_POST['projectID'];
        $codeArray = $_POST['code'];
        $nameArray = $_POST['name'];
        $departmentArray = $_POST['department'];
        $prodQcArray = $_POST['prod_qc'];
        $completedArray = $_POST['completed'];
        $qcTargetArray = isset($_POST['qc_target']) ? $_POST['qc_target'] : 0;
        $tlstatusarray = $_POST['tl_status'];
       
        // Loop through the arrays and insert or update each record in the "new" table
        for ($i = 0; $i < count($codeArray); $i++) {
            $code = $codeArray[$i];
            $name = $nameArray[$i];
            $department = $departmentArray[$i];
            $prodQcValue = $prodQcArray[$i];
            $completedValue = $completedArray[$i];
            $qcTargetValue = $qcTargetArray[$i];

     
                // Check if a record with the same criteria already exists
                $checkSql = "SELECT * FROM new WHERE projectid = '$projectID' AND employeename = '$name' AND department = '$department' AND prod_qc = '$prodQcValue'";
                $checkResult = mysqli_query($conn, $checkSql);

                if (mysqli_num_rows($checkResult) > 0) {
                    // Update existing record
                    $updateSql = "UPDATE new SET completed = '$completedValue', qc_target = '$qcTargetValue'
                                  WHERE projectid = '$projectID' AND employeename = '$name' AND status = '$tlstatusarray' AND department = '$department' AND prod_qc = '$prodQcValue'";

                    if (mysqli_query($conn, $updateSql)) {
                        // Update successful
                        echo '<script>
                        alert("success");
                        window.location.href = "tl_work.php";
                        </script>';
                    } else {
                        // Update failed
                        echo '<script>
                        alert("success");
                        window.location.href = "error.php";
                        </script>';
                    }
                } else {
                    // Insert new record
                    $insertSql = "INSERT INTO new (projectid, employeeid, employeename, department, completed, qc_target, prod_qc) 
                                  VALUES ('$projectID', '$code', '$name', '$department', '$completedValue', '$qcTargetValue', '$prodQcValue')";

                    if (mysqli_query($conn, $insertSql)) {
                        // Insertion successful
                        echo '<script>
                        alert("success");
                        window.location.href = "tl_work.php";
                        </script>';
                    } else {
                        // Insertion failed
                        echo '<script>
                        alert("success");
                        window.location.href = "error.php";
                        </script>';
                    }
                }
            }
        
    } else {
        echo 'Invalid data.';
    }
} else {
    echo 'Invalid request.';
}
?>
