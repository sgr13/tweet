<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/showSideBar.php';


session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}
?>
<html>
<head lang="pl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale = 1">

    <title>Tweeterek</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css?h=1" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/style.js"></script>
</head>
<body>
<?php
showSideBar::SideBar();
$sql = "SELECT * FROM user";
$result = $connection->query($sql);

if (!$result) {
    die("Błąd odczytu z bazy danych" . $connection->connect_errno);
}
?>
<div id="container">
    <div id="mainUnlogged">
        <p>Wybierz adresata:</p>

        <form method="post" action="sendMessage.php">
            <select name="receiverSelection">
                <?php foreach($result as $value) { ?>
                    <?php
                    if ($value['id'] == $_SESSION['user']) {
                        continue;
                    }
                    ?>
                <option value="<?php echo $value['id'];?>">
                    <?php  echo $value['username'];?>
                </option>
                <?php } ?>
            </select><br><br>
            <p>Wpisz swoją wiadomość:</p>
            <textarea rows="6" cols="20" name="text"></textarea>
            <input type="submit" value="Wyślij">
        </form>
    </div>
</div>
</body>
</html>