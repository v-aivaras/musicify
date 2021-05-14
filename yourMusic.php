<?php
    require_once("includes/includedFiles.php");
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>Playlists</h2>
        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()">New Playlist</button>
        </div>

        <?php
            $playlistQuery = $con->prepare("SELECT * FROM musicify_playlists WHERE owner=:owner");
            $playlistQuery->bindValue(":owner", $userLoggedIn->getUsername());
            $playlistQuery->execute();

            if(!$playlistQuery->rowCount()) {
                echo "<span class='noResults'>You don't have any playlists yet.</span>";
            }

            while($row = $playlistQuery->fetch(PDO::FETCH_ASSOC)) {
                $playlist = new Playlist($con, $row);
                
                echo "
                    <div class='gridViewItem' alt='Artwork image' role='link' tabindex='0' 
                        onclick='openPage(\"playlist.php?id={$playlist->getId()}\")'>
                        <div class='playlistImage'>
                            <img src='assets/images/icons/playlist.png'>
                        </div>
                        <div class='gridViewInfo'>
                            {$playlist->getName()}
                        </div>
                    </div>";
            }

        ?>


    </div>
</div>