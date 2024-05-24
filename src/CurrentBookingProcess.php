<?php
    // Start the session to use session variables
    session_start();

    // Include the database connection file
    require_once('Connection.php');

    // Include the Booking class file
    require_once('BookingClass.php');

    // Get the email from the POST request
    $localEmail = $_POST['email'];

    // Create a new instance of the Booking class
    $booking = new Booking();

    // Call the currentBooking method to retrieve current bookings for the given email
    $result = $booking->currentBooking($localEmail, $con);

    // Display the bookings in a table format
    echo "<table border='2'>"; 
    echo "<tr>"; 
    echo "<th>BookingId</th>"; 
    echo "<th>FlightId</th>"; 
    echo "<th>Price</th>"; 
    echo "<th>TicketType</th>"; 
    echo "</tr>"; // End table row

    // Loop through the result set and display each booking
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"; 
        echo "<td>" . $row['bId'] . "</td>";            // Display BookingId
        echo "<td>" . $row['id'] . "</td>";             // Display FlightId
        echo "<td>" . $row['price'] . "</td>";          // Display Price
        echo "<td>" . $row['ticketType'] . "</td>";     // Display TicketType
        echo "</tr>"; 
    }

    echo "</table>"; // End table
?>
