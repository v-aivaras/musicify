<?php
    $songQuery = $con->prepare("SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $songQuery->execute();

    $resultArray = array();
    while($row = $songQuery->fetch(PDO::FETCH_ASSOC)) {
        array_push($resultArray, $row['id']);
        echo $row['id'];
    }

    $jsonArray = json_encode($resultArray);
?>

<script>
    $(document).ready(function() {
        currentPlaylist = <?= $jsonArray ?>;
        console.log(currentPlaylist);
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {
        audioElement.setTrack("assets/music/bensound-anewbeginning.mp3");
        if(play) {
            audioElement.play();
        }
    }

    function playSong() {
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

</script>
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        
        <!-- Bottom player left part -->
        <div id="nowPlayingLeft">
            <div class="content">

                <span class="albumLink">
                    <!-- TO DO replace image -->
                    <img src="#" alt="" class="albumArtwork">

                </span>

                <div class="trackInfo">
                    <span class="trackName">
                        <span>track</span>
                    </span>
                    <span class="artistName">
                        <span>artist</span>
                    </span>
                </div>

            </div>
        </div>
        <!-- Bottom player center part -->
        <div id="nowPlayingCenter">
            
            <div class="content playerControls">

                <div class="buttons">

                    <button class="controlButton shuffle" title="Shuffle">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>

                    <button class="controlButton play" title="Play" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause" style="display:none" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>

                    <button class="controlButton next" title="Next">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>

                    <button class="controlButton repeat" title="Repeat">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>

                </div>

                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress">

                            </div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                </div>

            </div>

        </div>
            <!-- Bottom player right part -->
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume" alt="Volume">
                    <img src="assets/images/icons/volume.png" alt="">
                </button>

                <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress">

                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>