<?php
    require_once("../../config.php");
    if(isset($_POST['playlistId']) && isset($_POST['songId'])) {

        $orderIdQuery = $con->prepare("SELECT MAX(playlistOrder) + 1 as playlistOrder FROM musicify_playlistSongs WHERE playlistId=:id");
        $orderIdQuery->bindParam(":id", $_POST['playlistId']);
        $orderIdQuery->execute();
        $row = $orderIdQuery->fetch(PDO::FETCH_ASSOC);
        $order = $row['playlistOrder'];
        if($order == null) {
            $order = 1;
        }

        $query = $con->prepare("INSERT INTO musicify_playlistSongs VALUES ('', :songId, :playlistId, :order)");
        $query->bindParam(":songId", $_POST['songId']);
        $query->bindParam(":playlistId", $_POST['playlistId']);
        $query->bindParam(":order", $order);
        $query->execute();

    } else {
        echo "PlaylistId or songId was not passed into file";
    }
?>