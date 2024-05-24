<?php

    require_once ('AdminClass.php');

    session_start();

    $admin = new Admin();
    $admin -> adminLogout($_SESSION['admin']);

?>