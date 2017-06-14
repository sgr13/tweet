<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $id = htmlentities($id);

        $date = date("d.m.y H:i:s");
        $userId = $_SESSION['user'];

        $comment = new Comment();
        $comment->setTweetId($id);
        $comment->setComment($_POST['comment']);
        $comment->setCreationDate($date);
        $comment->setUserId($userId);

        $comment->saveToDB($connection);

        header('Location: loggedUser.php');
    }
}


?>