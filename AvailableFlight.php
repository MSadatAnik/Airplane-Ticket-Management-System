
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Management</title>
</head>
<body>
    <h1>Flight List</h1>

    <br>

    <form method="get" action="">
        <label for="searchID">Search by Flight ID:</label>
        <input type="text" id="searchID" name="searchID" >
        <button type="submit">Search</button>
        <button type="submit" name="showAll" value ="1">Show All Flights</button>
    </form>

    <br>

    <table border="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Time</th>
                <th>Date</th>
                <th>Seats</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("Connection.php");
            require_once("Flight.php");
        session_start();
            // Assuming you have a database connection $conn
            //$result = $con->query("SELECT * FROM flight");

            if(isset($_GET['showAll']))
            {
                $flight = new flight();
                $result= $flight->availableFlight($con);
            }
            else if (isset($_GET['searchID']) && !empty($_GET['searchID'])) {
                $searchID = intval($_GET['searchID']); // Sanitize the input
                $flight = new flight();
                $result = $flight->searchFlightByID($con, $searchID);
            }
            
            else
            {

                $flight = new flight();
                $result= $flight->availableFlight($con);
            }

            
            

            //while ($row = $result->fetch_assoc()) 
            if($result!=null)
            {

                foreach($result as $row){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['departure'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['fTime'] . "</td>";
                    echo "<td>" . $row['fDate'] . "</td>";
                    echo "<td>" . $row['availableSeats'] . "</td>";
                    echo "<td>";
                    echo "<a href='EditFlight.php?id=".$row['id']."'>Edit</a> | ";
                    echo "<a href='CancelFlightProcess.php?id=".$row['id']."'onclick='return confirm(\"Are you sure you want to cancel this flight?\");'>Cancel</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            
            ?>
        </tbody>
    </table>

    <br>
</body>
</html>
