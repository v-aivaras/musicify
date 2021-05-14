<?php
    require_once("../../config.php");
    if(isset($_POST['name']) && isset($_POST['username'])) {
        $query = $con->prepare("INSERT INTO musicify_playlists VALUES ('', :name, :username, :date)");
        $query->bindValue(":name", $_POST['name']);
        $query->bindValue(":username", $_POST['username']);
        $query->bindValue(":date", date("Y-m-d"));
        $query->execute();
    } else {
        echo "Name or username parameters not passed into file";
    }
?>