<?php
session_start(); // Resume the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to index.php
    header("Location: index.php");
    exit; // Terminate the script after redirection
}
?>
<?php include_once('includes/header.php'); ?>
<?php
include('includes/conn.php');

$month = isset($_POST['month']) ? $_POST['month'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
   
if (isset($_POST['filter'])) {
    // Validate the month and year inputs
    if (!empty($month) && !empty($year)) {
        // Construct the filter query
        $formattedDate = date('Y-m', strtotime($year . '-' . $month));
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'EMP%' AND DATE_FORMAT(STR_TO_DATE(sSALARY_DATE, '%d-%m-%Y'), '%Y-%m') = '$formattedDate'";



    } else {
        // Fetch all data if no month or year is selected
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'EMP%'";
    }
} else {
    // Fetch all data if filter is not applied  
    $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'EMP%'";
}

$result = $conn->query($query);
$dataAvailable = ($result && $result->num_rows > 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Krub:wght@500;700&display=swap"
    />
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/dashboard_pro.css">
    <link rel="stylesheet" href="css/stylesss.css">
    <link rel="stylesheet" href="css/salary_storage_view.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

</head>
<body>
    
<div class="row">
    
<div class="col-9">
    <div class="container1">
        <div class="row mt-3">
            <div class="col">
                <form method="POST" class="row g-3 align-items-center">
                <div class = "emp_table_head">
                <div class="emp_pay_search">
                    <div class="col-auto_month">
                       
                        <select class="form-select" name="month">
                            <option value="">Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-auto_year">
                      
                      <input class="form-control sel" type="text" name="year" value="<?php echo $year; ?>"
                          placeholder="Year">
                  </div>
                  <div class="col-auto">
                      <button type="submit" name="filter" class="btn_search_emp"><i class="fas fa-search"></i></button>
                  </div>
                 
</div>                    <div class="col-auto_download">
                        <a href="download.php<?php echo isset($_POST['filter']) ? '?month=' . $month . '&year=' . $year : ''; ?>"
                            class="btn_search_emp_downld">Download</a>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!$dataAvailable) : ?>
            <div class="row mt-3">
                <div class="col">
                    <div class="alert alert-info">No data available.</div>
                </div>
            </div>
        <?php else : ?>
            <div class="row mt-3 table_over_scr_ol">
            <div class="view_scroll">
                <div class="col ">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="heading">
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>Basic</th>
                                <th>Salary Date</th>
                                <th>Working Days</th>
                                <th>Convenience</th>
                                <th>Advance</th>
                                <th>Over Time</th>
                                <th>Salary</th>
                                <th>EPF 12%</th>
                                <th>EPF 18%</th>
                                <th>ESI 0.75%</th>
                                <th>ESI 3.25%</th>
                                <th>BASIC ALLOWANCE</th>
                                <th>RENTAL ALLOWANCE</th>
                                <th>MEDICAL ALLOWANCE</th>

                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result->fetch_assoc()) : {
    $edit = '<a href="view_edit.php?id=' . $row["ID"] . '" class="btn_edit_salary_view" role="button">Update</a>';
} ?>
<tr>
    <td><?php echo $row['sCODE']; ?></td>
    <td><?php echo $row['sNAME']; ?></td>
    <td><?php echo $row['sBASIC']; ?></td>
    <td><?php echo $row['sSALARY_DATE']; ?></td>
    <td><?php echo $row['sEMP_WORKING_DAYS']; ?></td>
    <td><?php echo $row['sCONVIENCE']; ?></td>
    <td><?php echo $row['sADVANCE']; ?></td>
    <td><?php echo $row['sOVER_TIME']; ?></td>
    <td><?php echo $row['sSALARY']; ?></td>
    <td><?php echo $row['sEPF12']; ?></td>
    <td><?php echo $row['sEPF18']; ?></td>
    <td><?php echo $row['sESI075']; ?></td>
    <td><?php echo $row['sESI325']; ?></td>
    <td><?php echo $row['sBASICALLOW']; ?></td>
    <td><?php echo $row['sRENTALALLOW']; ?></td>
    <td><?php echo $row['sMEDICALALLOW']; ?></td>

    <td><?php echo $edit; ?></td> <!-- Added the variable echo here -->
</tr>

<?php endwhile; ?>
</tbody>
                        </div>
                        </div>
                    </table>
</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
</body>

</html>