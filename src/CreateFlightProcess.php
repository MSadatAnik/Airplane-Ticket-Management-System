<?php

require_once("Connection.php");
//require_once("AdminClass.php");
require_once("Flight.php");
require_once("Staff.php");
session_start();
//retriving every atribute value
$localDeparture = $_POST['departure'];
$localDestination = $_POST['destination'];
$localFTime = $_POST['fTime'];

$localFDate = $_POST['fDate'];
$localSeat = $_POST['totalSeats'];
$localEconomySeat = $_POST['economySeats'];
$localBusinessSeats = $_POST['businessSeats'];
$localFirstClassSeats = $_POST['firstClassSeats'];

$localPilot = $_POST['pilot'];
$localAirHostess1 = $_POST['airHostess1'];
$localAirHostess2 = $_POST['airHostess2'];

$staffCheck = new staff();

//checking if appointed pilot is available for that or he has another flight for that day
if(!$staffCheck->isAvailablePilot($localPilot,$localFDate,$con))
{
    echo "<script>alert('Pilot " .$staffCheck->getStaffNameById($localPilot,$con)." is busy at the specified time. Please choose a different time or Pilot.'); window.history.back();</script>";
}

//checking if appointed air hostess is available for that or he has another flight for that day
else if(!$staffCheck->isAvailableAirHostess($localAirHostess1,$localFDate,$con))
{
    echo "<script>alert('Air Hostess " .$staffCheck->getStaffNameById($localAirHostess1,$con)." is busy at the specified time. Please choose a different time or Air Hostess.'); window.history.back();</script>";
}

//checking if appointed air hostess is available for that or he has another flight for that day
else if(!$staffCheck->isAvailableAirHostess($localAirHostess2,$localFDate,$con))
{
    echo "<script>alert('Air Hostess " .$staffCheck->getStaffNameById($localAirHostess2,$con)." is busy at the specified time. Please choose a different time or Air Hostess.'); window.history.back();</script>";
}

//checking if total seat is distributed correctly
else if($localSeat!=($localEconomySeat+$localBusinessSeats+$localFirstClassSeats))
{
    echo "<script>alert('Wrong distribution of seats!!'); window.history.back();</script>";
}

//creating new flight
else
{
    $flight = new App\flight();
    echo $flight-> createFlight("Admin",$localDeparture,$localDestination,$localFTime,$localFDate,
                        $localSeat,$localEconomySeat,$localBusinessSeats,$localFirstClassSeats,
                        $localPilot,$localAirHostess1,$localAirHostess2,$con);
    
        header("Location: AvailableFlight.php"); // Redirect to the flight list page after deletion
        exit();
}




?>