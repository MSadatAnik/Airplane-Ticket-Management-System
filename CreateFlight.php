<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Flight</title>
</head>
<body>
    <form action="CreateFlightProcess.php" method="post">
        <div>

            <label for="departure">Departure from </label>
            <input type="text" id =  "departure" name="departure" required>
            
        </div>

        <br>   

        <div>
            <label for="destination">Destination </label>
            <input type="text" id =  "destination" name="destination" required>
        </div>

        <br>

        <div>
            <label for="fDate">Date </label>
            <input type="date" id =  "fDate" name="fDate" min="<?php echo date('Y-m-d', strtotime('now')); ?>" required>
        </div>

        <br>

        <div>
            <label for="fTime">Time </label>
            <input type="time" id =  "fTime" name="fTime" required>
        </div>

        <br>

        <div>
            <label for="totalSeats">Total Seats </label>
            <input type="number" id =  "totalSeats" name="totalSeats" required>
        </div>

        <br>

        <div>
            <label for="economySeats">Economy Seats </label>
            <input type="number" id =  "economySeats" name="economySeats" required>
        </div>
        

        <br>


        <div>
            <label for="businessSeats">Business Seats </label>
            <input type="number" id =  "businessSeats" name="businessSeats" required>
        </div>
        

        <br>


        <div>
            <label for="firstClassSeats">First Class Seats </label>
            <input type="number" id =  "firstClassSeats" name="firstClassSeats" required>
        </div>


        <br>
        <div>

            <label for = "pilot">Pilot </label>
            <select id = "pilot" name ="pilot" required>
                <option value ="" disabled selected> Select a Pilot</option>
                <?php

                require_once("Connection.php");
                require_once("Staff.php");
                $staff = new staff();
                $pilots = $staff->getAllPilot($con);
               

                foreach($pilots as $pilot)
                {
                    echo "<option value='" . htmlspecialchars($pilot['id']) . "'>";
                    echo htmlspecialchars($pilot['name']);
                    echo "</option>";
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
            $staff = new staff();
            $airHostesses = $staff->getAllAirHostess($con);


            foreach($airHostesses as $airHostess)
            {
                echo "<option value='" . htmlspecialchars($airHostess['id']) . "'>";
                echo htmlspecialchars($airHostess['name']);
                echo "</option>";
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
            $staff = new staff();
            $airHostesses = $staff->getAllAirHostess($con);


            foreach($airHostesses as $airHostess)
            {
                echo "<option value='" . htmlspecialchars($airHostess['id']) . "'>";
                echo htmlspecialchars($airHostess['name']);
                echo "</option>";
            }
        
            ?>
        </select>
        
        </div>


        

        <br>
        

        <br>

        <div>
            <input type="submit">
            <input type="reset">
        </div>
        



    </form>
</body>
</html>
