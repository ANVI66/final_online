<!DOCTYPE html>
<html>
<head>
    <title>Employee Data</title>
</head>
<body>
    <h1>Employee Data</h1>

    <?php
  include "connection.php";

  $sql = "SELECT project_department, COUNT(*) as totalcounding FROM employee_data GROUP BY project_department";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>department</th>
                    <th>totalcounding</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["project_department"] . "</td>
                    <td>" . $row["totalcounding"] . "</td>
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
