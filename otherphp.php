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

<body style="background: url(cat8.png) no-repeat center center fixed; 
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
            font-weight: 700;">Other Reports</h4>
        </ul>
    </div>
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <br>
    <div class="container" style="border: black; border-radius: 1px;">
        <!-- <h1 style="text-align: center;">Employee Information</h1> -->
        <br>
        <form action="other.php" method="POST">
            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" name="max" style='background-color: #4CAF50;' 
                        class="btn btn-primary">Maximum Priced Item</button>
                    <button type="submit" name="empdetail" style='background-color: #f44336;'
                        class="btn btn-primary">Employee Details</button>
                    <button type="submit" name="topfc" style='background-color: #033F2A;'
                        class="btn btn-primary">Top Fullfillment Centres</button>
                </form>
            </div>
        </form>
        </table>
    </div>
</body>

</html>