<?php
    require_once("includes/includedFiles.php");

    if(isset($_GET["term"])) {
        $term = strip_tags(urldecode($_GET['term']));
    } else {
        $term = "";
    }
?>
<div class="searchContainer">
    <h4>Search for an artist, album or song</h4>
    <input type="text" class="searchInput" value="<?= $term; ?>" placeholder="Start typing...">
</div>

<script>
    $(".searchInput").focus();
    //put cursor at the end of text
    $(".searchInput")[0].setSelectionRange(1000, 1000);
    $(function() {

        $(".searchInput").keyup(function() {
            clearTimeout(timer);

            timer = setTimeout(function() {
                let val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 1000);
        })
    })
</script>

<?php
if($term == "") {
    exit();
}
?>

<div class="trackListContainer borderBottom">
    <h2>Songs</h2>
    <ul class="trackList">
        <?php
            $searchQuery = $con->prepare("SELECT id FROM musicify_songs WHERE title LIKE :term LIMIT 10");
            $searchQuery->bindValue(":term", $term.'%');
            $searchQuery->execute();

            if(!$searchQuery->rowCount()) {
                echo "<span class='noResults'>No songs found matching {$term}</span>";
            }

            $songIdArray = array();
            $i = 1;
            while($row = $searchQuery->fetch(PDO::FETCH_ASSOC)) {
                if($i > 15) {
                    break;
                }
                array_push($songIdArray, $row['id']);
                $albumSong = new Song($con, $row['id']);
                $albumArtist = $albumSong->getArtist();
                echo "
                    <li class='trackListRow'>
                        <div class='trackCount'>
                            <img src='assets/images/icons/play-white.png' class='play' alt='Play' onclick='setTrack(\"{$albumSong->getId()}\", tempPlaylist, true)'>
                            <span class='trackNumber'>{$i}</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>{$albumSong->getTitle()}</span>
                            <span class='artistName'>{$albumArtist ->getName()}</span>
                        </div>

                        <div class='trackOptions'>
                            <img src='assets/images/icons/more.png' class='optionsButton' alt='Options'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>{$albumSong->getDuration()}</span>
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

<div class="artistsContainer borderBottom">
    <h2>Artists</h2>

    <?php
        $artistsQuery = $con->prepare("SELECT id FROM musicify_artists WHERE name LIKE :term LIMIT 10");
        $artistsQuery->bindValue(":term", $term.'%');
        $artistsQuery->execute();

        if(!$artistsQuery->rowCount()) {
            echo "<span class='noResults'>No artists found matching {$term}</span>";
        }

        while($row = $artistsQuery->fetch(PDO::FETCH_ASSOC)) {
            $artistFound = new Artist($con, $row['id']);

            echo "
                <div class='searchResultRow'>
                    <div class='artistName'>
                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id={$artistFound->getId()}\")'>
                            {$artistFound->getName()}
                        </span>
                    </div>
                </div>
            ";
        }


    ?>
</div>

<div class="gridViewContainer">
    <h2>Albums</h2>
    <?php
        $albumQuery = $con->prepare("SELECT * FROM musicify_albums WHERE title LIKE :term");
        $albumQuery->bindValue(":term", $term.'%');
        $albumQuery->execute();

        if(!$albumQuery->rowCount()) {
            echo "<span class='noResults'>No albums found matching {$term}</span>";
        }

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