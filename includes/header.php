<?php
    require_once("includes/config.php");
    require_once("includes/classes/Artist.php");
    require_once("includes/classes/Album.php");
    require_once("includes/classes/Song.php");

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        echo "<script>
                let userLoggedIn;
                userLoggedIn = '$userLoggedIn';
            </script>";
    } else {
        header("Location:register.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicify</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico" type="image/x-icon">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/audio.js"></script>

</head>
<body>
    <!-- <h3>Hello <?=$userLoggedIn ?></h3>
    <a href="logout.php">Log out</a> -->

    <!-- Main top content -->
    <div id="main">
        <div id="topContainer">

            <!-- Left nav -->
            <?php require_once("includes/navBarContainer.php");  ?>

            <!-- Main content -->
            <div id="mainViewContainer">
                <div id="mainContent">