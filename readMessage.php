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
    <div id="mainUnlogged">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $id = intval($id);
                $sql = "SELECT * FROM message WHERE id=$id";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Błąd odczytu z bazy danych" . $connection->error);
                }

                foreach ($result as $value) {
                    echo "<p>" . $value['text'] . "</p>";
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>