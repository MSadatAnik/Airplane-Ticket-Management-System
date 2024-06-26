<?php

    class Admin {

        public string $email;
        private string $password;
        
        /**
         * Admin login function
         *
         * @param string $email - Admin's email
         * @param string $password - Admin's password
         * @param object $con - MySQLi connection object
         */

        function adminLogin($email, $password, $con) {
            // Query to check if the admin credentials are in the passenger table
            $query = "SELECT * FROM admin WHERE adminEmail='$email' AND adminPass='$password'";
            
            // Execute the query
            $result = mysqli_query($con, $query);
        
            // If a matching row is found
            if ($row = mysqli_fetch_assoc($result)) { 
                // Store the admin's name in the session
                $_SESSION['admin'] = $row['adminName'];
                
                // Redirect to the admin main page
                header("location: AdminMainPage.php");
                exit();

            } else {
                // Redirect to the login page with an "Invalid" parameter if login fails
                header("location: AdminLogin.html?Invalid");
                exit(); 
            }
        }

        public function adminLogout($x){
            unset($_SESSION['admin']);
            session_destroy();
            header('Location: index.html');
        }

        /**
         * Get the list of passengers
         *
         * @param object    $con - MySQLi connection object
         * @return object - Result set of the query
         */
        
        function passengerList($con){
            // Query to select all passengers from the passenger table
            $query = "SELECT * FROM passenger";
            
            // Execute the query
            $result = mysqli_query($con, $query);
            
            // Return the result set
            return $result;
        }
    }
?>

