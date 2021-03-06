<?php
    require_once("../../config.php");

    if(!isset($_POST['username'])) {
        echo "ERROR: Could not set username";
        exit();
    }

    if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
        echo "Not all passwords have been set";
        exit();
    }

    if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == ""  || $_POST['newPassword2'] == "") {
        echo "Please fill in all fields";
        exit();
    }

    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword1 = $_POST['newPassword1'];
    $newPassword2 = $_POST['newPassword2'];

    $oldPw = hash("sha512", $oldPassword);

    $passwordCheck = $con->prepare("SELECT * FROM musicify_users WHERE username=:username AND password=:password");
    $passwordCheck->bindParam(":username", $username);
    $passwordCheck->bindParam(":password", $oldPw);
    $passwordCheck->execute();

    if($passwordCheck->rowCount() != 1) {
        echo "Password is incorrect";
        exit();
    }

    if($newPassword1 != $newPassword2) {
        echo "Your new passwords do not match";
        exit();
    }

    if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
        echo "Your password must only contain letters and/or numbers";
        exit();
    }

    if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
        echo "Your username must be between 5 and 30 characters";
        exit();
    }

    $newPw = hash("sha512", $newPassword1);

    $query = $con->prepare("UPDATE musicify_users SET password=:password WHERE username=:username");
    $query->bindParam(":password", $newPw);
    $query->bindParam(":username", $username);
    $query->execute();
    echo "Update successful";
?>