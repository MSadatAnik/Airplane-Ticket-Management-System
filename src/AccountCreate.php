<?php
require_once("connection.php");
require_once("PassengerClass.php");
session_start();

    $name = $_POST["name"];
    $email = $_POST["email"];
	$passportNo = $_POST["passportNo"];
	$mobileNo = $_POST["mobileNo"];
	$gender = $_POST["gender"];
	$age = $_POST["age"];
	$address = $_POST["address"];
	$nationality = $_POST["nationality"];
	$password = $_POST["password"];
     
    $passenger=new passenger();
    $passenger -> createUser($name,$email,$passportNo,$mobileNo,$gender,$age,$nationality,$address,$password, $con);

?>    


