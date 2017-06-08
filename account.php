<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';


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
<head lang="pl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale = 1">

    <title>Twitterek</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css?h=1" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/style.js"></script>
</head>
<body>
    <div id="container">
        <div id="mainUnlogged">
            <p>Zmień login i hasło:</p><button id="dataChangeBtn">Zmień</button>
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
            <a href="showMessage"><button>Pokaż</button></a>
        </div>
    </div>
</body>
</html>