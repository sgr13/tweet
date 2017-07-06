<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['text'])) {
        $text = mysqli_real_escape_string($connection, $_POST['text']);
        $date = date("d.m.y H:i:s");
        $tweet = new Tweet();
        $userId = $_SESSION['userId'];

        $tweet->setText($text);
        $tweet->setUserId($userId);
        $tweet->setCreationDate($date);
        $tweet->saveToDB($connection);
        $connection->close();
        header('Location: loggedUser.php');
    }
}
