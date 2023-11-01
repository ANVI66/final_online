<?php
include "connection.php";

$departmentData = array(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $department = $_POST["department"];
    $department_code = $_POST["department_code"];
    $branch = $_POST["branch"];
    $checkSql = "SELECT * FROM department_company WHERE DEPARTMENT_ELOIACS = '$department'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $updateSql = "UPDATE department_company SET DEPARTMENT_CODE = '$department_code', Place = '$branch' WHERE DEPARTMENT_ELOIACS = '$department'";
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>alert('Data updated successfully');</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $insertSql = "INSERT INTO department_company (DEPARTMENT_ELOIACS, DEPARTMENT_CODE, Place) VALUES ('$department', '$department_code', '$branch')";
        
        if ($conn->query($insertSql) === TRUE) {
            echo "<script>alert('Data saved successfully');</script>";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
}
$sql = "SELECT DEPARTMENT_ELOIACS, DEPARTMENT_CODE FROM department_company";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departmentData[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
<style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 60px;
            margin-left: 71px;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
        }

        input.form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button.btn-primary {
            background-color: #007bff;
            margin-right: 36%;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 4%;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }

        .view-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .hidden {
            display: none;
        }
/* CSS for the table container with a scroll bar */
.table-container {
    max-height: 300px; /* Adjust the maximum height as needed */
    overflow-y: auto;
}

/* CSS for the data table */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.data-table th, .data-table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}

.data-table th {
    background-color: orange;
    color: white;
}


</style>
</head>
<body>
    <div class="container">
        <!-- <button class="view-button btn btn-primary" onclick="showData()">View</button> -->
        <h2>New Department Form</h2>
        <form method="post" action="adddep.php">
            <!-- Your form fields here as in your original HTML -->
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="department_code">Department Code:</label>
                <input type="text" id="department_code" name="department_code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="branch" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
   
        <div class="container">
    <h2>Department Data</h2>
    <div class="table-container">
        <table class="data-table">
            <tr>
                <th>Department</th>
                <th>Department Code</th>
            </tr>
            <?php
include "connection.php";

foreach ($departmentData as $data) {
    echo "<tr>";
    echo "<td>" . $data['DEPARTMENT_ELOIACS'] . "</td>";
    echo "<td>" . $data['DEPARTMENT_CODE'] . "</td>";

    if (!empty($data['DEPARTMENT_ELOIACS'])) {
        $clientValue = $data['DEPARTMENT_ELOIACS'];

        // Replace "client_table" with the actual table name in your "client" database
        $clientQuery = "SELECT clientname FROM client WHERE department = '$clientValue'";
        $result = $conn->query($clientQuery);

        if ($result && $result->num_rows > 0) {
            // Match found in the "client" database
            $clientRow = $result->fetch_assoc();
            $clientName = $clientRow['clientname'];
            echo "<td>$clientName</td>"; // Show the client name
        } else {
            echo "<td></td>";
        }
    } else {
        echo "<td></td>";
    }
    echo "</tr>";
}

// Close the connection to the "client" database
$conn->close();
?>


        </table>
    </div>
</div>

    <!-- <script>
        function showData() {
            var dataTable = document.getElementById("data-table");
            if (dataTable.classList.contains("hidden")) {
                dataTable.classList.remove("hidden");
            } else {
                dataTable.classList.add("hidden");
            }
        }
    </script> -->
</body>
</html>
