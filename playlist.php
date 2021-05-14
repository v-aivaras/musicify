<?php require_once("includes/includedFiles.php");

if(isset($_GET['id'])) {
    $playlistId = strip_tags($_GET['id']);
} else {
    header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="entityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png">
        </div>
    </div>
    <div class="rightSection">
        <h2><?= $playlist->getName() ?></h2>
        <p>by <?= $playlist->getOwner() ?></p>
        <p>Songs: <?= $playlist->getNumberOfSongs() ?></p>
        <button class="button" onclick="deletePlaylist('<?= $playlistId ?>')">Delete playlist</button>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $playlist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId) {
                $playlistSong = new Song($con, $songId);
                $playlistArtist = $playlistSong->getArtist();
                echo "
                    <li class='trackListRow'>
                        <div class='trackCount'>
                            <img src='assets/images/icons/play-white.png' class='play' alt='Play' onclick='setTrack(\"{$playlistSong->getId()}\", tempPlaylist, true)'>
                            <span class='trackNumber'>{$i}</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>{$playlistSong->getTitle()}</span>
                            <span class='artistName'>{$playlistArtist->getName()}</span>
                        </div>

                        <div class='trackOptions'>
                            <img src='assets/images/icons/more.png' class='optionsButton' alt='Options'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>{$playlistSong->getDuration()}</span>
                        </div>
                    </li>
                ";
                $i++;
            }
        ?>
        <script>
            tempSongIds = '<?= json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>