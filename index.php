<?php require_once("includes/header.php"); ?>

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
                    <a href='album.php?id=$albumId'>
                        <img src='$artworkImg'>
                        <div class='gridViewInfo'>
                            $albumTitle
                        </div>
                    </a>
                </div>";
        }

    ?>

</div>
<?php require_once("includes/footer.php"); ?>