<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/dashboard_pro.css">
    <link rel="stylesheet" href="../css/styless.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<style>
    .whole_container { margin-top: 8%; }
</style>
<body>
    <?php include_once '../includes/header.php'; ?>
    <div class="container whole_container">
        <div class="row">
            <div class="col">
                <h2>REPORT</h2>
                <div class="calendar_days">
                    <input type="date" name="filter_date" id="filter_date" />
                    <input type="button" value="Get" id="filter_button" />
                    <input type="button" value="Current Date" id="current_date_button" />
                    <select id="status_filter">
                        <option value="">Select Status</option>
                        <?php
                        // Fetch status options from the database
                        include_once "../connection.php";
                        $sql_status = "SELECT DISTINCT `STATUS` FROM `department_company`";
                        $result_status = mysqli_query($conn, $sql_status);
                        while ($row_status = mysqli_fetch_assoc($result_status)) {
                            echo '<option value="' . $row_status['STATUS'] . '">' . $row_status['STATUS'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- Table to display project details -->
                <div id="project_details">
                    <?php
                    if (isset($_GET['ourbatch'])) {
                        $selectedBatch = $_GET['ourbatch'];
                        include_once "../connection.php";

                        // Initial SQL query
                        $sql_report = "SELECT * FROM projects WHERE OURBATCH = '$selectedBatch'";

                        // Filter by date if provided
                        if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
                            $selected_date = mysqli_real_escape_string($conn, $_GET['filter_date']);
                            $sql_report .= " AND CURRENTDATE = '$selected_date'";
                        }

                        // Filter by status if provided
                        if (isset($_GET['status']) && !empty($_GET['status'])) {
                            $status_filter = mysqli_real_escape_string($conn, $_GET['status']);
                            $sql_report .= " AND STATUS = '$status_filter'";
                        }

                        $sql_report .= " ORDER BY id DESC";

                        $result_report = mysqli_query($conn, $sql_report);

                        $groupedProjects = [];
                        while ($row = mysqli_fetch_assoc($result_report)) {
                            $department = $row['DEPARTMENT'];
                            if (!isset($groupedProjects[$department])) {
                                $groupedProjects[$department] = [];
                            }
                            $groupedProjects[$department][] = $row;
                        }

                        // Data for the pie chart
                        $projectLabels = [];
                        $projectReceivedPages = [];

                        // Display grouped projects and collect data for the pie chart
                        foreach ($groupedProjects as $department => $projects) {
                            echo "<h3>$department</h3>"; // Department heading
                            // Display project details in a table row
                            echo '<table>';
                            echo '<thead>';
                            echo '<th>Project ID</th>';  // Add Project ID to the table header
                            echo '<th>Our Batch</th>';
                            echo '<th>Department</th>';
                            echo '<th>Received Pages</th>';
                            echo '<th>File Target</th>';
                            echo '<th>QC Target</th>';
                            echo '<th>Status</th>';
                            echo '</thead>';
                            echo '<tbody>';
                            $totalReceivedPages = 0;
                            $totalCompletedPages = 0;
                            foreach ($projects as $project) {
                                $project_id = $project['PROJECTID'];
                                $projectLabels[] = "Project ID: $project_id"; // Add project ID to the labels
                                $projectReceivedPages[] = $project['RECEIVEDPAGES']; // Add received pages to data
                                echo '<tr>';
                                echo '<td><a href="report_two.php?project_id=' . $project_id . '">' . $project_id . '</a></td>';
                                echo '<td>' . $project['OURBATCH'] . '</td>';
                                echo '<td>' . $project['DEPARTMENT'] . '</td>';
                                echo '<td>' . $project['RECEIVEDPAGES'] . '</td>';
                                echo '<td>' . $project['File_target'] . '</td>';
                                echo '<td>' . $project['QC_TARGET'] . '</td>';
                                echo '<td>' . $project['STATUS'] . '</td>';
                                echo '</tr>';
                                $totalReceivedPages += $project['RECEIVEDPAGES'];

                                // Calculate and display sum of completed pages from the 'new' table for each project
                                $sql_new_report = "SELECT SUM(completed) as total_completed FROM new WHERE projectid = '$project_id'";
                                $result_report_new = mysqli_query($conn, $sql_new_report);
                                $row_result = mysqli_fetch_assoc($result_report_new);
                                $totalCompletedPages += $row_result['total_completed'];
                            }

                            // Display total values for the department
                            echo '<tr>';
                            echo '<td colspan="3">Total Received Pages: ' . $totalReceivedPages . '</td>';
                            echo '<td colspan="3">Total Completed Pages: ' . $totalCompletedPages . '</td>';
                            echo '<td colspan="1">Total Pending Pages: ' . ($totalReceivedPages - $totalCompletedPages) . '</td>';
                            echo '</tr>';

                            echo '</tbody>';
                            echo '</table>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <div id="chart-container">
                    <canvas id="project-pie-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filter_button').addEventListener('click', function() {
            var selected_date = document.getElementById('filter_date').value;
            window.location.href = 'report project.php?filter_date=' + selected_date;
        });
        document.getElementById('current_date_button').addEventListener('click', function() {
            var currentDate = new Date().toISOString().slice(0, 10);
            document.getElementById('filter_date').value = currentDate;
            window.location.href = 'report project.php?filter_date=' + currentDate;
        });
        document.getElementById('status_filter').addEventListener('change', function() {
            var selected_status = this.value;
            var filter_date = document.getElementById('filter_date').value;
            window.location.href = 'report project.php?filter_date=' + filter_date + '&status=' + selected_status;
        });

        // Pie chart data
        var projectData = {
            labels: <?php echo json_encode($projectLabels); ?>, // Use PHP to output the labels
            datasets: [
                {
                    data: <?php echo json_encode($projectReceivedPages); ?>, // Use PHP to output the data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                },
            ],
        };

        // Get the canvas and create the pie chart
        var ctx = document.getElementById('project-pie-chart').getContext('2d');
        var projectPieChart = new Chart(ctx, {
            type: 'pie',
            data: projectData,
        });
    </script>
</body>
</html>
