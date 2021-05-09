<?php
    require_once("../../config.php");
    if(isset($_POST['songId'])) {
        $query = $con->prepare("SELECT s.*, art.*, art.id as artid, alb.id as albid, alb.artworkPath 
                                FROM musicify_songs as s 
                                JOIN musicify_artists as art 
                                JOIN musicify_albums as alb 
                                WHERE s.artist=art.id 
                                AND s.album=alb.id 
                                AND s.id=:id");
        $query->bindParam(":id", $_POST['songId']);
        $query->execute();

        $resultArray = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($resultArray);
    }
    

?>