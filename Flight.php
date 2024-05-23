<?php
class  Flight{
    private $adminName;
    private $id;
    private $departure;
    private $destination;
    private $fTime;
    private $fDate;
    private $availableSeats;


    //function for creating new flight
    function createFlight($adminName,$departure,$destination,$fTime,$fDate,$availableSeats,$economySeats,$businessSeats,$firstClassSeats,$pilot,$airHostess1,$airHostess2,$con)
    {
       

        $query="INSERT INTO flight (adminName,departure, destination, fDate, fTime, totalSeats,economySeats,businessSeats,firstClassSeats,pilot,airHostess1,airHostess2)
                VALUES ('$adminName','$departure', '$destination', '$fDate', '$fTime', '$availableSeats', '$economySeats', '$businessSeats', '$firstClassSeats','$pilot','$airHostess1','$airHostess2')";

        if(mysqli_query($con,$query) == TRUE) {
            echo "Flight created successfully!";
        } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }

    }

    //function for viewing all created flights / available flights
    function availableFlight($con)
    {
        $query = "SELECT * FROM flight";
        $result = $con->query($query);
        

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


    //functoin for search a flight details with flight id
    function searchFlightByID($con, $searchID)
    {
        $query = "SELECT * FROM flight WHERE id=$searchID";
        $result = $con->query($query);
        

        // Check for successful execution
        if ($result->num_rows > 0) {
        
                    return $result;
                } else {
                    echo "No flights found.";
                    
     }
    }

    //function for canceling a flight
    function cancelFlight($id,$con)
     {
        $query = "DELETE FROM flight WHERE id = $id";
        $result = $con->query($query);
        
    
        if ($result) {
            echo "Flight deleted successfully!";
        } else {
            echo "Error: " . $con->error;
        }
        
       
        header("Location: AvailableFlight.php"); // Redirect to the flight list page after deletion
        exit();
    } 
     
    //functiom for editng a flight
    function editFlight($id,$adminName,$departure,$destination,$fTime,$fDate,$availableSeats,$economySeats,$businessSeats,$firstClassSeats,$pilot,$airHostess1,$airHostess2,$con)
    {
        $query = "UPDATE flight SET adminName = '$adminName', departure = '$departure' , destination = '$destination',
                    fTime = '$fTime', fDate = '$fDate' , totalSeats = '$availableSeats', economySeats='$economySeats',
                    businessSeats='$businessSeats', firstClassSeats='$firstClassSeats',
                    pilot='$pilot', airHostess1='$airHostess1', airHostess2='$airHostess2' WHERE id='$id'";
        $result = $con->query($query);

        if ($result) {
            echo "Flight edited successfully!";
        } else {
            echo "Error: " . $con->error;
        }
    }



}

?>
