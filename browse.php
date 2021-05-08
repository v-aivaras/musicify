<?php
    require_once("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">You Might also like</h1>

<div class="gridViewContainer">

    <?php
        $albumQuery = $con->prepare("SELECT * FROM musicify_albums ORDER BY RAND() LIMIT 10");
        $albumQuery->execute();

        while($row = $albumQuery->fetch(PDO::FETCH_ASSOC)) {
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