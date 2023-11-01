
<?php
session_start(); // Resume the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to index.php
    header("Location: index.php");
    exit; // Terminate the script after redirection
}
?>

<?php include_once ('includes/header.php'); ?>

<?php
include "includes/connection.php";


$month = isset($_POST['month']) ? $_POST['month'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';

if (isset($_POST['filter'])) {
    // Validate the month and year inputs
    if (!empty($month) && !empty($year)) {
        // Construct the filter query
        $formattedDate = date('Y-m', strtotime($year . '-' . $month));
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'TR%' DATE_FORMAT(STR_TO_DATE(sSALARY_DATE, '%d-%m-%Y'), '%Y-%m') = '$formattedDate'";
    } else {
        // Fetch all data if no month or year is selected
        $query = "SELECT * FROM `salary_data` WHERE sCODE LIKE 'TR%'";
    }
} else {
    // Fetch all data if filter is not applied
    $query = "SELECT * FROM `salary_data`  WHERE sCODE LIKE 'TR%'";
}

$result = $conn->query($query);
$dataAvailable = ($result && $result->num_rows > 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b272402e67.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/stylesss.css">
     <link rel="stylesheet" href="css/trainee_sala.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery Validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
</head>
  
<style>
    
thead
{
    position: sticky;
    TOP:0;
width: 100%;
height: 66px;
flex-shrink: 0;
background: linear-gradient(166deg, #FE9901 0%, #FC7205 100%);

}
.table-bordered thead th
{
    color: #FFF;
font-size: 15px;
font-family: Inter;
font-weight: 900;
letter-spacing: 0.3px;

}

table.table-bordered
{
    
    width: max-content;
    margin-left: -12px;
}
.table-bordered tr td
{

flex-shrink: 0;
    border-bottom: 0.5px solid #000;
background: #D9D9D9;

}
.table-bordered tr:hover td
{
    background-color: #FFF;
    color: black;
}

td .btnn_download
{
    width: 120px;
height: 30px;
flex-shrink: 0;
border-radius: 2px;
background: #FB5607;
text-decoration: none;
color: #FFF;
font-size: 16px;
padding: 3px 7px 3px 7px;
font-family: Quicksand;
font-weight: 700;
letter-spacing: 0.3px;
text-decoration: none;

}
td .btnn_download :hover
{
    color: white;
    background: #FB5607;
}

.btn_search_emp
{
    border: 0px solid;
    background-color: #ffffff00;
    padding: 6px;
    font-size: 20px;
    text-align: right;
    margin-left: -40px;
    margin-top: 5px;
}
.btn_search_emp i
{
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    color: #FB5607;
}
input.form-control {
    border:none;
    width: 61px;
    margin-right: 40px;
}

/*    top 1 */
.col-md-9 .emp_pay_search {
    width: 21.5%;
    height: 46px;
    padding: 0px;
    position: absolute;
    top: 15%;
    flex-shrink: 0;
    border-radius: 5px;
    border: 1px solid #FB5607;
    margin: 30px;
    display: flex;
}
.col-md-9 .col-auto_year
{
    padding: 1px;
    height: 42px;
    background-color: #fff;
    text-align: center;
    margin-left: -11px;
    text-decoration: none;
    border: none;
}


.col-md-9 .emp_pay_search .col-auto_month {
    width: 91%;
    height: 42px;
    border: 0px solid;
    background-color: #ffffff00;
    padding: 0px 6px;
}
.table_over_scr_ol
{
    width: 98%;
    overflow-x: scroll;
    height:350px;
    margin-left: 15px;
    

}
.container1 {
    margin-top: 9%;
    width: 100%;
}


.col-9 .table_over_scr_ol {
    overflow-x: scroll;
    
    height: 500px;
    margin-left: 30px;
    border: 0px solid;
}


.table_over_scr_ol::-webkit-scrollbar {
    height: 10px;
    width: 4px;
    background-color: transparent;
    border: 0px solid #787676;
}

.table_over_scr_ol::-webkit-scrollbar-track {
    background-color: transparent;
}

.table_over_scr_ol::-webkit-scrollbar-thumb {
    background-color: transparent;
    border-radius: 2px;
}

.table_over_scr_ol::-webkit-scrollbar-thumb:horizontal {
    background-color: #fb5407ba;
}

/** width max ***/

.col-md-9 {
    width: 100% !important;
   
}
.col-md-3
{
    width: 17%;

}
a.btnn_download:hover {
    color: white;
}
a.btn_search_emp_downld {
    float: right;
    margin: 10px 39px;
    border: 1px solid #fb5407;
    background-color: #fb5407;
    color: #fff;
    font-size: 15px;
    padding: 5px;
    border-radius: 5px;
    font-weight: 700;
    text-decoration:none;
}


tbody {
  height: 300px; /* Adjust the height as needed */
  overflow-y: scroll;
}




/* Make the header row fixed */
thead {
    border:1px orange solid;
  top: 0;
  background-color: #f8f9fa; /* Adjust the background color as needed */
}
th, td {
  padding: 8px;
  text-align: left;
  white-space: nowrap;
}

/* Add a border to the table */
table {
  border-collapse: collapse;
}

/* Add a border to the table cells */
th, td {
  border: 1px solid #ddd; /* Adjust the border color as needed */
}
.col-9 .btn_search_emp_downld_f
{
    border-radius: 5px;
    background: #FB5607;
    color: #FFF;
    font-size: 17px;
    padding: 6px;
    margin-right: 15px;
    font-family: Quicksand;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    letter-spacing: 0.4px;
}
.bbtn{
    text-decoration:none;
}
.bbtn{
    float: right;
    margin: 10px 39px;
    border: 1px solid #fb5407;
    background-color: #fb5407;
    color: #fff;
    font-size: 15px;
    padding: 5px;
    border-radius: 5px;
    font-weight: 700;

}

.row
{
    width:100%;
}
@media (max-width:767px){
    *{
        font-size:11px;
    }
    a.btnn_download {
        font-size:11px;
    }
    a.btn_search_emp_downld {
        font-size:11px;
}
a.bbtn {
    font-size:11px;
}
.bbtn {
    margin: -55px 79px;
}
a.btn_search_emp_downld {
    margin: 26px 25px;}

    .col-auto_download {
    margin-top: -20px;
}
.col-md-9 .emp_pay_search {

    width: 67%;
    height: 37px;}

input.form-control {
    padding-top: 10px;
}
.btn_search_emp {
    padding:0px;
}
.col-auto_download {
    padding-top: 13px;
}
table.table-bordered {
    margin-top: -30px;
}
.row.mt-3.table_over_scr_ol {
    margin-top: -1rem!important;
}
.col-md-9 .emp_pay_search .col-auto_month {
    height: 30px;}
    
.col-md-9 .col-auto_year {
height:30px;
}
.col-auto_download {
    margin-bottom: -4% !important;
    margin-top: 12% !important;
}
.col-md-9{
    width:92% !important;
    margin-left:9% !important;
}
}


@MEDIA (MIN-WIDTH:768px) and (max-width:1024px){
    .container1{
        width:90%;
    }
    .col-md-9 {
    margin-top: 2% !important;}

    .col-md-9 .emp_pay_search {
    width: 34.5%;}
    *{
        font-size:11px;
    }
    a.btnn_download {
    font-size: 11px;
}
.bbtn{
    font-size:11px;
}
a.btnn_download {
    font-size: 11px;
}
a.btn_search_emp_downld {
    font-size: 11px;
}
.form-control {
    padding: 0rem 0.75rem !important;}


input.form-control {
    margin-top: 14px;}

.btn_search_emp {
padding:0px !important;
    }
    .col-auto_download {
    margin-bottom: -4% !important;
    margin-top: 12% !important;
}
.col-md-9{
    width:92% !important;
    margin-left:9% !important;
}
}
  
}


</style>
</head>

<body>  




    <div class="container1">
        <div class="row">
            <!-- <div class="col-md-3">
                <php include ('nav.php')
                ?>
            </div> -->
        </div>
        <div class="row mt-3">
            <div class="row">
            <div class="col-md-9">
                <form method="POST" class="row g-3 align-items-center">

                <div class="col-auto_download">
                        <a href="trainee_salary_download.php<?php echo isset($_POST['filter']) ? '?month=' . $month . '&year=' . $year : ''; ?>"
                            class="btn_search_emp_downld">Bank Details</a>
                    </div>
                    
                    <div class="emp_pay_search">
                    <div class="col-auto_month">
                        <select class="col-auto_month" id="col_auto" name="month">
                            <option value="">Select Month</option>
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
                        <input class="form-control" type="text" name="year" value="<?php echo $year; ?>"
                            placeholder="Year">
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="filter" class="btn_search_emp"><i class="fas fa-search"></i></button>
                    </div>
                    </div>
                   
                </form>
         <?php if (!$dataAvailable) : ?>
            <div class="row mt-3">
                <div class="col">
                    <div class="alert alert-info">No data available.</div>
                </div>
            </div>
        <?php else : ?>
            <div class="row mt-3 table_over_scr_ol">
                <div class="col_payslip">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Trainee Code</th>
                                <th>Trainee Name</th>
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
                                <th>MOBILE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result->fetch_assoc()) : 
   
 ?>

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
    
    <td><a href="https://wa.me/<?php echo $row['sMOBILE']; ?>?text=Hello%20from%20Eloiacs"><?php echo $row['sMOBILE']; ?></a></td>
    <td>
    <a href="trainee_pdf_maker.php?ID=<?php echo $row['ID']; ?>&ACTION=DOWNLOAD" class="btnn_download"> Download</a></td>
            
        </tr>
</tr>

<?php endwhile; ?>

                        </tbody>

                    </table>

                </div>
            </div>
        <?php endif; ?>
    </div>
                        </div>
</body>

</html>
