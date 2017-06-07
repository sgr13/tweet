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
            <form action="#" method="post">
                <p>Zmień login:</p>
                <input type="text" name="name" value="<?php echo $oldName; ?>">
                <p>Podaj nowe hasło</p>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <input type="submit" value="Zmień">
                <input type="hidden" value="<?php echo $oldName; ?>" name="hiddenName">
            </form>
        </div>
    </div>
</body>

<?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['name']) || isset($_SERVER['password'])) {

            $oldName = ($_POST['hiddenName']);
            $user = User::loadUserByUsername($connection, $oldName);

            $user->setUsername($_POST['name']);
            $user->setPassword($_POST['password']);
            $user->save($connection);
        }
    }
?>
</html>