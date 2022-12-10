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

<body style="background: url(dog1.jpg) no-repeat center center fixed; 
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
            font-weight: 700;">Top Customers</h4>
        </ul>
    </div>
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <br>
    <div class="container" style="border: black; border-radius: 1px;">
        <!-- <h1 style="text-align: center;">Employee Information</h1> -->
        <br>
        <form action="customer.php" method="POST">
            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="top" class="required-field">Top Customers</label>
                <input style="width: 100%" type="number" class="form-control" id="top" aria-describedby="emailHelp"
                    name="top" required>
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="days" class="required-field">In Last Days</label>
                <input style="width: 100%" type="number" class="form-control" id="days" aria-describedby="emailHelp"
                    name="days" required>
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="by" class="required-field">By</label>
                <!--<input style="width: 100%" type="text" class="form-control" id="department" aria-describedby="emailHelp" placeholder="Enter Department Name" name="department">-->
                <select style="width: 100%" type="text" class="form-control" id="by" aria-describedby="emailHelp"
                    name="by" id="by" required>
                    <option value="" disabled selected>Select your option</option>
                    <option value="BRAND">Brand</option>
                    <option value="PRODTYPE">Product Type</option>
                </select>
            </div>
            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" style='background-color: #4CAF50;' class="btn btn-primary">Fetch
                        Report</button>
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
        $by = $_POST['by'];
        $top = (int)$_POST['top'];
        $days = (int)$_POST['days'] ;


        //preparing sql statement to insert data into the databaseBrand
        if($by == 'BRAND')
        $sql = "WITH cus AS (SELECT C.CUSTOMERID,FNAME ||' '|| LNAME AS NAME,
        brand,count(brand)
        FROM CUSTOMERS C
        JOIN ORDERS O ON C.CUSTOMERID = O.CUSTOMERID
        JOIN ITEM_DETAILS ID ON ID.ORDERID = O.ORDERID
        JOIN ITEMS I ON I.ITEMID = ID.ITEMID
        JOIN PRODUCT_TYPES PT ON PT.PRODTYPEID = I.PRODTYPEID
        WHERE ORDERDATE > (SYSDATE)-:d
        group by C.CUSTOMERID,FNAME ||' '|| LNAME,brand
        ),
        pv as (SELECT * FROM cus
        PIVOT(
           count(customerid)
          FOR Brand IN ('Buddy Wash' AS BuddyWash ,'Barefoot' AS Barefoot,'Nordog' AS Nordog,
           'Wellness' AS Wellness,'Penguin' AS Penguin,'Laboni' AS Laboni,'Benebone' AS Benebone,'Tuffy' AS Tuffy,
           'Pedigree' AS Pedigree,'Casper' AS Casper,'PetAg' AS PetAg,'Nylabone' AS Nylabone)
          )     
        ),
        r2 as (select FNAME ||' '|| LNAME AS NAME,count(brand) as ttt FROM CUSTOMERS C
        JOIN ORDERS O ON C.CUSTOMERID = O.CUSTOMERID
        JOIN ITEM_DETAILS ID ON ID.ORDERID = O.ORDERID
        JOIN ITEMS I ON I.ITEMID = ID.ITEMID
        JOIN PRODUCT_TYPES PT ON PT.PRODTYPEID = I.PRODTYPEID
        WHERE ORDERDATE > (SYSDATE)-:d
        group by FNAME ||' '|| LNAME
        )
        select p.name,BuddyWash,Barefoot,Nordog,Wellness,Penguin, Laboni,
        Benebone,Tuffy,Pedigree, Casper, PetAg, Nylabone,ttt from pv p join r2 r on p.name = r.name
        order by ttt desc fetch first :t row only";

        else
        $sql = "WITH cus AS (SELECT C.CUSTOMERID,FNAME ||' '|| LNAME AS NAME,
        prodtype
        FROM CUSTOMERS C
        JOIN ORDERS O ON C.CUSTOMERID = O.CUSTOMERID
        JOIN ITEM_DETAILS ID ON ID.ORDERID = O.ORDERID
        JOIN ITEMS I ON I.ITEMID = ID.ITEMID
        JOIN PRODUCT_TYPES PT ON PT.PRODTYPEID = I.PRODTYPEID
        WHERE ORDERDATE > (SYSDATE)-:d
        ),
        pv as (SELECT * FROM cus
        PIVOT(
           count(customerid)
          FOR prodtype IN ('Food' AS Food, 'Beds' AS Beds,
           'Accessories' AS Accessories, 'Clothing' AS Clothing, 'Toys' AS Toys, 'Grooming' AS Grooming)
          )
        ),
        r2 as (select FNAME ||' '|| LNAME AS NAME,count(prodtype) as total FROM CUSTOMERS C
        JOIN ORDERS O ON C.CUSTOMERID = O.CUSTOMERID
        JOIN ITEM_DETAILS ID ON ID.ORDERID = O.ORDERID
        JOIN ITEMS I ON I.ITEMID = ID.ITEMID
        JOIN PRODUCT_TYPES PT ON PT.PRODTYPEID = I.PRODTYPEID
        WHERE ORDERDATE > (SYSDATE)-:d
        group by FNAME ||' '|| LNAME
        )
        select p.name,food,beds,accessories,clothing,toys,grooming,total from pv p join r2 r on p.name = r.name
        order by total desc fetch first :t row only";

        //To avoid sql injection we have to check the data for any malecious content in the user provided information 
        $compile = oci_parse($connection, $sql);

        // providing the actual value to the placholder's after checking the user provided data
        oci_bind_by_name($compile, ":t", $top);
        oci_bind_by_name($compile, ":d", $days);

        //executing the statement
        $result = oci_execute($compile, OCI_DEFAULT);

        //Checking weather the data has been inserted or not
        $row = oci_fetch_array($compile);

        if ($row > 0) {
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
            oci_bind_by_name($compile, ":t", $top);
            oci_bind_by_name($compile, ":d", $days);
            $result = oci_execute($compile, OCI_DEFAULT);

            while (($row = oci_fetch_array($compile, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "  <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table></div>";
        } else {
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