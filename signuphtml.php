<?php
    session_start();
    if ($_SESSION['user'] == null)
        header("location:login.html");
?>
<head>
  <link rel="stylesheet" href="signup.css">
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

    .success-msg,
    .success-msg {
      color: #270;
      background-color: #DFF2BF;
    }

    .required-field::after {
      content: "*";
      color: red;
    }
  </style>
</head>

<body style="background: url(dog3.png) no-repeat center center fixed; 
-webkit-background-size: 1300px 600px;
-moz-background-size: fit;
-o-background-size: fit;
background-size: fit;">
  <form action="signup.php" , method="post">
    <div class="navbar" style="border: black; ">
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
      font-weight: 700;">New Employee Registration</h4>
      </ul>
    </div>
    <div class="imgcontainer">
      <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
      <br>
    </div>

    <div class="container">
      <label for="fname" class="required-field"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="fname" required>

      <label for="mname"><b>Middle Name</b></label>
      <input type="text" placeholder="Enter Middle Name" name="mname">

      <label for="lname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lname"><br /><br />

      <label for="designation" class="required-field"><b>Designation</b></label>
      <select name="designation" id="designation" required>
        <option value="ASSOCIATE">ASSOCIATE</option>
        <option value="LEAD">LEAD</option>
        <option value="MANAGER">MANAGER</option>
        <option value="CEO">CEO</option>
        <option value="CFO">CFO</option>
        <option value="CTO">CTO</option>
        <option value="CIO">CIO</option>
      </select><br /><br /><br />

      <label for="department" class="required-field"><b>Department</b></label>
      <select name="department" id="department" required>
        <option value="ADMIN">ADMIN</option>
        <option value="IT">IT</option>
        <option value="SALES">SALES</option>
        <option value="HR">HR</option>
        <option value="MARKETING">MARKETING</option>
      </select><br /><br /><br />

      <label for="managerid"><b>Manager ID</b></label>
      <input type="text" placeholder="Enter Manager ID" name="managerid">

      <label for="ssn"><b>SSN</b></label>
      <input type="text" placeholder="Enter SSN" name="ssn">

      <!--<label for="doh"><b>Date of Hire</b></label>
    <input type="date" placeholder="01/01/2022" name="doh"><br/><br/>-->

      <label for="street" class="required-field"><b>Street</b></label>
      <input type="text" placeholder="Enter Street" name="street" required>

      <label for="state" class="required-field"><b>State</b></label>
      <input type="text" placeholder="Enter State" name="state" required>

      <label for="city" class="required-field"><b>City</b></label>
      <input type="text" placeholder="Enter City" name="city" required>

      <label for="zip" class="required-field"><b>Zip</b></label>
      <input type="text" placeholder="Enter zip code" name="zip" required>

      <label for="email" class="required-field"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="password" class="required-field"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <div class="clearfix">
        <button type="submit" class="cancelbtn" style="color:white;" name="cancel" id="cancel">Cancel</button>
        <button type="submit" class="signupbtn" name="submit" style="color:white;">Register</button>
      </div>
    </div>
  </form>
</body>