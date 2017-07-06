<?php
require_once '../connection.php';
require_once '../src/User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $user = User::loadUserByUsername($connection, $username);
        $_SESSION['userId'] = $user->getId();

        if (FALSE === $user) {
            echo '<p>Niepoprawny login lub hasło</p>';
            exit;
        }

        if ($password == $user->getPassword()) {
            $_SESSION['user'] = $user->getId();
            $_SESSION['userName'] = $user->getUsername();
            header('Location: ../index.php');
        } else {
            echo '<p>Niepoprawny login lub hasło</p>';
            exit;
        }
    }
}
