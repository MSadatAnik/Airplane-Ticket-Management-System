<?php
session_start();
if (isset($_SESSION['passenger'])) {

    require_once('Connection.php');
    require_once("PassengerClass.php");
    $email = $_GET['email'];
    $query = "SELECT * FROM passenger WHERE email='$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $passportNo = $_POST['passportNo'];
        $mobileNo = $_POST['mobileNo'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $nationality = $_POST['nationality'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $passenger = new Passenger();
        $passenger->updatePassenger($email, $name, $passportNo, $mobileNo, $gender, $age, $nationality, $address, $password, $con);

        header("Location: login.php?email=" . $email);
        exit();
    }

    echo '<form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="' . $row['name'] . '" required/><br/>
        <label for="passportNo">Passport Number:</label>
        <input type="text" id="passportNo" name="passportNo" value="' . $row['passportNo'] . '" required/><br/>
        <label for="mobileNo">Mobile Number:</label>
        <input type="text" id="mobileNo" name="mobileNo" value="' . $row['mobileNo'] . '" required/><br/>
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="' . $row['gender'] . '" required/><br/>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="' . $row['age'] . '" required/><br/>
        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" value="' . $row['nationality'] . '" required/><br/>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="' . $row['address'] . '" required/><br/>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required/><br/>
        <input type="submit" value="Update Info"/>
    </form>';

} else {
    header("location:login.php");
}
?>