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
    <link rel="stylesheet" href="../css/styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #0066cc;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background: orange;
        }

        .scroll-table {
            max-height: 400px; /* Define the maximum height for the scrollbar */
            overflow: auto; /* Add scrollbar for overflow content */
        }
   
        .date-filter {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Employee Data</h1>

 <div class="date-filter">
    <form action="#" method="post">
        <label for="filterDate">Filter by Date:</label>
        <input type="date" id="filterDate" name="filterDate" value="<?php echo date('Y-m-d'); ?>">
        <input type="submit" value="Filter">
    </form>
</div>


    <?php
    include_once "connection.php"; // Ensure the correct path to the connection.php file

    $filterDate = $_POST['filterDate'] ?? date('Y-m-d');

    $sql = "SELECT ed.NAME, ed.CODE, ed.Project_department, n.status 
            FROM employee_data ed
            LEFT JOIN new n ON ed.CODE = n.employeeid
            WHERE n.date = '$filterDate' AND n.status = 'array'"; // Replace 'your_date_column' with your actual date column name

    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        $currentDepartment = null; // Initialize the current department variable

        echo '<div class="scroll-table">'; // Add a div with the scroll-table class

        while ($row = $result->fetch_assoc()) {
            $department = $row["Project_department"];

            // Check if the department has changed
            if ($department !== $currentDepartment) {
                // If it's a new department, start a new table
                if ($currentDepartment !== null) {
                    echo "</table>";
                }

                echo "<h2>$department</h2>";
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
        echo '</div>'; // Close the scroll-table div
    } else {
        echo "No results found for the current date with status 'array'.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
