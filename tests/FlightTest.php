<?php

use PHPUnit\Framework\TestCase;
use APP\Flight;


class FlightTest extends TestCase
{
    

    

    public function testCreateFlightSuccess()
    {
        
        //creating mock database
        $con = $this->createMock(mysqli::class);
        $con->expects($this->once())
            ->method('query')
            ->withAnyParameters()  // Simulate any query being executed
            ->willReturn(true);     // Simulate successful query execution

        // Define test data
        $adminName = "admin";
        $departure = "NYC";
        $destination = "LAX";
        $fTime = "10:00:00";
        $fDate = "2024-06-01";
        $availableSeats = 100;
        $economySeats = 50;
        $businessSeats = 30;
        $firstClassSeats = 20;
        $pilot = "1";
        $airHostess1 = "2";
        $airHostess2 = "3";



        // Call the function with test data and injected connection
        $flight = new flight;

        $result = $flight->createFlight($adminName, $departure, $destination, $fTime, $fDate, $availableSeats, $economySeats, $businessSeats, $firstClassSeats, $pilot, $airHostess1, $airHostess2, $con);
        $this->assertEquals("Flight created successfully!",$result);//checking expected and actual output
    }



    public function testCreateFlightFailure()
    {
        //creating mock database
        $con = $this->createMock(mysqli::class);
        $con->expects($this->once())
            ->method('query')
            ->withAnyParameters() // Simulate any query being executed
            ->willReturn(false); // Simulate failed query execution

        // Define test data
        $adminName = "admin";
        $departure = "NYC";
        $destination = "LAX";
        $fTime = "10:00:00";
        $fDate = "2024-06-01";
        $availableSeats = 100;
        $economySeats = 50;
        $businessSeats = 30;
        $firstClassSeats = 20;
        $pilot = "1";
        $airHostess1 = "2";
        $airHostess2 = "3";

        // Call the function with test data and injected connection
        $flight = new Flight; // Flight class instance
        $result = $flight->createFlight($adminName, $departure, $destination, $fTime, $fDate, $availableSeats, $economySeats, $businessSeats, $firstClassSeats, $pilot, $airHostess1, $airHostess2, $con);


        $this->assertEquals("Error: <br>",$result); //checking output


    }

    




    public function testCancelFlightSuccess()
    {
        // Mock the database connection
        $conMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['query', 'error'])
            ->getMock();

        // Define the ID of the flight to be canceled
        $flightId = 123;

        // Set up expectations for the query method
        $conMock->expects($this->once())
            ->method('query')
            ->with("DELETE FROM flight WHERE id = $flightId")
            ->willReturn(true);

        // Create an instance of the Flight class
        $flight = new Flight();

        // Capture the output of the function
        ob_start();
        $flight->cancelFlight($flightId, $conMock);
        $output = ob_get_clean();

        // Assert that the function output is as expected
        $this->assertEquals('Flight deleted successfully!', $output);
    }


    public function testCancelFlightFailure()
    {
        // Mock the database connection
        $conMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['query'])
            ->getMock();

        // Define the ID of the flight to be canceled
        $flightId = 123;

        // Set up expectations for the query method
        $conMock->expects($this->once())
            ->method('query')
            ->with("DELETE FROM flight WHERE id = $flightId")
            ->willReturn(false);



        // Create an instance of the Flight class
        $flight = new Flight();

        // Capture the output of the function
        ob_start();
        $flight->cancelFlight($flightId, $conMock);
        $output = ob_get_clean();

        // Assert that the function output is as expected
        $this->assertEquals("Flight deletion failed!!", $output);
    }



    public function testEditFlightSuccess()
{
  // Creating mock database
  $con = $this->createMock(mysqli::class);
  $con->expects($this->once())
      ->method('query')
      ->withAnyParameters() // Simulate any query being executed (optional)
      ->willReturn(true); // Simulate successful query execution

  // Define test data
  $id = 1;
  $adminName = "updatedAdmin";
  $departure = "DXB";
  $destination = "LHR";
  $fTime = "15:00:00";
  $fDate = "2024-07-01";
  $availableSeats = 200;
  $economySeats = 100;
  $businessSeats = 50;
  $firstClassSeats = 50;
  $pilot = "3";
  $airHostess1 = "4";
  $airHostess2 = "5";

  // Call the function with test data and injected connection
  $flight = new Flight(); 
  $result = $flight->editFlight($id, $adminName, $departure, $destination, $fTime, $fDate, $availableSeats, $economySeats, $businessSeats, $firstClassSeats, $pilot, $airHostess1, $airHostess2, $con);

  // AChecking with expected output
  $this->expectOutputString('Flight edited successfully!');


}


public function testEditFlightError()
{
  // Configure the mock connection to simulate a failed query
   $con = $this->createMock(mysqli::class);
  $con->expects($this->once())
      ->method('query')
      ->withAnyParameters() // Simulate any query being executed (optional)
      ->willReturn(false); // Simulate failed query execution

  // Define test data 
  $id = 1;
  $adminName = "updatedAdmin";
  $departure = "DXB";
  $destination = "LHR";
  $fTime = "15:00:00";
  $fDate = "2024-07-01";
  $availableSeats = 200;
  $economySeats = 100;
  $businessSeats = 50;
  $firstClassSeats = 50;
  $pilot = "3";
  $airHostess1 = "4";
  $airHostess2 = "5";

  // Call the function with test data and injected connection
  $flight = new Flight();
   $result = $flight->editFlight($id, $adminName, $departure, $destination, $fTime, $fDate, $availableSeats, $economySeats, $businessSeats, $firstClassSeats, $pilot, $airHostess1, $airHostess2, $con);

  // Checking output if edit failed or not
  $this->expectOutputString("Failed to edit!");

 
}



/*public function testAvailableFlightSuccess()
    {
        // Mock the mysqli connection object
        $mysqliMock = $this->getMockBuilder(mysqli::class)
            ->setMethods(['query'])
            ->getMock();

        // Mock the mysqli_result object
        $mysqliResultMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['num_rows', 'fetch_assoc'])
            ->getMock();

        // Define the expected behavior for num_rows and fetch_assoc
        $mysqliResultMock->expects($this->once())
            ->method('num_rows')
            ->willReturn(1);

        $mysqliResultMock->expects($this->exactly(2))
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['id' => 1, 'adminName' => 'admin', 'departure' => 'NYC', 'destination' => 'LAX', 'fDate' => '2024-06-01', 'fTime' => '10:00:00'],
                [] // No more rows
            );

        // Define the expected behavior for the query method
        $mysqliMock->expects($this->once())
            ->method('query')
            ->with($this->equalTo("SELECT * FROM flight"))
            ->willReturn($mysqliMock);

        // Create an instance of the Flight class and call the availableFlight method
        $flight = new Flight();
        $result = $flight->availableFlight($mysqliMock);

        // Define the expected result
        $expectedResult = [
            ['id' => 1, 'adminName' => 'admin', 'departure' => 'NYC', 'destination' => 'LAX', 'fDate' => '2024-06-01', 'fTime' => '10:00:00']
        ];

        // Assert that the result is as expected
        $this->assertEquals($expectedResult, $result);
    }*/ //NOT WORKING!!
    


    
}
