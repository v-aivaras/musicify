<?php
    include("../../config.php");
    require_once("../../config.php");
    if(isset($_POST['songId'])) {
        $query = $con->prepare("UPDATE musicify_songs SET plays = plays + 1 WHERE id=:id");
        $query->bindParam(":id", $_POST['songId']);
        $query->execute();
    }
?>