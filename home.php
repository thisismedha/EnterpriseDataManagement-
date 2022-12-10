<?php
    session_start();
    if ($_SESSION['user'] == null)
        header("location:login.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>My </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="home.css">
</head>

<body style="background: url(cat.png) no-repeat center center fixed; 
-webkit-background-size: 1300px 600px;
-moz-background-size: fit;
-o-background-size: fit;
background-size: fit;">
  <ul>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="https://www.chewy.com/app/content/about-us">About</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="home.php">Home</a></li>
  </ul>
  <div class="container">
    <center><img src="chewy_logo.jpg" style="width:200px;height:100px; justify-content: center;"></center>
    <h2>Welcome to Chewy Dashboard</h2>
    <div class="list">
      <a href="signuphtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="dribbble" id="dribbble">
          <label for="dribbble">
            <div class="icon">
              <i class="fa fa-dribbble"></i>
            </div>
            <div class="title">
              Register New Employee
            </div>
          </label>
        </div>
      </a>
      <a href="employeehtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="instagram" id="instagram">
          <label for="instagram">
            <div class="icon">
              <i class="fa fa-instagram"></i>
            </div>
            <div class="title">
              Employee Information
            </div>
          </label>
        </div>
      </a>
      <a href="vaccinationhtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="twitch" id="twitch">
          <label for="twitch">
            <div class="icon">
              <i class="fa fa-twitch"></i>
            </div>
            <div class="title">
              Pet Vaccination Tracker
            </div>
          </label>
        </div>
      </a>
        <a href="popularproductshtml.php">
          <div class="form-element">
            <input type="button" name="platform" value="pinterest" id="pinterest">
            <label for="pinterest">
              <div class="icon">
                <i class="fa fa-pinterest"></i>
              </div>
              <div class="title">
                Product Sales Analytics
              </div>
            </label>
          </div>
        </a>
      <a href="discounthtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="twitter" id="twitter">
          <label for="twitter">
            <div class="icon">
              <i class="fa fa-twitter"></i>
            </div>
            <div class="title">
              Product Discount
            </div>
          </label>
        </div>
      </a>    

      <a href="customerhtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="codepen" id="codepen">
          <label for="codepen">
            <div class="icon">
              <i class="fa fa-codepen"></i>
            </div>
            <div class="title">
              Customer Analytics
            </div>
          </label>
        </div>
      </a>

      <a href="producthtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="slack" id="slack">
          <label for="slack">
            <div class="icon">
              <i class="fa fa-slack"></i>
            </div>
            <div class="title">
              Inventory Management
            </div>
          </label>
        </div>
      </a>
      <a href="otherphp.php">
        <div class="form-element">
          <input type="button" name="platform" value="github" id="github">
          <label for="github">
            <div class="icon">
              <i class="fa fa-github"></i>
            </div>
            <div class="title">
              Other Reports
            </div>
          </label>
        </div>
      </a>
      <a href="updateempconthtml.php">
        <div class="form-element">
          <input type="button" name="platform" value="hub" id="hub">
          <label for="hub">
            <div class="icon">
              <i class="fa fa-hub"></i>
            </div>
            <div class="title">
              Employee Contact
            </div>
          </label>
        </div>
      </a>
    </div>
  </div>

</html>