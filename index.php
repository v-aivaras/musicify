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
    <!-- <h3>Hello <?=$userLoggedIn ?></h3>
    <a href="logout.php">Log out</a> -->


    <div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            
            <div id="nowPlayingLeft">

            </div>

            <div id="nowPlayingCenter">
                
                <div class="content playerControls">

                    <div class="buttons">

                        <button class="controlButton shuffle" title="Shuffle">
                            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                        </button>

                        <button class="controlButton previous" title="Previous">
                            <img src="assets/images/icons/previous.png" alt="Previous">
                        </button>

                        <button class="controlButton play" title="Play">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </button>

                        <button class="controlButton pause" title="Pause" style="display:none">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </button>

                        <button class="controlButton next" title="Next">
                            <img src="assets/images/icons/next.png" alt="Next">
                        </button>

                        <button class="controlButton repeat" title="Repeat">
                            <img src="assets/images/icons/repeat.png" alt="Repeat">
                        </button>

                    </div>

                </div>

            </div>

            <div id="nowPlayingRight">
                
            </div>

        </div>
    </div>







    <script src="assets/js/script.js"></script>
</body>
</html>