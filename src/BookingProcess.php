<?php
    // Start the session to use session variables
    session_start();

    // Include the database connection file
    require_once('Connection.php');

    // Include the Booking class file
    require_once('BookingClass.php');

    // Retrieve POST data from the form submission
    $localId = $_POST['id'];           // Get the flight ID from the POST request
    $localEmail = $_POST['email'];     // Get the email from the POST request
    $locaTicketType = $_POST['class']; // Get the ticket type (class) from the POST request

    // Create a new instance of the Booking class
    $booking = new Booking();

    // Call the bookFlight method with the provided details
    $booking->bookFlight($localId, $localEmail, $locaTicketType, 5000, $con); // The price is set to 5000
?>
