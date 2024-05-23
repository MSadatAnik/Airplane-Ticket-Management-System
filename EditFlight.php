<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
</head>
<body>

    <?php

    require_once("Connection.php");
    require_once("Flight.php");
    session_start();

    //stroing id for edit flight
    $flight = new flight();
    if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];
    }

    $resultObj = $flight->searchFlightByID($con,$id); //getting all infromation for editing flight
    $result = $resultObj->fetch_assoc();  

    $localDeparture = $result['departure'];
    $localDestination = $result['destination'];
    $localFDate = $result['fDate'];
    $localFTime = $result['fTime'];
    $localTotalSeats = $result['totalSeats'];
    $localEconomySeats = $result['economySeats'];
    $localBusinessSeats = $result['businessSeats'];
    $localFirstClassSeats = $result['firstClassSeats'];
    $localPilotId = $result['pilot'];
    $localAirHostess1Id = $result['airHostess1'];
    $localAirHostess2Id = $result['airHostess2'];

    ?>




    <form action="EditFlightProcess.php" method="post">

        <!--Hidden input field for id so that it can send id to next page EditFlightProcess.php -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> 

        <div>

            <label for="departure">Departure from </label>
            <input type="text" id =  "departure" name="departure" value="<?php echo htmlspecialchars($localDeparture)?>" required>
            
        </div>

        <br>   

        <div>
            <label for="destination">Destination </label>
            <input type="text" id =  "destination" name="destination" value="<?php echo htmlspecialchars($localDestination)?>" required>
        </div>

        <br>

        <div>
            <label for="fDate">Date </label>
            <input type="date" id =  "fDate" name="fDate" min="<?php echo date('Y-m-d', strtotime('now')); ?>" value="<?php echo htmlspecialchars($localFDate)?>" required>
        </div>

        <br>

        <div>
            <label for="fTime">Time </label>
            <input type="time" id =  "fTime" name="fTime" value="<?php echo htmlspecialchars($localFTime)?>" required>
        </div>

        <br>

        <div>
            <label for="totalSeats">Total Seats </label>
            <input type="number" id =  "totalSeats" name="totalSeats" value="<?php echo htmlspecialchars($localTotalSeats)?>"required>
        </div>

        <br>

        <div>
            <label for="economySeats">Economy Seats </label>
            <input type="number" id =  "economySeats" name="economySeats" value="<?php echo htmlspecialchars($localEconomySeats)?>"required>
        </div>
        

        <br>


        <div>
            <label for="businessSeats">Business Seats </label>
            <input type="number" id =  "businessSeats" name="businessSeats" value="<?php echo htmlspecialchars($localBusinessSeats)?>" required>
        </div>
        

        <br>


        <div>
            <label for="firstClassSeats">First Class Seats </label>
            <input type="number" id =  "firstClassSeats" name="firstClassSeats" value="<?php echo htmlspecialchars($localFirstClassSeats)?>"required>
        </div>


        <br>
        <div>

            <label for = "pilot">Pilot </label>
            <select id = "pilot" name ="pilot" required>
                <option value ="" disabled selected> Select a Pilot</option>
                
                <?php
                     
                     require_once("Connection.php");
                     require_once("Staff.php");



                     if ($localPilotId) { // Check if $pilotId is set
                       $staff = new Staff($con);
                       $pilots = $staff->getAllPilot($con);

                       if ($pilots) { // Check if pilots were retrieved successfully
                         foreach ($pilots as $pilot) {
                           $selected = ($pilot['id'] == $localPilotId) ? 'selected' : ''; // Set 'selected' attribute for matching ID

                           echo "<option value='" . htmlspecialchars($pilot['id']) . "' $selected>";
                           echo htmlspecialchars($pilot['name']);
                           echo "</option>";
                         }
                       }
                    } 
                 ?>
            </select>

        </div>

        <br> 

        <div>

        <label for = "airHostess1">Air Hostess 1 </label>
        <select id = "airHostess1" name ="airHostess1" required>
            <option value ="" disabled selected> Select Air Hostess 1</option>
            <?php
                     
                     require_once("Connection.php");
                     require_once("Staff.php");



                     if ($localAirHostess1Id) { // Check if $pilotId is set
                       $staff = new Staff($con);
                       $airHostesses = $staff->getAllAirHostess($con);

                       if ($airHostesses) { // Check if pilots were retrieved successfully
                         foreach ($airHostesses as $airHostess) {
                           $selected = ($airHostess['id'] == $localAirHostess1Id) ? 'selected' : ''; // Set 'selected' attribute for matching ID

                           echo "<option value='" . htmlspecialchars($airHostess['id']) . "' $selected>";
                           echo htmlspecialchars($airHostess['name']);
                           echo "</option>";
                         }
                       }
                    } 
                 ?>
        </select>
        
        </div>

        <br>

        <div>

        <label for = "airHostess2">Air Hostess 2 </label>
        <select id = "airHostess2" name ="airHostess2" required>
            <option value ="" disabled selected> Select Air Hostess 2</option>
            <?php
                    
                     require_once("Connection.php");
                     require_once("Staff.php");



                     if ($localAirHostess2Id) { // Check if $pilotId is set
                       $staff = new Staff($con);
                       $airHostesses = $staff->getAllAirHostess($con);

                       if ($airHostesses) { // Check if pilots were retrieved successfully
                         foreach ($airHostesses as $airHostess) {
                           $selected = ($airHostess['id'] == $localAirHostess2Id) ? 'selected' : ''; // Set 'selected' attribute for matching ID

                           echo "<option value='" . htmlspecialchars($airHostess['id']) . "' $selected>";
                           echo htmlspecialchars($airHostess['name']);
                           echo "</option>";
                         }
                       }
                    } 
                 ?>
        </select>
        
        </div>


        

        <br>
        

        <br>

        <div>
            <input type="submit" value="Save Changes">

            <button type="button" onclick="goBack()">Cancel</button>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>

        </div>
        

    </form>


</body>
</html>


