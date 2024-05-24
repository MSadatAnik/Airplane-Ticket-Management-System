<?php
    // Establish a connection to the MySQL database
    $con = mysqli_connect('localhost', 'root', '', 'airplaneticket');

    // Check if the connection was successful
    if (!$con) {
        // If the connection fails, display an error message
        die('Check your connection: ' . mysqli_connect_error());
    }
?>
