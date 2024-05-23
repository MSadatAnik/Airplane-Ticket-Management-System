<?php
    // Start the session to use session variables
    session_start();

    // Include the connection file to connect to the database
    require_once('Connection.php');

    // Display a welcome message with the admin's name from the session variable
    echo "Hello " . $_SESSION['admin'] . "<br>";
?>


<!DOCTYPE html>
    <head>
        <title>
            Admin
        </title>
    </head>
    <body>
        <!-- Button to navigate to the create flight page -->
        <button class = "Btn"><a href = "">Create Flight</a></button><br>
        
        <!-- Button to navigate to the edit flight page -->
        <button class = "Btn"><a href = "">Edit Flight</a></button><br>
        
        <!-- Button to navigate to the cancel flight page -->
        <button class = "Btn"><a href = "">Cancel Flight</a></button><br>
        
        <!-- Button to navigate to the view bookings by flight page -->
        <button class = "Btn"><a href = "ViewBookingByFlight.html">View Bookings</a></button><br>
        
        <!-- Button to navigate to the view passengers page -->
        <button class = "Btn"><a href = "ViewPassenger.php">View Passengers</a></button><br>
        
        <!-- Button to log out -->
        <button class = "Btn"><a href = "">Logout</a></button>
    </body>
</html>


