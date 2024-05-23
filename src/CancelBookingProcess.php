<?php
    // Start the session to use session variables
    session_start();

    // Include the database connection file
    require_once('Connection.php');

    // Include the Booking class file
    require_once('BookingClass.php');

    // Get the email and booking ID from the POST request
    $localEmail = $_POST['email'];
    $bookingId = $_POST['bId'];

    // Create a new instance of the Booking class
    $booking = new Booking();

    // Call the cancelFlight method with the provided email, booking ID, and database connection
    $booking->cancelFlight($localEmail, $bookingId, $con);
?>
