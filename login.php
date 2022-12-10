<?php
session_start();
// if ($_SESSION['user'] == null)
//         header("location:login.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'db_connection.php';
  if (!$connection) {
    $e = oci_error();
    //For oci_connect errors pass to handle
    echo "Database connection failed. <br>";
    echo htmlentities($e['message']);
  } else {

    //Getting user provided database
    $email = $_POST['email'];
    $password = $_POST['password'];

    //preparing sql statement to insert data into the database
    $sql = "SELECT employeeemail, password FROM EMPLOYEES WHERE employeeemail =:em
                                                  AND password =:ps";

    //To avoid sql injection we have to check the data for any malecious content in the user provided information 
    $compile = oci_parse($connection, $sql);

    // providing the actual value to the placholder's after checking the user provided data
    oci_bind_by_name($compile, ":em", $email);
    oci_bind_by_name($compile, ":ps", $password);

    //executing the statement
    $result = oci_execute($compile, OCI_DEFAULT);
    $row = oci_fetch_array($compile);

    if ($row > 0) {
        $_SESSION['user'] = $email;
        header("location:home.php");
        //echo file_get_contents("home.php");
        oci_close($connection);
    } else {
      // echo '<div class="error-msg">
      // <center><i class="fa fa-check" style="color: white; background-color: red;">Incorrect Email or password!</i></center>
      //       </div>';
      // // echo "Incorrect Email or password!";
      // //echo file_get_contents("login.html");
      // header("location:login.html");
      echo '<script type="text/javascript">';
      echo ' alert("Incorrect Email or password!");
             window.location.href="login.html"; ';  //not showing an alert box.
      echo '</script>';
      oci_close($connection);
    }
  }
}
?>