<?php
    // Include the connection file to connect to the database
    require_once("Connection.php");
    
    // Include the AdminClass file to use the Admin class
    require_once("AdminClass.php");
    
    // Start the session to use session variables
    session_start();

    // Retrieve the email and password from the POST request
    $localEmail = $_POST['email'];
    $localPassword = $_POST['password'];

    // Create a new instance of the Admin class
    $admin = new Admin(); 
    
    // Call the adminLogin method with the provided email, password, and database connection
    $admin->adminLogin($localEmail, $localPassword, $con);
?>
