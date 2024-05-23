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
                $result = mysqli_query($con, $sql);
          
                if (!$result) {
                    throw new Exception("Error fetching flight details: " . mysqli_error($con));
                }
            
                $row = mysqli_fetch_assoc($result);
            
                // 4. Check Available Seats (with error handling)
                if (!$row || $row['availableSeats'] <= 0) {
                    throw new Exception("No available seats for this flight");
                }
            
                // 5. Insert Booking (with error handling)
                $sql1 = "INSERT INTO booking (id, email, price, ticketType) VALUES ($id, '$email', $price, '$class')";
                $insertResult = mysqli_query($con, $sql1);
            
                if (!$insertResult) {
                    throw new Exception("Error inserting booking: " . mysqli_error($con));
                }
            
                $bookingId = mysqli_insert_id($con);
            
                // 6. Update Available Seats (with error handling)
                $curSeat = $row['availableSeats'] - 1;
                $sql2 = "UPDATE flight SET availableSeats = $curSeat WHERE id=$id";
                $updateResult = mysqli_query($con, $sql2);
            
                if (!$updateResult) {
                    throw new Exception("Error updating available seats: " . mysqli_error($con));
                }
            
                // 7. Check User Registration (with error handling)
                $sql3 = "SELECT * FROM passenger WHERE email = '$email'";
                $result3 = mysqli_query($con, $sql3);
            
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
                error_log($e->getMessage(), 3, "/path/to/error.log");
                header("Location: Booking.php?Error=" . $e->getMessage());
                exit();
                }
        }
          
        
        /**
         * Method to cancel a flight booking
         *
         * @param string   $email Email of the user
         * @param int      $id Booking ID
         * @param mysqli   $con Database connection
         */
        public function cancelFlight($email, $id, $con) {
            // Select booking by booking ID and email
            $sql = "SELECT * FROM booking WHERE bId=$id AND email='$email'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            // Select the flight by flight ID
            $sql4 = "SELECT * FROM flight WHERE id=" . $row['id'];
            $result2 = mysqli_query($con, $sql4);
            $row4 = mysqli_fetch_assoc($result2);

            if ($result) {
                // Update the available seats in the flight table
                $curSeat = $row4['availableSeats'] + 1;
                // Delete the booking
                $sql1 = "DELETE FROM booking WHERE bId=$id AND email='$email'";

                if (mysqli_query($con, $sql1)) {
                    $sql2 = "UPDATE flight SET availableSeats = $curSeat WHERE id=" . $row['id'];

                    if (mysqli_query($con, $sql2)) {
                        // Check if email is from a registered user
                        $sql3 = "SELECT * FROM passenger WHERE email = '$email'";
                        $result3 = mysqli_query($con, $sql3);
                        $numRows = mysqli_num_rows($result3);

                        if ($numRows > 0) {
                            // Redirect to welcome page if email is from a registered user
                            header("Location: Welcome.php");
                            exit();
                        } else {
                            // Redirect to index page if email is not from a registered user
                            header("Location: index.html");
                            exit();
                        }
                    } else {
                        // Redirect with error if updating available seats fails
                        header("Location: CancelBooking.html?Invalid");
                    }
                } else {
                    // Redirect with error if deleting booking fails
                    header("Location: CancelBooking.html?Invalid");
                }
            } else {
                // Redirect with error if no booking found
                header("Location: CancelBooking.html?No Booking");
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
