<?php require_once("includes/header.php");

if(isset($_GET['id'])) {
    $albumId = strip_tags($_GET['id']);
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?= $album->getArtworkPath() ?>" alt="Album artwork">
    </div>
    <div class="rightSection">
        <h2><?= $album->getTitle() ?></h2>
        <p>by <?= $artist->getName() ?></p>
        <p>Songs: <?= $album->getNumberOfSongs() ?></p>
    </div>
</div>



<?php require_once("includes/footer.php"); ?>