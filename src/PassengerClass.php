<?php

class Passenger {

    public $email,$name,$passportNo,$mobileNo,$gender,$age,$nationality,$address;
    private $password;
    // Function to authenticate user login
    function login($email, $password, $con) {
        $query = "SELECT * FROM passenger WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
        
     // If user exists, set session and redirect to welcome page
        
        if ($row = mysqli_fetch_assoc($result)) { 
            $_SESSION['passenger'] = $row['name'];
            header("Location: Welcome.php?email=" . $row['email']);
            exit(); 
        } else {
            // If user does not exist, redirect to login page with error
            header("location: login.php?Invalid");
            exit(); 
        }
    }
     // Function to retrieve user name by email
    function getName($email,$con){
        $query = "SELECT * FROM passenger WHERE email='$email'";
        $result = mysqli_query($con, $query);
        if ($row = mysqli_fetch_assoc($result)) { 
            return $row['name'];

        }

    }
     // Function to create a new user
    function createUser($name,$email,$passportNo,$mobileNo,$gender,$age,$nationality,$address,$password,$con){
        $query =" INSERT INTO passenger (name,email,passportNo, mobileNo, gender,age,nationality,address,password)
        VALUES ('$name', '$email', '$passportNo','$mobileNo', '$gender', '$age', '$nationality','$address','$password')";
           // Execute query and redirect to login page on success
        if(mysqli_query($con,$query) == TRUE) {
            //echo "New User regesterd successfully";
            header("location: login.php");
        } else {
            // Display error message if query fails
            echo "Error: " . $query . "<br>" . $con->error;
        }
        

    }
    // Function to update user details
    function updatePassenger($email, $name, $passportNo, $mobileNo, $gender, $age, $nationality, $address, $password, $con) {
        $query = "UPDATE passenger 
                  SET name='$name', passportNo='$passportNo', mobileNo='$mobileNo', gender='$gender', age='$age', nationality='$nationality', address='$address', password='$password' 
                  WHERE email='$email'";
         // Display success message or error message based on query execution
        if (mysqli_query($con, $query) == TRUE) {
            echo "User updated successfully";
        } else {
            // Display error message if query fails
            echo "Error: " . $query . "<br>" . $con->error;
        }
    }
    
}
?>
