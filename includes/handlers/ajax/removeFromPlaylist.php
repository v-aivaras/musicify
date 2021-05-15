<?php
    require_once("../../config.php");
    if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
        $playlistQuery = $con->prepare("DELETE FROM musicify_playlistSongs WHERE playlistId=:playlistId AND songId=:songId");
        $playlistQuery->bindValue(":playlistId", $_POST['playlistId']);
        $playlistQuery->bindValue(":songId", $_POST['songId']);
        $playlistQuery->execute();

    } else {
        echo "PlaylistId or songId was not passed into file";
    }
?>