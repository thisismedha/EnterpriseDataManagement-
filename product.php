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

        .required-field::after {
            content: "*";
            color: red;
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

<body style="background: url(cat3.png) no-repeat center center fixed; 
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
            font-weight: 700;">Products Discount</h4>
        </ul>
    </div>
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <br>
    <div class="container" style="border: black; border-radius: 1px;">
        <!-- <h1 style="text-align: center;">Employee Information</h1> -->
        <br>
        <form action="product.php" method="POST">

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="itemid">Item ID</label>
                <input style="width: 100%" type="text" class="form-control" id="itemid" aria-describedby="emailHelp"
                    name="itemid">
            </div>

            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" name="apply" style='background-color: #4CAF50;' class="btn btn-primary">Fetch Items</button>
                    <button type="submit" name="remove" style='background-color: #f44336;'
                        class="btn btn-primary">Delete Item</button>
                    <!--<button type="submit" name="insert" style='background-color: #1248C2;'
                        class="btn btn-primary">Insert Product</button>-->
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
        try {

            //Getting user provided database
            $itemid = $_POST['itemid'];

            //preparing sql statement to insert data into the database
            if (isset($_POST['apply'])) {
                if ($itemid == '')
                    $sql = "SELECT * FROM ITEMS";
                else
                    $sql = "SELECT * FROM ITEMS WHERE itemid=:iid";
            } else if (isset($_POST['remove'])) {
                $sql = "BEGIN DELETEITEM(:iid); END;";
            } else if (isset($_POST['insert'])) {
                oci_close($connection);
                echo file_get_contents("insert.html");                
                exit();
            }

            //To avoid sql injection we have to check the data for any malecious content in the user provided information 
            $compile = oci_parse($connection, $sql);

            // providing the actual value to the placholder's after checking the user provided data
            if ($itemid <> '')
                oci_bind_by_name($compile, ":iid", $itemid);

            //executing the statement
            $result = oci_execute($compile, OCI_DEFAULT);

            //Checking weather the data has been inserted or not
            if (isset($_POST['apply']))
            $row = oci_fetch_array($compile);
            //$row = oci_fetch_all($compile, $result);

            if (isset($_POST['apply']) && $row > 0) {
                // Fetch each row in an associative array
                echo "<center><div style='margin-right:100px;'><table border='1' class='form-group' style='display: inline-block; margin-right: auto; margin-left: auto;'><center>\n";
                $ncols = oci_num_fields($compile);
                echo "<tr>\n";
                for ($i = 1; $i <= $ncols; ++$i) {
                    $colname = oci_field_name($compile, $i);
                    echo "  <th><b>" . htmlentities($colname, ENT_QUOTES) . "</b></th>\n";
                }
                echo "</tr>\n";

                $compile = oci_parse($connection, $sql);
                if ($itemid)
                    oci_bind_by_name($compile, ":iid", $itemid);
                $result = oci_execute($compile, OCI_DEFAULT);

                while (($row = oci_fetch_array($compile, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    // while (($row = oci_fetch_all($compile,  $result)) != false) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                        echo "  <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    echo "</tr>\n";
                }
                echo "</table></div>";
            } 
            else if (isset($_POST['remove'])){
                echo 'Item Deleted';
            }
            else {
                echo 'No Data Found!';
            }
            exit();

        } finally {
            echo "Something was not right";
        }
    }

} else {

    echo 'Did not work';
    //header('location: login.php');
    exit();
}

?>