<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['text']) && isset($_POST['receiverSelection'])) {
        $text = mysqli_real_escape_string($connection, $_POST['text']);
        $receiverId = intval($_POST['receiverSelection']);
        $senderId = $_SESSION['user'];
        $date = $date = date("d.m.y H:i:s");

        $message = new Message();
        $message->setText($text);
        $message->setReceiverId($receiverId);
        $message->setSenderId($senderId);
        $message->setStatus(0);
        $message->setCreationDate($date);
        $message->saveToDb($connection);

        header('Location: loggedUser.php');
    }
}
