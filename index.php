<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
//require_once 'src/message.php';

session_start();

if (isset($_SESSION['user']) && isset($_SESSION['userName'])) {
    header('Location: loggedUser.php');
} else {
?>
<html>
<head lang="pl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale = 1">

    <title>Manuela Drozd-Sypień</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css?h=1" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/style.js"></script>
</head>
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