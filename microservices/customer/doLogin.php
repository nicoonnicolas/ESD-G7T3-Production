<?php
session_start();
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_customer";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3306");

if (!$link) {
    die(mysqli_error($link));
}

$message = "";
$authenticated = false;
if (!isset($_SESSION['mobile_number'])) {
    if (isset($_POST['mobile_number'])) {
        $mobileNumber = $_POST['mobile_number'];
        $query = "SELECT * FROM customer "
                . "WHERE customer_mobile = '$mobileNumber' ";
        //echo $query;
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['mobile_number'] = $row['customer_mobile'];
            $message = "You are logged in!";
            //header("Location: ../../app/index.html"); /* Redirect browser */
            header("Location: ../booking/booking.php"); /* Redirect browser */
            exit();
            
        } else {
            $authenticated = false;
            //echo $query;
            $message .= "Sorry, you do not have a valid username and password. <br><br>"
                    . "Redirecting you back to the <a href='login.php' style='color:blue'>Login</a> Page in a few seconds...";
        }
    }
} else {
    $message .= "You are already logged in!";
}

echo $message;
if (isset($_SESSION['mobile_number'])) {
    echo $_SESSION['mobile_number'];
}
?>
<html>
    <a href="doLogout.php">Logout</a>
</html>
