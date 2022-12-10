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
                a:link { text-decoration: none; }
                a:visited { text-decoration: none; }
                a:hover { text-decoration: none;
                          color: white; }
                a:active { text-decoration: none; }
        </style>
    </head>
    
<body style="background: url(cat5.png) no-repeat center center fixed; 
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
        font-weight: 700;">Pet Vaccination Tracker</h4>
    </ul>
</div>
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <br>
    <div class="container" style="border: black; border-radius: 1px;">
           <!-- <h1 style="text-align: center;">Employee Information</h1> -->
        <br>
        <form action="vaccination.php" method="POST">
            <div class="form-group" style="display: inline-block; margin-right: 20px;">
                <label for="by">Due in</label>
                <!--<input style="width: 100%" type="text" class="form-control" id="department" aria-describedby="emailHelp" placeholder="Enter Department Name" name="department">-->
                <select style="width: 100%" type="text" class="form-control" id="by" aria-describedby="emailHelp"
                    name="by" id="by" required>
                    <option value="" disabled selected>Select your option</option>
                    <option value="7">7 Days</option>
                    <option value="14">14 Days</option>
                    <option value="30">30 Days</option>
                </select>
            </div>
                       
            <div style="display: inline-block;">
                <form style="margin-left: 450px;" action="/display_data" method="GET">
                    <button type="submit" style='background-color: #4CAF50;' class="btn btn-primary">Fetch vaccination due</button>
                </form>
            </div>
        </form>
    </table>
    </div>
</body>
</html>
