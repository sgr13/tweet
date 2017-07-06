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

$userName = $_SESSION['userName'];
$user = User::loadUserByUsername($connection, $userName);
$user->delete($connection);
header("Location: web/logout.php");