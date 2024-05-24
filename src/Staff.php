<?php

Class Staff{

    private $id;
    private $name;


    //function for getting all staff infromation
    function getAllStaff($con)
    {
        $query = "SELECT * from staff";
        $result = $con->query($query);
        
        $staffs = [];
        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $staffs[]=$row;
            }
        }
        return $staffs;//returning array where all staffs(pilot and air hostess) information is stored
    }

    //funtion for getting all pilots information
    function getAllPilot($con)
    {
        $query = "SELECT * from staff where type='Pilot'";
        $result = $con->query($query);
        
        $staffs = [];
        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $staffs[]=$row;
            }
        }
        return $staffs;//returning array where all pilots information is stored
    }

    //function for getting all air hostess information
    function getAllAirHostess($con)
    {
        $query = "SELECT * from staff where type='Air Hostess'";
        $result = $con->query($query);
        
        $staffs = [];
        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $staffs[]=$row;
            }
        }
        return $staffs;//returning array where all air hostess information is stored
    }


    //function for checking if a particular pilot available at a particular date
    function isAvailablePilot($id,$date,$con)
    {
        $query = "SELECT * FROM flight WHERE (pilot='$id' AND fDAte='$date')";
        $result=$con->query($query);
        
        if($result->num_rows > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //function for checking if a particular air hostess available at a particular date
    function isAvailableAirHostess($id,$date,$con)
    {
        $query = "SELECT * FROM flight WHERE (airHostess1='$id' OR airHostess2='$id') AND fDAte='$date'";
        $result=$con->query($query);
        if($result->num_rows>0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //function for checking if a particular pilot is busy with given flight
    function isSameFlightPilot($flightId,$pilot,$con)
    {
        $query = "SELECT * From flight WHERE id='$flightId' AND pilot='$pilot'";
        $result = $con->query($query);
        if($result->num_rows>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    //function for checking if a particular air hostess is busy with given flight
    function isSameFlightAirHostess1($id,$airHostess1,$con)
    {
        $query = "SELECT * From flight WHERE id='$id' AND airHostess1='$airHostess1'";
        $result = $con->query($query);
        if($result->num_rows>0)
        {
           
            return true;
        }
        else
        {
            
            return false;
        }
    }

    //function for checking if a particular air hostess is busy with given flight
    function isSameFlightAirHostess2($id,$airHostess2,$con)
    {
        $query = "SELECT * From flight WHERE id='$id' AND airHostess2='$airHostess2'";
        $result = $con->query($query);
        if($result->num_rows>0)
        {
           
            return true;
        }
        else
        {
            
            return false;
        }
    }


    //function for getting a staff's name by using their id
    function getStaffNameById($id,$con)
    {
        $query = "SELECT name FROM staff WHERE id = '$id'";
        $result = $con->query($query);

        if($result!=null)
        {
            $name = $result->fetch_assoc();
            return $name['name'];
        }
        
    }

}

?>