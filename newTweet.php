<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
//require_once 'src/message.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}
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
    <div>
        <form action="tweetCreation.php" method="post">
            <p>Formularz nowego tweeta:</p>
            <p>Treść tweeta</p>
            <textarea name="text"></textarea><br>
            <input type="submit" value="Wyślij">
        </form>
    </div>
</body>
</html>