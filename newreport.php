<!DOCTYPE html>
<html>
<head>
    <title>Current Month Data</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Department</th>
            <th>Total Received Pages</th>
            <th>Total Completed</th>
            <th>Total Pending</th>
        </tr>
        <?php
        include "connection.php";

        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $sql = "SELECT n.department, 
                       SUM(p.RECEIVEDPAGES) AS totalReceivedPages, 
                       SUM(n.completed) AS totalCompleted
                FROM new n
                LEFT JOIN projects p ON n.projectid = p.projectid
                WHERE YEAR(n.date) = '$currentYear' 
                AND MONTH(n.date) = '$currentMonth'
                GROUP BY n.department";

        // Step 3: Execute the query and fetch the data
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalReceivedPages = $row['totalReceivedPages'];
                $totalCompleted = $row['totalCompleted'];
                $totalPending = $totalReceivedPages - $totalCompleted;

                echo "<tr>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $totalReceivedPages . "</td>";
                echo "<td>" . $totalCompleted . "</td>";
                echo "<td>" . $totalPending . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }

        // Step 4: Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
