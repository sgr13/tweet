<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
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
<?php showSideBar::SideBar(); ?>
<div id="container">
    <div id="mainUnlogged">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $id = htmlentities($id);

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