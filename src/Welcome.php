<?php
// Start the session
session_start();

// Check if the session 'passenger' is set
if (isset($_SESSION['passenger'])) {

    // Include the database connection file
    require_once('Connection.php');
    
    // Get the name of the logged-in passenger from the session
    $name = $_SESSION['passenger'];
    
    // Get the email from the GET request
    $email = $_GET['email'];
    
    // SQL query to select passenger details based on email
    $query = "SELECT * FROM passenger WHERE email='$email'";
    
    // Execute the query
    $result = mysqli_query($con, $query);
    
    // Fetch the result as an associative array
    $row = mysqli_fetch_array($result);

    // Display welcome message with the passenger's name
    echo 'Welcome ' . $_SESSION['passenger'] . '<br/>';

    // Display passenger details
    echo 'Age: ' . $row['age']; echo '<br/>';
    echo 'Email: ' . $row['email']; echo '<br/>';
    echo 'Passport Number: ' . $row['passportNo']; echo '<br/>';
    echo 'Mobile Number: ' . $row['mobileNo']; echo '<br/>';
    echo 'Gender: ' . $row['gender']; echo '<br/>';

    // Provide a link to update passenger information
    echo '<a href="updatePassenger.php?email=' . $row['email'] . '">Update Info</a><br/>';

    // Provide links to various functionalities
    echo '<a href="AvailableFlight.php? Available Flight">Available Flights </a> <br/>';
    echo '<a href="booking.php?Book Flight">Book Flight</a> <br/>';
    echo '<a href="curbook.php?Check Bookings">Check Current Booking</a> <br/>';
    echo '<a href="cancelb.php?Cancel Booking">Cancel Booking</a><br/>';
  
    echo '<a href="logout.php?logout">Logout</a>';

} else {
    // If the session 'passenger' is not set, redirect to the login page
    header("location:login.php");
}
?>
