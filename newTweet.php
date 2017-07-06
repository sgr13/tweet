<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/ShowLayout.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}
?>
<html>
<?php ShowLayout::showHeadInMain(); ?>
<body>
<?php ShowLayout::showSideBar(); ?>
<div id="container">
    <div id="mainUnlogged">
        <form action="tweetCreation.php" method="post">
            <p>Formularz nowego tweeta:</p>
            <p>Treść tweeta</p>
            <textarea name="text"></textarea><br>
            <input type="submit" value="Wyślij">
        </form>
    </div>
</div>
</body>
</html>
