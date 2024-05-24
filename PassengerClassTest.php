<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

require_once 'src/PassengerClass.php';

// Assuming this file establishes the database connection

class PassengerClassTest extends TestCase {

    public function testPassengerLoginSuccess() {
        // Establish the database connection
        require_once 'src/Connection.php';

        // Prepare the database with a valid passenger record
        mysqli_query($con, "INSERT INTO passenger (name, email, passportNo, mobileNo, gender, age, nationality, address, password) VALUES ('PassengerName', 'passenger@example.com', '1986', '1', 'm', '1', 'b', '1', 'password')");

        // Create a Guzzle client
        $client = new Client();

        // Send a POST request to simulate passenger login
        $response = $client->request('POST', 'http://localhost/airport/src/PassengerClass.php', [
            'form_params' => [
                'email' => 'passenger@example.com',
                'password' => 'password',
            ]
        ]);

        // Assert that the response has a redirection header to Welcome.php
        $this->assertEquals(302, $response->getStatusCode());
        $locationHeader = $response->getHeaderLine('Location');
        $this->assertEquals('Welcome.php', basename(parse_url($locationHeader, PHP_URL_PATH)));

        // Clean up: Remove the test data
        mysqli_query($con, "DELETE FROM passenger WHERE email='passenger@example.com'");
    }

    public function testPassengerLoginFail() {
        // Establish the database connection
        require_once 'src/Connection.php';

        // Prepare the database with a valid passenger record
        mysqli_query($con, "INSERT INTO passenger (name, email, passportNo, mobileNo, gender, age, nationality, address, password) VALUES ('Passenger Name', 'passenger@example.com', '1986', '1', 'm', '1', 'b', '1', 'password')");

        // Create a Guzzle client
        $client = new Client();

        // Send a POST request to simulate passenger login with invalid credentials
        $response = $client->request('POST', 'http://localhost/airport/src/PassengerClass.php', [
            'form_params' => [
                'email' => 'invalid@example.com', // Provide invalid email
                'password' => 'invalidpassword', // Provide invalid password
            ],
            // Capture the redirect response
            'allow_redirects' => false,
        ]);

        // Assert that the response has a status code indicating redirection
        $this->assertEquals(302, $response->getStatusCode());

        // Check if redirection URL matches expected
        $locationHeader = $response->getHeaderLine('Location');
        $this->assertStringContainsString('login.php?Invalid', $locationHeader);

        // Clean up: Remove the test data
        mysqli_query($con, "DELETE FROM passenger WHERE email='passenger@example.com'");
    }

}
?>