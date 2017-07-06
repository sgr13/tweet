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
    if (isset($_POST['name']) || isset($_SERVER['password'])) {
        $oldName = mysqli_real_escape_string($connection, $_POST['hiddenName']);
        $user = User::loadUserByUsername($connection, $oldName);
        $user->setUsername($_POST['name']);
        $user->setPassword($_POST['password']);
        $user->save($connection);
        header('Location: account.php');
    }
}
