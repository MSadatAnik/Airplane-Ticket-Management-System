<?php
class  Flight{
    private $adminName;
    private $id;
    private $departure;
    private $destination;
    private $fTime;
    private $fDate;
    private $availableSeats;


    function createFlight($adminName,$departure,$destination,$fTime,$fDate,$availableSeats,$economySeats,$businessSeats,$firstClassSeats,$pilot,$airHostess1,$airHostess2,$con)
    {
       

        $query="INSERT INTO flight (departure, destination, fDate, fTime, totalSeats,economySeats,businessSeats,firstClassSeats,pilot,airHostess1,airHostess2)
                VALUES ('$departure', '$destination', '$fDate', '$fTime', '$availableSeats', '$economySeats', '$businessSeats', '$firstClassSeats','$pilot','$airHostess1','$airHostess2')";

        if(mysqli_query($con,$query) == TRUE) {
            echo "Flight created successfully!";
        } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }

    }

    function availableFlight($con)
    {
        $sql = "SELECT * FROM flight";
        $result = $con->query($sql);
        

        // Check for successful execution
        if ($result->num_rows > 0) {
        // Create an array to store flight data
             $flights = [];
            while ($row = $result->fetch_assoc()) {
                 $flights[] = $row;
                    }
                    return $flights;
                } else {
                    echo "No flights found.";
     }

    }


    function searchFlightByID($con, $searchID)
    {
        $sql = "SELECT * FROM flight WHERE id=$searchID";
        $result = $con->query($sql);
        

        // Check for successful execution
        if ($result->num_rows > 0) {
        
                    return $result;
                } else {
                    echo "No flights found.";
                    
     }
    }

    function cancelFlight($id,$con)
     {
        $sql = "DELETE FROM flight WHERE id = $id";
        $result = $con->query($sql);
        
    
        if ($result) {
            echo "Flight deleted successfully!";
        } else {
            echo "Error: " . $con->error;
        }
        
       
        header("Location: AvailableFlight.php"); // Redirect to the flight list page after deletion
        exit();
    } 
     
    function editFligt($id,$con)
    {

    }



}

?>
