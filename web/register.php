<?php

require_once '../connection.php';
require_once '../src/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['user'];
        $username = htmlentities($username);

        $email = $_POST['email'];
        $email = htmlentities($email);

        $password = $_POST['password'];
        $password = htmlentities($password);

        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        $user->save($connection);

        header("Location: ../index.php");
    }
}

