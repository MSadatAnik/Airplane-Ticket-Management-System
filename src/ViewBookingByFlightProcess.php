<?php
    // Start the session to use session variables
    session_start();

    // Include the database connection file
    require_once('Connection.php');

    // Include the Booking class file
    require_once('BookingClass.php');

    // Get the flight ID from the POST request
    $localid = $_POST['id'];

    // Create a new instance of the Booking class
    $booking = new Booking();

    // Call the currentBookingbyFlight method to retrieve current bookings for the given flight ID
    $result = $booking->currentBookingbyFlight($localid, $con);

    // Display the bookings in a table format
    echo "<table border='2'>"; 
    echo "<tr>"; 
    echo "<th>BookingId</th>"; 
    echo "<th>Email</th>"; 
    echo "<th>TicketType</th>"; 
    echo "</tr>"; 

    // Loop through the result set and display each booking
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"; 
        echo "<td>" . $row['bId'] . "</td>";
        echo "<td>" . $row['email'] . "</td>"; 
        echo "<td>" . $row['ticketType'] . "</td>"; 
        echo "</tr>"; // 
    }
    echo "</table>"; // End table
?>
