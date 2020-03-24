<?php
session_start();
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "g7t3_serviceprovidertrial";
$link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB, "3306");

if (!$link) {
    die(mysqli_error($link));
}

$message = "";
if (!isset($_SESSION['provider_mobile'])) {
//    echo $_POST['provider_mobile'];
    if (isset($_POST['provider_mobile'])) {
        
        $providerMobile = $_POST['provider_mobile'];
        $query = "SELECT * FROM serviceprovider_trial "
                . "WHERE provider_mobile = '$providerMobile' ";
//        echo $query;
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) >= 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['provider_mobile'] = $row['provider_mobile'];
            $_SESSION['provider_name'] = $row['provider_name'];
            $message = "You are logged in!";
            header("Location: index.html"); /* Redirect browser */
            exit();
        } else {
            $authenticated = false;
            echo
            "<script>
                alert ('Your Login Credentials are Incorrect!');
            </script>";
            $message .= "Sorry, you do not have a valid username and password. <br><br>"
                    . "Redirecting you back to the <a href='serviceProviderLogin.php' style='color:blue'>Login</a> Page in a few seconds...";
        }
    }
} else {
    $message .= "You are already logged in!";
    header("Location: ../../app/index.html"); /* Redirect browser */
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <body>
        <?php echo $message;?>
    </body>
</html>
