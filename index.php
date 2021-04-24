<?php
    require_once("includes/config.php");
    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
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

</head>
<body>
    <h3>Hello <?=$userLoggedIn ?></h3>
    <a href="logout.php">Log out</a>
    <script src="assets/js/script.js"></script>
</body>
</html>