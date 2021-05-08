<?php
    require_once("includes/includedFiles.php");

    if(isset($_GET['id'])) {
        $artistId = strip_tags($_GET['id']);
    } else {
        header("Location: index.php");
    }

    $artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?= $artist->getName() ?></h1>

            <div class="headerButtons">
                <button class="button green" onclick="playFirstSong()">Play</button>
            </div>
        </div>
    </div>
</div>

<div class="trackListContainer borderBottom">
    <h2>Songs</h2>
    <ul class="trackList">
        <?php
            $songIdArray = $artist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId) {
                if($i > 5) {
                    break;
                }
                $albumSong = new Song($con, $songId);
                $albumArtist = $albumSong->getArtist();
                echo "
                    <li class='trackListRow'>
                        <div class='trackCount'>
                            <img src='assets/images/icons/play-white.png' class='play' alt='Play' onclick='setTrack(\"{$albumSong->getId()}\", tempPlaylist, true)'>
                            <span class='trackNumber'>{$i}</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>{$albumSong->getTitle()}</span>
                            <span class='artistName'>{$albumArtist ->getName()}</span>
                        </div>

                        <div class='trackOptions'>
                            <img src='assets/images/icons/more.png' class='optionsButton' alt='Options'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>{$albumSong->getDuration()}</span>
                        </div>
                    </li>
                ";
                $i++;
            }
        ?>
        <script>
            let tempSongIds = '<?= json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<div class="gridViewContainer">
    <h2>Albums</h2>
    <?php
        $artistQuery = $con->prepare("SELECT * FROM musicify_albums WHERE artist=:artist_id");
        $artistQuery->bindParam(":artist_id", $artistId);
        $artistQuery->execute();

        while($row = $artistQuery->fetch(PDO::FETCH_ASSOC)) {
            $albumId = $row['id'];
            $albumTitle = $row['title'];
            $artworkImg = $row['artworkPath'];
            
            echo "
                <div class='gridViewItem' alt='Artwork image'>
                    <span role='link' tabindex='0' onclick='openPage(\"album.php?id=$albumId\")'>
                        <img src='$artworkImg'>
                        <div class='gridViewInfo'>
                            $albumTitle
                        </div>
                    </span>
                </div>";
        }

    ?>
</div>