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
            <input type="date" id =  "fDate" name="fDate" required>
        </div>

        <br>

        <div>
            <label for="fTime">Time </label>
            <input type="time" id =  "fTime" name="fTime" required>
        </div>

        <br>

        <div>
            <label for="seats">Seats </label>
            <input type="number" id =  "seats" name="seats" required>
        </div>

        <br>

        <div>
            <input type="submit">
            <input type="reset">
        </div>
        



    </form>
</body>
</html>
