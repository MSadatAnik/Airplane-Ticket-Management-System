<!DOCTYPE html> <!-- Declare the document type as HTML5 -->
<html lang="en">
<head>
    <title>Booking</title>
</head>
<body>
    <!-- Main heading of the page -->
    <h1>Flight List</h1>
    <!-- Table to display the list of flights -->
    <table border="2">
        <thead>
            <tr>
                <!-- Table headers -->
                <th>ID</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Time</th>
                <th>Date</th>
                <th>Seats</th>
                <th>Book</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Include the connection file to connect to the database
                require_once("Connection.php");

                // Execute a query to select all flights from the flight table
                $result = $con->query("SELECT * FROM flight");

                // Loop through each row in the result set
                while ($row = $result->fetch_assoc()) {
                    // Start a new table row
                    echo "<tr>";
                    // Display flight details in table cells
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['departure'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['fTime'] . "</td>";
                    echo "<td>" . $row['fDate'] . "</td>";
                    echo "<td>" . $row['availableSeats'] . "</td>";
                    // Provide a link to book the flight
                    echo "<td>";
                    echo "<a href='BookingType.php?id=" . $row['id'] . "'>Book</a> | ";
                    echo "</td>";
                    // End the table row
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
