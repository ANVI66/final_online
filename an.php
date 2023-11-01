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
            max-height: 400px;
            overflow: auto;
        }

        .date-filter {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
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
    include_once "connection.php";

    // Retrieve the filter date from the form POST data
    $filterDate = $_POST['filterDate'] ?? date('Y-m-d');

    // Query to get employees for the given date in "new" table
    $sql = "SELECT ed.CODE
            FROM employee_data ed
            INNER JOIN new n ON ed.CODE = n.employeeid
            WHERE n.date = '$filterDate'";

    $result = $conn->query($sql);

    $balancedEmployees = array();

    while ($row = $result->fetch_assoc()) {
        $balancedEmployees[] = $row['CODE'];
    }

    // Query to get employees for the given date who are not in 'new' table
    $sql = "SELECT NAME, CODE, Project_department
            FROM employee_data
            WHERE CODE NOT IN (
                SELECT employeeid
                FROM new
                WHERE date = '$filterDate'
            )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>eloiacs list</h2>";

        echo '<div class="scroll-table">';
        echo "<table border='1'>
                <tr>
                    <th>Code</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["CODE"] . "</td>
                    <td>" . $row["NAME"] . "</td>
                    <td>" . $row["Project_department"] . "</td>
                </tr>";
        }

        echo "</table>";
        echo '</div>';
    } else {
        echo "No employees for the selected date in 'eloiacs list'.";
    }

    // Query to get employees for the given date who are not in "new" table and are not in the "balancedEmployees" array
    $sql = "SELECT NAME, CODE, Project_department
            FROM acs_employee_data
            WHERE CODE NOT IN (
                SELECT employeeid
                FROM new
                WHERE date = '$filterDate'
            )
            AND CODE NOT IN (" . implode(",", $balancedEmployees) . ")";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>acs_employee_data</h2>";

        echo '<div class="scroll-table">';
        echo "<table border='1'>
                <tr>
                    <th>Code</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["CODE"] . "</td>
                    <td>" . $row["NAME"] . "</td>
                    <td>" . $row["Project_department"] . "</td>
                </tr>";
        }

        echo "</table>";
        echo '</div>';
    } else {
        echo "No employees not in 'new' for the selected date in 'acs_employee_data'.";
    }

    // Query to get balanced employees who are not in either list
    $balancedEmployeesNotInLists = array_diff($balancedEmployees, array_column($result->fetch_all(MYSQLI_ASSOC), 'CODE'));

    if (!empty($balancedEmployeesNotInLists)) {
        echo "<h2>Balance List</h2>";

        echo '<div class="scroll-table">';
        echo "<table border='1'>
                <tr>
                    <th>Code</th>
                </tr>";

        foreach ($balancedEmployeesNotInLists as $code) {
            echo "<tr>
                    <td>" . $code . "</td>
                </tr>";
        }

        echo "</table>";
        echo '</div>';
    } else {
        echo "No balanced employees not in the lists.";
    }

    $conn->close();
    ?>
</body>
</html>