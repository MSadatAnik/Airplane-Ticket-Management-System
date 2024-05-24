<?php
    // Include the database connection file
    require_once("Connection.php");

    // Include the AdminClass file
    require_once("AdminClass.php");

    // Start the session to use session variables
    session_start();

    // Create an instance of the AdminClass
    $admin = new Admin();

    // Call the passengerList method to retrieve the list of passengers
    $result = $admin->passengerList($con);

    // Check if there are any passengers retrieved
    if (mysqli_num_rows($result) > 0) {
        // Display the passengers' information in a table format
        echo '<table>';
        echo '<tr>';
        // Table headers
        echo '<th>First Name</th>'; 
        echo '<th>Email No</th>';
        echo '<th>Passport No</th>'; 
        echo '<th>Mobile No</th>'; 
        echo '<th>Gender</th>'; 
        echo '<th>Age</th>'; 
        echo '<th>Nationality</th>'; 
        echo '<th>Address</th>'; 
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            // Table data
            echo '<td>' . $row['name'] . '</td>'; 
            echo '<td>' . $row['email'] . '</td>'; 
            echo '<td>' . $row['passportNo'] . '</td>'; 
            echo '<td>' . $row['mobileNo'] . '</td>'; 
            echo '<td>' . $row['gender'] . '</td>'; 
            echo '<td>' . $row['age'] . '</td>'; 
            echo '<td>' . $row['nationality'] . '</td>'; 
            echo '<td>' . $row['address'] . '</td>'; 
            echo '</tr>';
        }
        echo '</table>';
    }
?>
