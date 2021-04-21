<?php
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicify</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="inputContainer">
        <form action="register.php" id="loginForm" method="POST">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. JohnSmith" required>
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="*******" required>
            </p>
            <button type="submit" name="loginButton">LOG IN</button>
        </form>




        <form action="register.php" id="registerForm" method="POST">
            <h2>Create your free account</h2>
            <p>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="e.g. JohnSmith" required>
            </p>
            <p>
                <label for="firstName">First name</label>
                <input type="text" id="firstName" name="firstName" placeholder="e.g. John" required>
            </p>
            <p>
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="lastName" placeholder="e.g. Smith" required>
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="e.g. JohnSmith@gmail.com" required>
            </p>
            <p>
                <label for="email2">Confirm email</label>
                <input type="email" id="email2" name="email2" placeholder="e.g. JohnSmith@gmail.com" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="*******" required>
            </p>
            <p>
                <label for="password2">Confirm password</label>
                <input type="password" id="password2" name="password2" placeholder="*******" required>
            </p>
            <button type="submit" name="registerButton">SIGN UP</button>
        </form>



    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>