<?php
    require_once("includes/config.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/Constants.php");

    $account = new Account($con);

    require_once("includes/handlers/register-handler.php");
    require_once("includes/handlers/login-handler.php");

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicify</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</head>

<body class="register">

    <?php
        if(isset($_POST['registerButton'])) {
            echo '
                <script>
                    $(document).ready(function() {
                        $("#loginForm").hide();
                        $("#registerForm").show();
                    }); 
                </script>'; 
        } else {
            echo '
                <script>
                    $(document).ready(function() {
                        $("#loginForm").show();
                        $("#registerForm").hide();
                    }); 
                </script>'; 

        }

    ?>

    <div id="loginContainer">

        <div id="inputContainer">

            <form action="register.php" id="loginForm" method="POST">
                <h2>Login to your account</h2>
                <p>
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <label for="loginUsername">Username</label>
                    <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. JohnSmith"  value="<?=getInputValue('loginUsername') ?>" required>
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="loginPassword" placeholder="*******" required>
                </p>
                <button type="submit" name="loginButton">Log in</button>

                <div class="hasAccountText">
                    <span id="hideLogin">Don't have an account yet? Signup here.</span>
                </div>

            </form>




            <form action="register.php" id="registerForm" method="POST">
                <h2>Create your free account</h2>
                <p>
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="e.g. JohnSmith" value="<?=getInputValue('username') ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="firstName">First name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="e.g. John" value="<?=getInputValue('firstName') ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName">Last name</label>
                    <input type="text" id="lastName" name="lastName" placeholder="e.g. Smith" value="<?=getInputValue('lastName') ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="e.g. JohnSmith@gmail.com" value="<?=getInputValue('email') ?>" required>
                </p>
                <p>
                    <label for="email2">Confirm email</label>
                    <input type="email" id="email2" name="email2" placeholder="e.g. JohnSmith@gmail.com" value="<?=getInputValue('email2') ?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="*******" required>
                </p>
                <p>
                    <label for="password2">Confirm password</label>
                    <input type="password" id="password2" name="password2" placeholder="*******" required>
                </p>
                <button type="submit" name="registerButton">Sign up</button>

                <div class="hasAccountText">
                    <span id="hideRegister">Already have an account? Login here.</span>
                </div>
            </form>

        </div>

        <div id="loginText">
            <h1>Get great music, right now!</h1>
            <h2>Listen to loads of songs for free</h2>
            <ul>
                <li>Discover music you'll fall in love with</li>
                <li>Create your palylists</li>
                <li>Follow artists to keep up to date</li>
            </ul>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>