<?php
require_once '../connection.php';
require_once '../src/User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        echo "username:<br>";
        var_dump($username);
        $password = $_POST['password'];
        echo "password:<br>";
        var_dump($password);
        $user = User::loadUserByUsername($connection, $username);
        var_dump($user);
        $_SESSION['userId'] = $user->getId();
        var_dump($user->getPassword());

        if (FALSE === $user) {
            echo '<p>Incorrect !username!</p>';
            exit;
        }

        if ($password == $user->getPassword()){
            $_SESSION['user'] = $user->getId();
            $_SESSION['userName'] = $user->getUsername();
            header('Location: ../index.php');
        } else {
            echo '<p>Incorrect !password</p>';
            exit;
        }
    }
}