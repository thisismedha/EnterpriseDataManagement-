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
    </style>
</head>

<body style="background: url(cat10.png) no-repeat center center fixed; 
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
        <form action="discount.php" method="POST">
            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="brand" class="required-field">Brand</label>
                <!--<input type="text" style="width: 100%" class="form-control" id="brand" aria-describedby="emailHelp"
                    placeholder="Enter Product Brand" name="brand" required>-->
                    <select style="width: 100%" type="text" class="form-control" id="brand"
                    aria-describedby="emailHelp" name="brand" id="brand" required>
                    <option value="" disabled selected>Select your option</option>
                    <option value="Buddy Wash">Buddy Wash</option>
                    <option value="Barefoot">Barefoot</option>
                    <option value="Nordog">Nordog</option>
                    <option value="Wellness">Wellness</option>
                    <option value="Penguin">Penguin</option>
                    <option value="Laboni">Laboni</option>
                    <option value="Benebone">Benebone</option>
                    <option value="Tuffy">Tuffy</option>
                    <option value="Pedigree">Pedigree</option>
                    <option value="Casper">Casper</option>
                    <option value="PetAg">PetAg</option>
                    <option value="Nylabone">Nylabone</option>
                </select>
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="prodtype" class="required-field">Product Type</label>
                <!--<input type="text" style="width: 100%" class="form-control" id="prodtype" aria-describedby="emailHelp"
                    placeholder="Enter Product Type" name="prodtype" required>-->
                    <select style="width: 100%" type="text" class="form-control" id="prodtype"
                    aria-describedby="emailHelp" name="prodtype" id="prodtype" required>
                        <option value="" disabled selected>Select your option</option>
                        <option value="Food">Food</option>
                        <option value="Beds">Beds</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Toys">Toys</option>
                        <option value="Grooming">Grooming</option>
                    </select>
            </div>

            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="discount">Discount%</label>
                <input style="width: 100%" type="number" min="1" max="100" class="form-control" id="discount"
                    aria-describedby="emailHelp" name="discount">
            </div>

            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" name="apply" style='background-color: #4CAF50;' class="btn btn-primary">Apply
                        Discount</button>
                    <button type="submit" name="remove" style='background-color: #f44336;'
                        class="btn btn-primary">Remove Discount</button>
                </form>
            </div>
        </form>
        </table>
    </div>
</body>

</html>