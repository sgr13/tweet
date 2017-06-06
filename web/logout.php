<?php
require_once '../connection.php';
require_once '../src/User.php';

session_start();
unset($_SESSION['user']);
unset($_SESSION['userName']);
unset($_SESSION);

header("Location: ../index.php");