<?php

Class Staff{

    private $id;
    private $type;
    private $name;


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
        return $staffs;
    }

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
        return $staffs;
    }

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
        return $staffs;
    }


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