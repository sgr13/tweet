<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/ShowLayout.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}

$name = $_SESSION['userName'];
$user = User::loadUserByUsername($connection, $name);
$oldName = $user->getUsername();
$password = $user->getPassword();
?>
<html>
<?php ShowLayout::showHeadInMain(); ?>
<body>
<?php ShowLayout::showSideBar(); ?>
<div id="container">
    <div id="mainUnlogged">
        <p>Zmień login i hasło:</p>
        <button id="dataChangeBtn">Zmień</button>
    </div>
    <div id="">
        <div id="dataChange">
            <form action="dataChange.php" method="post">
                <p>Zmień login:</p>
                <input type="text" name="name" value="<?php echo $oldName; ?>">

                <p>Podaj nowe hasło</p>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <input type="submit" value="Zmień">
                <input type="hidden" value="<?php echo $oldName; ?>" name="hiddenName">
            </form>
        </div>
    </div>
    <div id="mainUnlogged">
        <p>Pokaż wszystkie wiadomości:</p>
        <a href="showMessage.php">
            <button>Pokaż</button>
        </a>
    </div>
    <div id="mainUnlogged">
        <p>Pokaż wszystkie Tweety:</p>
        <a href="showAllTweetsById.php">
            <button>Pokaż</button>
        </a>
    </div>
    <div id="mainUnlogged">
        <p>Usuń swoje konto.</p>
        <button id="deleteBtn">Usuń</button>
    </div>
    <div>
        <div id="deleteUser">
            <p>Jesteś Pewny??</p>
            <a href="deleteUser.php">
                <button>Tak, usuń</button>
            </a>
        </div>
    </div>
</div>
</body>
</html>