<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/ShowLayout.php';

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['userName'])) {
    header('Location: index.php');
}
?>
<html>
<?php ShowLayout::showHeadInMain(); ?>
<body>
<?php
ShowLayout::showSideBar();

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
                <?php foreach ($result as $value) { ?>
                    <?php
                    if ($value['id'] == $_SESSION['user']) {
                        continue;
                    }
                    ?>
                    <option value="<?php echo $value['id']; ?>">
                        <?php echo $value['username']; ?>
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
