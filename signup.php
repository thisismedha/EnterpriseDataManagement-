<?php
session_start();
if ($_SESSION['user'] == null)
    header("location:login.html");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
   // isset($_POST['submit'])) {
    include 'db_connection.php';
    if (!$connection) {
        $e = oci_error();

        //For oci_connect errors pass to handle

        echo "Database connection failed. <br>";

        echo htmlentities($e['message']);
    } else {
        if(isset($_POST['cancel'])){
            echo file_get_contents("signuphtml.php");
            oci_close($connection);
            exit();
        }
        //Getting user provided database
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];
        $managerid = $_POST['managerid'];
        $ssn = $_POST['ssn'];
        //$doh = $_POST['doh'];
        //$doh = strtoupper(strval("17/11/2022"));
        //$doh = substr($doh,3,2) . "/" . substr($doh,0,2) . "/" . substr($doh,6,4);
        //$doh = substr(strtoupper(strval(date('d-M-yy', strtotime($doh)))), 0, 7) . "20" . substr(strtoupper(strval(date('d-M-yy', strtotime($doh)))),7, 2) ;
        $state = $_POST['state'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //preparing sql statement to insert data into the database
        $sql = "INSERT INTO EMPLOYEES (fName, mname, lname,  designation, 
                department, managerid, ssn, street, state, city, zip, employeeemail, password) 
                values(:fn, :mn, :ln, :desig, :dept, :magid, :ssn, :stre, :st, :ci, :zi, :em, :pass)";
        // $sql = "INSERT INTO employees (password, fName, employeeEmail, designation,
        // department, dateOfHire, state, street, city, zip)
        // VALUES ('Admin1900', 'Kevin', 'kevin@chewy.com', 'ASSOCIATE', 'IT',
        //           '11-NOV-2022', 'AZ', '1725S PARK AVE', 'TUCSON', '85719')";


        //To avoid sql injection we have to check the data for any malecious content in the user provided information
        $compile = oci_parse($connection, $sql);

        // providing the actual value to the placholder's after checking the user provided data
        oci_bind_by_name($compile, ":fn", $fname);
        oci_bind_by_name($compile, ":mn", $mname);
        oci_bind_by_name($compile, ":ln", $lname);
        oci_bind_by_name($compile, ":desig", $designation);
        oci_bind_by_name($compile, ":dept", $department);
        oci_bind_by_name($compile, ":magid", $managerid);
        oci_bind_by_name($compile, ":ssn", $ssn);
        //oci_bind_by_name($compile, ":doh", $doh);
        oci_bind_by_name($compile, ":stre", $street);
        oci_bind_by_name($compile, ":st", $state);
        oci_bind_by_name($compile, ":ci", $city);
        oci_bind_by_name($compile, ":zi", $zip);
        oci_bind_by_name($compile, ":em", $email);
        oci_bind_by_name($compile, ":pass", $password);

        //executing the statement
        $result = oci_execute($compile, OCI_DEFAULT);

        //Checking weather the data has been inserted or not
        //$row = oci_fetch_array($compile);

        if ($result > 0) {
            
            // echo'<div class="success-msg">
            // <i class="fa fa-check" style="color: #270; background-color: #DFF2BF;">Data Inserted Successfully</i>
            // </div>';
            echo '<script type="text/javascript">';
            echo ' alert("Data Inserted Successfully");
                   window.location.href="signuphtml.php"; ';  //not showing an alert box.
            echo '</script>';
            oci_commit($connection);
            oci_free_statement($compile);
            oci_close($connection);
            //header("location:signuphtml.php");
            exit();
            //header('location: success.html');

        } 
        // else {
        //     echo '<h1 align="center" color="red">Something went wrong please try again</h1>';
        //     oci_rollback($connection);
        //     oci_free_statement($compile);
        //     oci_close($connection);
        //     //header('location: login.php');
        //     exit();
        // }

    }

} else {

    echo 'Did not work';
    //header('location: login.php');
    exit();
}
?>