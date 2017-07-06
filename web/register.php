<?php

require_once '../connection.php';
require_once '../src/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($connection, $_POST['user']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->save($connection);
        header("Location: ../index.php");
    }
}
