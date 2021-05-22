<?php 
    require_once("includes/includedFiles.php");
?>

<div class="entityInfo">
    <div class="centerSection">
        <div class="userInfo">
            <h1><?= $userLoggedIn->getName() ?></h1>
        </div>
    </div>
    <div class="buttonItems">
        <button class="button" onclick="openPage('updateDetails.php')">User Details</button>
        <button class="button" onclick="logout()">Logout</button>
    </div>
</div>