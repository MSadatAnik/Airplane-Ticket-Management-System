<?php
class  Flight{
    private $adminName;
    private $id;
    private $departure;
    private $destination;
    private $fTime;
    private $fDate;
    private $availableSeats;


  /*  public function construct($adminName,$id,$departure,$destination,$fTime,$fDate,$availableSeats)
    {
        $this->adminName=$adminName;
        $this->id=$id;
        $this->departure = $departure;
        $this->destination = $destination;
        $this->fTime = $fTime;
        $this->fDate = $fDate;
        $this->availableSeats = $availableSeats;
    }*/

    function createFlight($adminName,$departure,$destination,$fTime,$fDate,$availableSeats,$con)
    {
       // $sql = "INSERT INTO flight (adminName,departure,destination,fTIme,fDate,availableSeats) 
        //VALUES ('$adminName','$departure',''$destination','$fTime','$fDate','$availableSeats')";

        $sql = $con->prepare("INSERT INTO flight (departure, destination, fDate, fTime, availableSeats) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('sssss', $departure, $destination, $fDate, $fTime, $availableSeats);

    // Execute the statement
    $sql->execute();


    if ($sql->affected_rows > 0) {
        return "Flight created successfully!";
      } else {
        return "Error creating flight: " . $con->error;
      }
  
      // Close the connection (always close after use)
      $sql->close();
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
