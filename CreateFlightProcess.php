<?php

require_once("Connection.php");
require_once("AdminClass.php");
require_once("Flight.php");
session_start();

$localDeparture = $_POST['departure'];
$localDestination = $_POST['destination'];
$localFTime = $_POST['fTime'];
//$localFDate = date('Y-m-d',strtotime($_POST['fDate']));
$localFDate = $_POST['fDate'];
$localSeat = $_POST['seats'];

$flight = new flight();
$flight-> createFlight("Admin",$localDeparture,$localDestination,$localFTime,$localFDate,$localSeat,$con);



?>