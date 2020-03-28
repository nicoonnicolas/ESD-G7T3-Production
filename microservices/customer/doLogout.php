<?php
session_start();
if (isset($_SESSION['mobile_number'])) {
    unset ($_SESSION['mobile_number']);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Logout</title>
        <meta http-equiv="refresh" content="0; url=login.php" />
    </head>
    <body>
        <?php //echo $message; ?>    
    </body>
</html>