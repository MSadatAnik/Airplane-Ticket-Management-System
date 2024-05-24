
<?php

require_once("Connection.php");
require_once("PassengerClass.php");
session_start();

$localEmail = $_POST['email'];
$localPassword = $_POST['password'];

$passenger= new passenger();
$passenger ->login($localEmail, $localPassword, $con);
//header("Location: Welcome.php?email=" . $localEmail);
exit();
?>
