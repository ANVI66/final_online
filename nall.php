<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .table-container {
            max-height: 400px; /* Set your preferred height here */
            overflow-y: auto;
            margin-bottom: 20px; /* Add some spacing between tables */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: orange;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .totals {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Employee Data</h1>

    <?php
    // Connect to your database here
    include "connection.php";

   
    $sql = "SELECT DISTINCT department FROM new";

    // Execute the query to get distinct departments
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department = $row['department'];

            echo "<h2>Department: $department</h2>";

            echo "<div class='table-container'>"; // Start a container for the table
            echo "<table border='1'>";
            echo "<tr>
                    <th>Date</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Project ID</th>
                    <th>QC Target</th>
                    <th>Prod QC</th>
                    <th>Status</th>
                    <th>Total Pages</th>
                    <th>Target</th>
                    <th>Completed</th>
                    <th>Pending</th>
                  </tr>";

            $totalReceivedPages = 0;
            $totalCompleted = 0;

            $dataSql = "SELECT n.date, n.employeeid, n.employeename, n.projectid, n.qc_target, n.prod_qc, n.status, p.RECEIVEDPAGES, n.target, n.completed, n.pending
                  FROM new n
                  LEFT JOIN projects p ON n.projectid = p.projectid
                  WHERE n.department = '$department' AND DATE(n.date) = CURDATE()";
              
            $dataResult = $conn->query($dataSql);
              
            if ($dataResult->num_rows > 0) {
                while ($dataRow = $dataResult->fetch_assoc()) {
                    $totalPages = $dataRow['RECEIVEDPAGES'];
                    $completed = $dataRow['completed'];
                    $pending = $totalPages - $completed; // Calculate Pending

                    $totalReceivedPages += $totalPages;
                    $totalCompleted += $completed;

                    echo "<tr>";
                    echo "<td>" . $dataRow['date'] . "</td>";
                    echo "<td>" . $dataRow['employeeid'] . "</td>";
                    echo "<td>" . $dataRow['employeename'] . "</td>";
                    echo "<td>" . $dataRow['projectid'] . "</td>";
                    echo "<td>" . $dataRow['qc_target'] . "</td>";
                    echo "<td>" . $dataRow['prod_qc'] . "</td>";
                    echo "<td>" . $dataRow['status'] . "</td>";
                    echo "<td>" . $totalPages . "</td>"; // Display Total Pages
                    echo "<td>" . $dataRow['target'] . "</td>";
                    echo "<td>" . $completed . "</td>"; // Display Completed
                    echo "<td>" . $pending . "</td>"; // Display Pending
                    echo "</tr>";
                }


                echo "<tr>
                        <td colspan='7'><strong>Total:</strong></td>
                        <td><strong>$totalReceivedPages</strong></td>
                        <td></td>
                        <td><strong>$totalCompleted</strong></td>
                        <td><strong>" . ($totalReceivedPages - $totalCompleted) . "</strong></td>
                      </tr>";
            } else {
                echo "<tr><td colspan='11'>No data found for $department</td></tr>";
            }

            echo "</table>";
            echo "</div>"; // End the container for the table
        }
    } else {
        echo "<p>No departments found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
