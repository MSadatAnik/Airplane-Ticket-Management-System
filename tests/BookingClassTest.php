<?php
    use PHPUnit\Framework\TestCase;

    require_once 'src/BookingClass.php';

    class BookingClassTest extends TestCase {

        protected $con;     // Database connection
        protected $booking; // Instance of the Booking class

        // Set up the test environment
        protected function setUp(): void
        {
            // Establish a connection to the test database
            $this->con = new mysqli('localhost', 'root', '', 'airplaneticket');

            // Instantiate the Booking class
            require_once 'src/BookingClass.php'; 
            $this->booking = new Booking();
        }

        // Test booking a flight
        public function testBookFlight()
        {
            
            // Arrange
            $id = 64; // Example flight ID
            $email = "testuser@example.com";
            $class = "economyClass";
            $price = 100.0;
            
            // Act
            $this->booking->bookFlight($id, $email,$class, $price, $this->con);
            // Assert
            // Verify that the booking was successfully inserted into the database

            $result = $this->con->query("SELECT * FROM booking WHERE email='$email' AND id=$id");
            $this->assertNotEmpty($result->fetch_assoc(), "Booking should be inserted into the database");
        }

        // Test canceling a flight booking
        public function testCancelFlight()
        {
            // Arrange
            $id = 10; // Example booking ID
            $email = "testuser@example.com";

            // Act
            $this->booking->cancelFlight($email, $id, $this->con);

            // Assert
            // Verify that the booking was successfully canceled (deleted) from the database
            $result = $this->con->query("SELECT * FROM booking WHERE email='$email' AND bId=$id");
            $this->assertEmpty($result->fetch_assoc(), "Booking should be canceled (deleted) from the database");
        }

        // Test getting current bookings by email
        public function testGetCurrentBookingsByEmail()
        {
            // Arrange
            $email = "testuser@example.com";

            // Act
            $result = $this->booking->currentBooking($email, $this->con);

            // Assert
            // Verify that there are bookings associated with the provided email
            $this->assertNotEmpty($result->fetch_assoc(), "There should be bookings associated with the provided email");
        }

        // Test getting current bookings by flight ID
        public function testGetCurrentBookingsByFlightId()
        {
            // Arrange
            $id = 64; // Example flight ID

            // Act
            $result = $this->booking->currentBookingbyFlight($id, $this->con);

            // Assert
            // Verify that there are bookings associated with the provided flight ID
            $this->assertNotEmpty($result->fetch_assoc(), "There should be bookings associated with the provided flight ID");
        }

        // Clean up after each test
        protected function tearDown(): void
        {
            // Close the database connection
            $this->con->close();
        }
        
    }
?>