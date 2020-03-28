<?php
session_start();
if (isset($_SESSION['mobile_number'])) {
    session_destroy();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Logout</title>
        <meta http-equiv="refresh" content="0; url=customer_amqp/customerLogin.php" />
    </head>
    <body>
        <?php //echo $message; ?>    
    </body>
</html>