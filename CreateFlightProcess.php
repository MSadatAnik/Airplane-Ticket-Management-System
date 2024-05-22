<?php

require_once("Connection.php");
require_once("AdminClass.php");
require_once("Flight.php");
require_once("Staff.php");
session_start();

$localDeparture = $_POST['departure'];
$localDestination = $_POST['destination'];
$localFTime = $_POST['fTime'];
//$localFDate = date('Y-m-d',strtotime($_POST['fDate']));
$localFDate = $_POST['fDate'];
$localSeat = $_POST['totalSeats'];
$localEconomySeat = $_POST['economySeats'];
$localBusinessSeats = $_POST['businessSeats'];
$localFirstClassSeats = $_POST['firstClassSeats'];

$localPilot = $_POST['pilot'];
$localAirHostess1 = $_POST['airHostess1'];
$localAirHostess2 = $_POST['airHostess2'];

$staffCheck = new staff();

if(!$staffCheck->isAvailablePilot($localPilot,$localFDate,$con))
{
    echo "<script>alert('Pilot " .$staffCheck->getStaffNameById($localPilot,$con)." is busy at the specified time. Please choose a different time or Pilot.'); window.history.back();</script>";
}

else if(!$staffCheck->isAvailableAirHostess($localAirHostess1,$localFDate,$con))
{
    echo "<script>alert('Air Hostess " .$staffCheck->getStaffNameById($localAirHostess1,$con)." is busy at the specified time. Please choose a different time or Air Hostess.'); window.history.back();</script>";
}

else if(!$staffCheck->isAvailableAirHostess($localAirHostess2,$localFDate,$con))
{
    echo "<script>alert('Air Hostess " .$staffCheck->getStaffNameById($localAirHostess2,$con)." is busy at the specified time. Please choose a different time or Air Hostess.'); window.history.back();</script>";
}
else if($localSeat!=($localEconomySeat+$localBusinessSeats+$localFirstClassSeats))
{
    echo "<script>alert('Wrong distribution of seats!!'); window.history.back();</script>";
}

else
{
    $flight = new flight();
    $flight-> createFlight("Admin",$localDeparture,$localDestination,$localFTime,$localFDate,
                        $localSeat,$localEconomySeat,$localBusinessSeats,$localFirstClassSeats,
                        $localPilot,$localAirHostess1,$localAirHostess2,$con);
}





?>