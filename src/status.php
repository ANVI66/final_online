<!DOCTYPE html>
<html>
<head>
    <title>Employee Data</title>
    <style>
        h1 {
            text-align: center;
        }

        .table-container {
            display: inline-block;
            width: 48%;
            margin: 1%;
            vertical-align: top;
            max-height: 400px;
            overflow: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        th {
            background-color: orange;
        }

        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Employee Data</h1>

    <form method="POST" action="">
        <label for="filterDate">Choose a Date:</label>
        <input type="date" id="filterDate" name="filterDate">
        <input type="submit" value="Filter">
    </form>

    <?php
    include "../connection.php";

    $currentDate = date("D-m-Y"); // Get the current date in the format yyyy-mm-dd
    $selectedDate = $currentDate;

    if (isset($_POST['filterDate'])) {
        $selectedDate = $_POST['filterDate'];
        $sql = "SELECT CODE, NAME, project_department
        FROM employee_data
        WHERE CODE NOT IN (
            SELECT employeeid FROM new WHERE date = '$selectedDate'
        )";
    } else {
        $sql = "SELECT CODE, NAME, project_department
        FROM employee_data";    
    }

    $result = $conn->query($sql);

    // Initialize the departmentData array
    $departmentData = array();

    // Create an associative array to group employees by department, excluding specific departments
    while ($row = $result->fetch_assoc()) {
        $department = $row["project_department"];

        $excludedDepartments = ["HOUSE KEEPING", "ADMIN", "Human Resource Manager", "OPERATIONS", "UI DEVELOPER", "HRS", "Trainer Department", "PROJECTS", "General Manager"];

        if (!in_array($department, $excludedDepartments)) {
            if (!isset($departmentData[$department])) {
                $departmentData[$department] = array();
            }
            $departmentData[$department][] = $row;
        }
    }
    ?>

    <?php
    // Display the selected filter date
    echo "<p>Selected Date: $selectedDate</p>";

    // Display the data grouped by department
    $tableCount = 0;
    foreach ($departmentData as $department => $employees) {
        echo '<div class="table-container">';
        echo "<h2> $department</h2>";
        echo "<table>";
        echo "<tr><th>Code</th><th>Name</th></tr>";
        foreach ($employees as $employee) {
            echo "<tr>";
            echo "<td>" . $employee["CODE"] . "</td>";
            echo "<td>" . $employee["NAME"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
        $tableCount++;
    }
    ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
