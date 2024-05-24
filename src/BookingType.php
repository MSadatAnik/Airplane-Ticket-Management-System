<?php
    // Start the session to use session variables
    session_start();

    // Check if 'id' parameter is set in the GET request and assign it to $id
    // If 'id' is not set, assign null to $id
    $id = isset($_GET['id']) ? $_GET['id'] : null; 

    // Output the flight ID (for debugging purposes)
    //echo $id;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking</title>
</head>
<body>
    <!-- Form for booking a flight -->
    <form action="BookingProcess.php" method="post">
        <!-- Hidden input field to pass the flight ID to the server -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Input field for the user's email -->
        <input type="text" name="email" placeholder="Email" required>
        <br>
        
        <!-- Radio button for selecting Business Class -->
        <label>Business Class</label>
        <input type="radio" name="class" value="businessClass" required>
        <br>

        <!-- Radio button for selecting First Class -->
        <label>First Class</label>
        <input type="radio" name="class" value="firstClass" required>
        <br>

        <!-- Radio button for selecting Economy Class -->
        <label>Economy Class</label>
        <input type="radio" name="class" value="economyClass" required>
        <br>

        <!-- Submit button to confirm the booking -->
        <button class="Btn">Confirm</button>
    </form>
</body>
</html>
