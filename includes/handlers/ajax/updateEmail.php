<?php
    require_once("../../config.php");

    if(!isset($_POST['username'])) {
        echo "ERROR: Could not set username";
        exit();
    }

    if(isset($_POST['email']) && $_POST['email'] != "") {

        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email is invalid";
            exit();
        }

        $emailCheck = $con->prepare("SELECT email FROM musicify_users WHERE email=:email AND username != :username");
        $emailCheck->bindParam(":email", $email);
        $emailCheck->bindParam(":username", $username);
        $emailCheck->execute();

        if($emailCheck->rowCount()) {
            echo "Email is already in use";
            exit();
        }

        $query = $con->prepare("UPDATE musicify_users SET email=:email WHERE username=:username");
        $query->bindParam(":email", $email);
        $query->bindParam(":username", $username);
        $query->execute();
        echo "Update successful";
    }
    else {
        echo "You must provide an email";
    }

?>