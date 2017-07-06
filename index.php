<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/ShowLayout.php';

session_start();

if (isset($_SESSION['user']) && isset($_SESSION['userName'])) {
    header('Location: loggedUser.php');
} else {
?>
<html>
<?php ShowLayout::showHeadInMain(); ?>
<body>
<div id="container">
    <div id="header">
        <p><i><b>TWITEREK</b></i></p>
    </div>
    <div id="mainUnlogged">
        Zaloguj się aby korzystać z naszego serwisu.<br>
        <a href="web/loginForm.html">
            <button>Zaloguj</button>
        </a>
        <hr>
        <p>Jeżeli nie masz u nas konta zarejestruj się!</p>
        <a href="web/registerForm.html">
            <button>Zarejestruj</button>
        </a>
    </div>
</div>
</body>
</html>
<?php
};
?>