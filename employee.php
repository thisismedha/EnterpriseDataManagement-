<?php
    session_start();
    if ($_SESSION['user'] == null)
        header("location:login.html");
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Employee Data Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: right;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change the link color to #111 (black) on hover */
        li a:hover {
            background-color: #111;
        }

        a:link {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }

        a:active {
            text-decoration: none;
        }

        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #1248C2;
            color: white;
        }

        .required-field::after {
            content: "*";
            color: red;
        }
    </style>
</head>

<body style="background: url(cat2.png) no-repeat center center fixed; 
-webkit-background-size: 1300px 600px;
-moz-background-size: fit;
-o-background-size: fit;
background-size: fit;">
    <div class="navbar" style="border: black; border-radius: 1px;">
        <ul>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="https://www.chewy.com/app/content/about-us">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="home.php">Home</a></li>
            <h4 style="display: block;
            color: white;
            text-align: left;
            padding: 5px 8px;
            text-decoration: none;
            font:16px Arial, sans-serif;
            font-weight: 700;">Employee Information</h4>
        </ul>
    </div>
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <br>
    <div class="container" style="border: black; border-radius: 1px;">
        <!-- <h1 style="text-align: center;">Employee Information</h1> -->
        <br>
        <form action="employee.php" method="POST">
            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="empID">Employee ID</label>
                <input style="width: 100%" type="text" class="form-control" id="empID" aria-describedby="emailHelp"
                    placeholder="Enter Employee ID" name="empID">
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="department" class="required-field">Department</label>
                <!--<input style="width: 100%" type="text" class="form-control" id="department" aria-describedby="emailHelp" placeholder="Enter Department Name" name="department">-->
                <select style="width: 100%" type="text" class="form-control" id="department"
                    aria-describedby="emailHelp" name="department" id="department" required>
                    <option value="" disabled selected>Select your option</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="IT">IT</option>
                    <option value="SALES">SALES</option>
                    <option value="HR">HR</option>
                    <option value="MARKETING">MARKETING</option>
                </select>
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="designation" class="required-field">Designation</label>
                <!--<input style="width: 100%" type="text" class="form-control" id="job" aria-describedby="emailHelp" placeholder="Enter Designation Role" name="designation">-->
                <select style="width: 100%" type="text" class="form-control" id="designation"
                    aria-describedby="emailHelp" name="designation" id="designation" required>
                    <option value="" disabled selected>Select your option</option>
                    <option value="ASSOCIATE">ASSOCIATE</option>
                    <option value="LEAD">LEAD</option>
                    <option value="MANAGER">MANAGER</option>
                    <option value="CEO">CEO</option>
                    <option value="CFO">CFO</option>
                    <option value="CTO">CTO</option>
                    <option value="CIO">CIO</option>
                </select>
            </div>
            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" style='background-color: #4CAF50;' class="btn btn-primary">Filter Employee
                        Data</button>
                </form>
            </div>
        </form>
        </table>
    </div>
</body>

</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // isset($_POST['submit'])) {
    include 'db_connection.php';
    if (!$connection) {
        $e = oci_error();

        //For oci_connect errors pass to handle

        echo "Database connection failed. <br>";

        echo htmlentities($e['message']);
    } else {
        //Getting user provided database
        $empid = $_POST['empID'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];

        //preparing sql statement to insert data into the database
        if ($empid <> ''){
            $sql = "SELECT e.fname ||' '|| e.mname||' ' || e.lname AS Name,
            e.employeeemail AS Email,
            e.designation AS Designation,
            e.department AS Department,
            m.fname ||' '|| m.mname||' ' || m.lname AS Manager,
            m.employeeemail AS ManagerEmail
            FROM EMPLOYEES e
            LEFT JOIN EMPLOYEES m
            ON e.managerid = m.employeeid
            WHERE e.employeeid =:em
            AND e.designation =:desg
            AND e.department =:dep";
            
            //To avoid sql injection we have to check the data for any malecious content in the user provided information 
            $compile = oci_parse($connection, $sql);
            
            // providing the actual value to the placholder's after checking the user provided data
            oci_bind_by_name($compile, ":em", $empid);
            oci_bind_by_name($compile, ":dep", $department);
            oci_bind_by_name($compile, ":desg", $designation);
        }
        else{ 
            $sql = "SELECT e.fname ||' '|| e.mname||' ' || e.lname AS Name,
            e.employeeemail AS Email,
            e.designation AS Designation,
            e.department AS Department,
            m.fname ||' '|| m.mname||' ' || m.lname AS Manager,
            m.employeeemail AS ManagerEmail
            FROM EMPLOYEES e
            LEFT JOIN EMPLOYEES m
            ON e.managerid = m.employeeid
            WHERE e.designation =:desg
            AND e.department =:dep";

            //$sql = "SELECT * FROM EMPLOYEES";
            
            //To avoid sql injection we have to check the data for any malecious content in the user provided information 
            $compile = oci_parse($connection, $sql);

            // providing the actual value to the placholder's after checking the user provided data
            oci_bind_by_name($compile, ":desg", $designation);
            oci_bind_by_name($compile, ":dep", $department);
        }

        //executing the statement
        $result = oci_execute($compile, OCI_DEFAULT);

        //Checking weather the data has been inserted or not
        $row = oci_fetch_array($compile);

        if($row > 0 ){
            // Fetch each row in an associative array
            echo "<br/><center><div style='margin-right:100px;'><table border='1' class='form-group' style='display: inline-block; margin-right: auto; margin-left: auto;'><center>\n";
            $ncols = oci_num_fields($compile);
            echo "<tr>\n";
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($compile, $i);
                echo "  <th><b>" . htmlentities($colname, ENT_QUOTES) . "</b></th>\n";
            }
            echo "</tr>\n";

            $compile = oci_parse($connection, $sql);            
            if ($empid <> ''){
                oci_bind_by_name($compile, ":em", $empid);
            }
            oci_bind_by_name($compile, ":dep", $department);
            oci_bind_by_name($compile, ":desg", $designation);
            $result = oci_execute($compile, OCI_DEFAULT);

            while (($row = oci_fetch_array($compile, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "  <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    //echo "  <td>" . $row['NAME'] . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table></div>";
    }
    else
    {
        echo 'No Data Found!';
    }
        exit(); 	

     }

} else {

    echo 'Did not work';
    //header('location: login.php');
    exit();
}
?>