<?php
require_once("Connection.php");
require_once("Flight.php");
session_start();

$flight = new flight();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $flight->cancelFlight($id,$con); //It will cancel the flight
}
    else {
        echo "Invalid flight ID.";
        exit();
    }

?>
