<?php require_once("includes/header.php");

if(isset($_GET['id'])) {
    $albumId = strip_tags($_GET['id']);
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?= $album->getArtworkPath() ?>" alt="Album artwork">
    </div>
    <div class="rightSection">
        <h2><?= $album->getTitle() ?></h2>
        <p>by <?= $artist->getName() ?></p>
        <p>Songs: <?= $album->getNumberOfSongs() ?></p>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $album->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId) {
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

<?php require_once("includes/footer.php"); ?>