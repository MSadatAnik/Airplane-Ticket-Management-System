<?php
    // Define the Booking class
    class Booking {
        // Public properties for serial number and ticket type
        public $serialNo;
        public $ticketType;

        /**
         * Method to book a flight
         *
         * @param int     $id Flight ID
         * @param string  $email Email of the user
         * @param string  $class Class of the ticket (e.g., economy, business)
         * @param float   $price Price of the ticket
         * @param mysqli  $con Database connection
         */
        public function bookFlight($id, $email, $class, $price, $con) {
          
            try {
                // 2. Database Connection Check
                if (!$con->ping()) {
                    throw new Exception("Database connection error");
                }
          
                // 3. Select Flight (with error handling)
                $sql = "SELECT * FROM flight WHERE id=$id";
                $result = $con -> query($sql);
          
                if (!$result) {
                    throw new Exception("Error fetching flight details: " . mysqli_error($con));
                }
            
                $row = mysqli_fetch_assoc($result);
            
                // 4. Check Available Seats (with error handling)
                if (!$row || $row['totalSeats'] <= 0) {
                    throw new Exception("No available seats for this flight");
                }
            
                // 5. Insert Booking (with error handling)
                $sql1 = "INSERT INTO booking (id, email, price, ticketType) VALUES ($id, '$email', $price, '$class')";
                $insertResult = $con -> query($sql1);
            
                if (!$insertResult) {
                    throw new Exception("Error inserting booking: " . mysqli_error($con));
                }
            
                $bookingId = mysqli_insert_id($con);
            
                // 6. Update Available Seats (Total) (with error handling)
                $curSeat = $row['totalSeats'] - 1;
                $sql2 = "UPDATE flight SET totalSeats = $curSeat WHERE id=$id";
                $updateResult = $con -> query($sql2);
            
                if (!$updateResult) {
                    throw new Exception("Error updating available seats: " . mysqli_error($con));
                }

                //6.1 Update Available Seats (BusinessClass)

                if($class == 'businessClass') { //economyClass,firstClass,businessClass

                    $curBusinessClassSeat = $row['businessSeats'] - 1;
                    $sql2 = "UPDATE flight SET businessSeats = $curBusinessClassSeat WHERE id=$id";
                    $updateResult1 = $con -> query($sql2);
                
                    if (!$updateResult1) {
                        throw new Exception("Error updating available seats: " . mysqli_error($con));
                    }

                //6.2 Update Available Seats (EconomyClass)

                } else if($class == 'economyClass') {

                    $curEconomyClassSeat = $row['economySeats'] - 1;
                    $sql2 = "UPDATE flight SET economySeats = $curEconomyClassSeat WHERE id = $id";
                    $updateResult1 = $con -> query($sql2);
                
                    if (!$updateResult1) {
                        throw new Exception("Error updating available seats: " . mysqli_error($con));
                    }

                //6.3 Update Available Seats (FirstClass)

                } else if($class == 'firstClass') {

                    $curFirstClassSeat = $row['firstClassSeats'] - 1;
                    $sql2 = "UPDATE flight SET firstClassSeats = $curFirstClassSeat WHERE id = $id";
                    $updateResult1 = $con -> query($sql2);
                
                    if (!$updateResult1) {
                        throw new Exception("Error updating available seats: " . mysqli_error($con));
                    }
                    
                } else {

                    throw new Exception("Error updating available seats: " . mysqli_error($con));

                }    
            
                // 7. Check User Registration (with error handling)
                $sql3 = "SELECT * FROM passenger WHERE email = '$email'";
                $result3 = $con -> query($sql3);
            
                if (!$result3) {
                    throw new Exception("Error checking user registration: " . mysqli_error($con));
                }
            
                $numRows = mysqli_num_rows($result3);
            
                // 8. Redirect based on User Registration (optional)
                if ($numRows > 0) {
                    header("Location: Welcome.php");
                    exit();
                } else {
                    header("Location: index.html?bookingId=$bookingId");
                    exit();
                }
            
            } catch (Exception $e) {
                // 9. Error Handling (log or display user-friendly message)
                error_log($e->getMessage(), 3, "error.log");
                header("Location: Booking.php?Error=" . $e->getMessage());
                exit();
            }
        }
          
        
        public function cancelFlight($email, $id, $con) {

            try {
                // Select booking by booking ID and email
                $sql = "SELECT * FROM booking WHERE bId=$id AND email='$email'";
                $result = mysqli_query($con, $sql);
        
                if (!$result) {
                    throw new Exception("Error fetching booking details: " . mysqli_error($con));
                }
        
                $row = mysqli_fetch_assoc($result);
                $class = $row['ticketType'];
        
                if (!$row) {
                    throw new Exception("No booking found for this ID and email");
                }
        
                // Select the flight by flight ID
                $sql4 = "SELECT * FROM flight WHERE id=" . $row['id'];
                $result2 = mysqli_query($con, $sql4);
        
                if (!$result2) {
                    throw new Exception("Error fetching flight details: " . mysqli_error($con));
                }
        
                $row4 = mysqli_fetch_assoc($result2);
        
                // Update the available seats in the flight table
                $curSeat = $row4['totalSeats'] + 1;
                $curBusinessClassSeat = $row4['businessSeats'];
                $curEconomyClassSeat = $row4['economySeats'];
                $curFirstClassSeat = $row4['firstClassSeats'];
        
                // Delete the booking
                $sql1 = "DELETE FROM booking WHERE bId=$id AND email='$email'";
        
                if (!mysqli_query($con, $sql1)) {
                    throw new Exception("Error deleting booking: " . mysqli_error($con));
                }
        
                // Update flight available seats
                $sql2 = "UPDATE flight SET totalSeats = $curSeat WHERE id=" . $row['id'];
        
                if (!mysqli_query($con, $sql2)) {
                    throw new Exception("Error updating available seats: " . mysqli_error($con));
                }
        
                // Update class specific seats
                switch ($class) {
                    case 'economyClass':
                        $curEconomyClassSeat++;
                        break;
                    case 'businessClass':
                        $curBusinessClassSeat++;
                        break;
                    case 'firstClass':
                        $curFirstClassSeat++;
                        break;
                    default:
                        throw new Exception("Invalid seat class");
                }
        
                // Update flight seats based on class
                $sql3 = "UPDATE flight SET economySeats = $curEconomyClassSeat, businessSeats = $curBusinessClassSeat, firstClassSeats = $curFirstClassSeat WHERE id=" . $row['id'];
        
                if (!mysqli_query($con, $sql3)) {
                    throw new Exception("Error updating available seats: " . mysqli_error($con));
                }
        
                // Check if email is from a registered user
                $sql3 = "SELECT * FROM passenger WHERE email = '$email'";
                $result3 = mysqli_query($con, $sql3);
        
                if (!$result3) {
                    throw new Exception("Error checking user registration: " . mysqli_error($con));
                }
        
                $numRows = mysqli_num_rows($result3);
        
                // Redirect based on user registration
                if ($numRows > 0) {
                    header("Location: Welcome.php");
                    exit();
                } else {
                    header("Location: index.html");
                    exit();
                }
            } catch (Exception $e) {
                // Log the error
                error_log($e->getMessage(), 3, "error.log");
        
                // Redirect with specific error message
                header("Location: CancelBooking.html?Error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
          

        /**
         * Method to get current bookings by email
         *
         * @param string           $email Email of the user
         * @param mysqli           $con Database connection
         * @return mysqli_result   Result set of bookings
         */
        public function currentBooking($email, $con) {
            // Select all bookings by email
            $sql = "SELECT * FROM booking WHERE email='$email'";
            $result = mysqli_query($con, $sql);
            return $result;
        }

        /**
         * Method to get current bookings by flight ID
         *
         * @param int              $id Flight ID
         * @param mysqli           $con Database connection
         * @return mysqli_result   Result set of bookings
         */
        public function currentBookingbyFlight($id, $con) {
            // Select all bookings by flight ID
            $sql = "SELECT * FROM booking WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            return $result;
        }
    }
?>
