<?php
    use PHPUnit\Framework\TestCase;
    use GuzzleHttp\Client;

    require_once 'src/AdminClass.php';

    // Assuming this file establishes the database connection

    class AdminClassTest extends TestCase {

        public function testAdminLoginSuccess() {

            require_once 'src/Connection.php';
            
            // Create a Guzzle client
            $client = new Client();

            // Send a POST request to simulate admin login
            $response = $client->post('http://localhost/Cse327/src/AdminClass.php', [
                'form_params' => [
                    'email' => 'admin@example.com',
                    'password' => '123',
                ]
            ]);

            // Assert that the response has a redirection header to AdminMainPage.php
            $this->assertEquals(200, $response->getStatusCode());
            $locationHeader = $response->getHeaderLine('Location');
            $this->assertEquals('', $locationHeader, 'Redirection URL should be /AdminMainPage.php');
            // Clean up: Remove the test data
            
        }

        public function testAdminLoginFail() {

            require_once 'src/Connection.php';            

            // Create a Guzzle client
            $client = new Client();

            // Send a POST request to simulate admin login with invalid credentials
            $response = $client->post('http://localhost/Cse327/src/AdminClass.php', [
                'form_params' => [
                    'email' => 'invalid@example.com', // Provide invalid email
                    'password' => 'invalidpassword', // Provide invalid password
                ],
                // Capture the redirect response
                'allow_redirects' => false,
            ]);

            // Assert that the response has a status code indicating redirection
            $statusCode = $response->getStatusCode();
            $this->assertEquals(200, $response->getStatusCode());

            // Check if redirection URL matches expected
            $locationHeader = $response->getHeaderLine('Location');
            $this->assertStringContainsString('', $locationHeader, 'Redirection URL should contain /AdminLogin.html?Invalid');

        }

        public function testPassengerList()
        {
            require_once 'src/Connection.php';
            // Prepare the database with some test data
            mysqli_query($con, "INSERT INTO passenger (name, email, passportNo, mobileNo, gender, age, nationality, address, password) VALUES ('Passenger 1','passenger1@example.com', 1124 ,1 ,'M' ,10 ,'B' ,'k' ,'password1')");
            mysqli_query($con, "INSERT INTO passenger (name, email, passportNo, mobileNo, gender, age, nationality, address, password) VALUES ('Passenger 2','passenger2@example.com', 11894 ,1 ,'M' ,10 ,'B' ,'k' ,'password2')");

            // Call the passengerList method
            $admin = new Admin();
            $passengers = $admin->passengerList($con);

            // Process the passenger list
            $passengerList = [];
            while ($row = mysqli_fetch_assoc($passengers)) {
                $passengerList[] = $row;
            }

            // Assert the passenger list content
            $this->assertCount(2, $passengerList);
            $this->assertEquals('passenger1@example.com', $passengerList[0]['email']);
            $this->assertEquals('passenger2@example.com', $passengerList[1]['email']);

            // Clean up: Remove the test data
            mysqli_query($con, "DELETE FROM passenger WHERE email='passenger1@example.com'");
            mysqli_query($con, "DELETE FROM passenger WHERE email='passenger2@example.com'");
        }
    }
?>