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
    echo "<table border='2'>"; // Start table
    echo "<tr>"; // Start table row
    echo "<th>BookingId</th>"; // Table header for BookingId
    echo "<th>FlightId</th>"; // Table header for FlightId
    echo "<th>Price</th>"; // Table header for Price
    echo "<th>TicketType</th>"; // Table header for TicketType
    echo "</tr>"; // End table row

    // Loop through the result set and display each booking
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"; // Start table row for each booking
        echo "<td>" . $row['bId'] . "</td>"; // Display BookingId
        echo "<td>" . $row['id'] . "</td>"; // Display FlightId
        echo "<td>" . $row['price'] . "</td>"; // Display Price
        echo "<td>" . $row['ticketType'] . "</td>"; // Display TicketType
        echo "</tr>"; // End table row for each booking
    }

    echo "</table>"; // End table
?>
