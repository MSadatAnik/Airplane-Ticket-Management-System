<?php
$con=mysqli_connect('localhost', 'root', '', 'airplaneticket');
if(!$con) {
    die('check your connection'.mysqli_connect_error());
}
?>