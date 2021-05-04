<?php
    ob_start();
    session_start();

    $timezone = date_default_timezone_set("EUrope/London");

    date_default_timezone_set("Europe/London");

    try {
        $con = new PDO("mysql:dbname=musicify; host=localhost;", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>