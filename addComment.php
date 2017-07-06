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
?>
<html>
<?php ShowLayout::showHeadInMain(); ?>
<body>
<?php ShowLayout::showSideBar(); ?>
<div id="container">
    <div id="header">
        <p><i><b>TWITEREK</b></i></p>
    </div>
    <div id="mainUnlogged">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $id = intval($id);
                ?>
                <form action="commentCreation.php" method="post">
                    <p>Wpisz swój komentarz(max. il. znaków : 60)</p>
                    <textarea name="comment" maxlength="60"></textarea>
                    <input type="submit" value="Wyślij">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                </form>
            <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>