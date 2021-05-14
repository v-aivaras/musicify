<?php
    require_once("../../config.php");
    if(isset($_POST['playlistId'])) {
        $playlistQuery = $con->prepare("DELETE FROM musicify_playlists WHERE id=:id");
        $playlistQuery->bindValue(":id", $_POST['playlistId']);
        $playlistQuery->execute();

        $query = $con->prepare("DELETE FROM musicify_playlistSongs WHERE playlistId=:id");
        $query->bindValue(":id", $_POST['playlistId']);
        $query->execute();
    } else {
        echo "PlaylistId was not passed into file";
    }
?>