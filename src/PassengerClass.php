<?php

class Passenger {

    public $email,$name,$passportNo,$mobileNo,$gender,$age,$nationality,$address;
    private $password;
    
    function login($email, $password, $con) {
        $query = "SELECT * FROM passenger WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
    
        if ($row = mysqli_fetch_assoc($result)) { 
            $_SESSION['passenger'] = $row['name'];
            header("Location: Welcome.php?email=" . $row['email']);
            exit(); 
        } else {
            header("location: login.php?Invalid");
            exit(); 
        }
    }
    function getName($email,$con){
        $query = "SELECT * FROM passenger WHERE email='$email'";
        $result = mysqli_query($con, $query);
        if ($row = mysqli_fetch_assoc($result)) { 
            return $row['name'];

        }

    }
    function createUser($name,$email,$passportNo,$mobileNo,$gender,$age,$nationality,$address,$password,$con){
        $query =" INSERT INTO passenger (name,email,passportNo, mobileNo, gender,age,nationality,address,password)
        VALUES ('$name', '$email', '$passportNo','$mobileNo', '$gender', '$age', '$nationality','$address','$password')";
        
        if(mysqli_query($con,$query) == TRUE) {
            //echo "New User regesterd successfully";
            header("location: login.php");
        } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }
        

    }
    function updatePassenger($email, $name, $passportNo, $mobileNo, $gender, $age, $nationality, $address, $password, $con) {
        $query = "UPDATE passenger 
                  SET name='$name', passportNo='$passportNo', mobileNo='$mobileNo', gender='$gender', age='$age', nationality='$nationality', address='$address', password='$password' 
                  WHERE email='$email'";
        
        if (mysqli_query($con, $query) == TRUE) {
            echo "User updated successfully";
        } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }
    }
    
}
?>