<?php
session_start(); // Resume the session
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
        <link rel="stylesheet" href="css/employee_save.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
 thead{
    position:sticky;
    top:0;
 }
 
    </style>


<body>
<!----------------------- start header section  ---------------------------------->
<?php require_once "INCLUDES/header.php";?>
<!-----------------------end header section  ---------------------------------->
<div class="container">
    <?php
    include "connection.php";
    if ($user_position == "Admin" || $user_position == "General Manager") {
        ?>


    <div class="box">

   
<div class="row">
    <div class="col">
    <div class="left">
        <input type="text" id="search" placeholder="Search">
    </div>
    </div>
    <div class="col">
    <div class="right">
        <label class="filt" for="filter">Filter by Status:</label>
        <select id="filter" onchange="filterTable()">
            <option value="all">All</option>
            <option value="working">Working</option>
            <option value="exit">Exit</option>
        </select>
        <div class="button-group">
            <button class="btn btn-primary down" onclick="downloadFilteredData()">Download</button>
            <button class="btn btn-secondary back"><a href="Salary_details_payroll.php" >Back</a></button>
        </div>
    </div>
    </div>
</div>


        <div class="salary_details">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bc">
                        <!-- <th>ID</th> -->
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>DEPARTMENT</th>
                        <th>WORK NATURE</th>
                        <th>JOINING DATE</th>
                      
                        <th>BASIC</th>
                        <th>BANKNAME</th>
                        <th>ACCOUNT NO</th>
                        <th>IFSCCODE</th>
                        <th>SALARY ACCOUNT</th>
                        <th>ESI_EPF</th>
                        <th>ESI NO</th>
                        <th>EPF NO</th>
                        <th>STATUS</th>
                        <th>MOBILE</th>
                        <th colspan="2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "INCLUDES/connection.php";
                    $sve = "SELECT * FROM employee_data where DELSTATUS = 1";
                    $ddd = mysqli_query($conn, $sve);
                    while ($row = mysqli_fetch_assoc($ddd)) {
                        // $id1 = $row['ID'];
                        $id = $row['CODE'];
                        $name = $row['NAME'];
                        $dept = $row['DEPARTMENT'];
                        $worknature = $row['WORKNATURE'];
                        $datejoining = $row['JOININGDATE'];
                       
                        $basic = $row['BASIC'];
                        $bankname = $row['BANKNAME'];
                        $acntno = $row['ACCOUNTNO'];
                        $ifsc = $row['IFSCCODE'];
                        $salaryacnt = $row['SALARYACCOUNT'];
                        $Esi_epf = $row['ESI_EPF'];
                        $Esino = $row['ESINO'];
                        $Epfno = $row['EPFNO'];
                        $Status = $row['STATUS'];
                        $mobile=$row['MOBILE'];
                    ?>
                        <tr>
                        <!-- <td><php echo $id1 ?></td> -->
                            <td><?php echo $id ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $dept ?></td>
                            <td><?php echo $worknature ?></td>
                            <td><?php echo $datejoining ?></td>
                            
                            <td><?php echo $basic ?></td>
                            <td><?php echo $bankname ?></td>
                            <td><?php echo $acntno ?></td>
                            <td><?php echo $ifsc ?></td>
                            <td><?php echo $salaryacnt ?></td>
                            <td><?php echo $Esi_epf ?></td>
                            <td><?php echo $Esino ?></td>
                            <td><?php echo $Epfno ?></td>
                            <td><?php echo $Status ?></td>
                            <td><?php echo $mobile?></td>
                            <td><a href="update.php?id=<?php echo $row["ID"]; ?>" class="btn btn-primary btn-sm" role="button">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row["ID"]; ?>" i class="fa fa-trash" aria-hidden="true" onclick='return checkdelete()'></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    </div>
        </div>
        <!-- <div class="bottom">
            <label class="filt" for="filter">Filter by Status:</label>
            <select id="filter" onchange="filterTable()">
                <option value="all">All</option>
                <option value="working">Working</option>
                <option value="exit">Exit</option>
            </select>
            <button class="btn  btn-primary down" onclick="downloadFilteredData()">Download</button>
        </div> -->
    </div>
                    </div>

<script>
        function checkdelete(){
            return confirm ('Are you sure you want to delete this record ?')
       }
       </script>
    <script>
        function filterTable() {
            const filter = document.getElementById("filter").value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const statusCell = row.querySelector("td:nth-child(15)");
                const status = statusCell.textContent.toLowerCase();
                if (filter === "all" || status === filter) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function downloadFilteredData() {
            const filteredRows = Array.from(document.querySelectorAll("tbody tr"))
                .filter(row => row.style.display !== "none");
            const headers = Array.from(document.querySelectorAll("thead th"))
                .map(header => header.textContent);
            const data = [headers].concat(filteredRows.map(row => Array.from(row.querySelectorAll("td"))
                .map(cell => cell.textContent)));

            const csvContent = "data:text/csv;charset=utf-8," + data.map(row => row.join(",")).join("\n");
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "filtered_data.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
    <script>
    const searchInput = document.getElementById("search");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function() {
        const searchTerm = searchInput.value.toLowerCase();
        tableRows.forEach(row => {
            const nameCell = row.querySelector("td:nth-child(2)");
            const name = nameCell.textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>

        <?php
    } else {
        // Unauthorized user content here
        ?>
        <div class="authorization">
            <h1 class="unauth">Unauthorized</h1>
            <p><?php echo $user_position; ?></p>
            <h4 class="unauthorization">Apologies, you don't have the authorization for this action.</h4>
        </div>
        <div class="authorization_footer">
            <?php require_once "INCLUDES/footer.php"; ?>
        </div>
        <?php
    }
    ?>
 
</div>
<!-----------------------start Footer section  ---------------------------------->
<?php require_once "includes/footer.php";?>
<!-----------------------end Footer section  ---------------------------------->
</body>
</html>
