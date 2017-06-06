<?php
require_once '../connection.php';
require_once '../src/User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "chuj";
    if (isset($_POST['username']) && isset($_POST['password'])) {
        var_dump($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = User::loadUserByUsername($connection, $username);

        if (FALSE === $user) {
            echo '<p>Incorrect !username! or password</p>';
            exit;
        }

        if ($password == $user->getPassword()){
            $_SESSION['user'] = $user->getId();
            $_SESSION['userName'] = $user->getUsername();
            header('Location: ../index.php');
        } else {
            echo '<p>Incorrect username or !password</p>';
            exit;
        }
    }
}