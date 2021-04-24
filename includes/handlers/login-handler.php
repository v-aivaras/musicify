<?php
if(isset($_POST['loginButton'])) {
    $username = strip_tags($_POST['loginUsername']);
    $password = strip_tags($_POST['loginPassword']);

    $result = $account->login($username, $password);

    if($result) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
?>