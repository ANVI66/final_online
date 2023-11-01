<!DOCTYPE html>
<html>
<head>
    <title>Employee Data</title>
</head>
<body>
    <h1>Employee Data</h1>

    <?php
    include "connection.php"; 

    $sql = "SELECT ed.NAME, ed.CODE, ed.Project_department, n.status 
    FROM employee_data ed
    LEFT JOIN new n ON ed.CODE = n.employeeid
    WHERE n.status = 'array'
    ORDER BY ed.Project_department"; 

    $result = $conn->query($sql);

    $currentDepartment = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department = $row["Project_department"];


            if ($department !== $currentDepartment) {
               
                if ($currentDepartment !== null) {
                    echo "</table>";
                }

                echo "<h2>Department: $department</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>Code</th>
                            <th>Employee Name</th>        
                            <th>Department</th>
                            <th>Status</th>
                        </tr>";
                $currentDepartment = $department;
            }

            // Display employee data in the current table
            echo "<tr>
                    <td>" . $row["CODE"] . "</td>
                    <td>" . $row["NAME"] . "</td>          
                    <td>" . $row["Project_department"] . "</td>
                    <td>" . $row["status"] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No results found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>