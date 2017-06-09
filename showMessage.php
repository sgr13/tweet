<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';


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

    <title>Twitterek</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css?h=1" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/style.js"></script>
</head>
<body>
<div id="messageDiv">
<h3>Wiadomości wysłane:</h3>
<?php
$userId = $_SESSION['user'];
$sql = "SELECT * FROM user u LEFT JOIN message m ON m.receiver_id=u.id WHERE m.sender_id=$userId";
$result = $connection->query($sql);

if (!$result) {
    die ("Bład zapisu do bazy danych" . $connection->error);
}

echo "<table>";
    echo "<tr>";
        echo "<th>Nr</th><th>Adresat</th><th>Przeczytaj</th>";
    echo "</tr>";
    $i = 1;
    foreach ($result as $value) {
    $id = $value['id'];
    echo "<tr>";
        $id = $value['id'];
        echo "<td>" . $i . "</td><td>" . $value['username'] . "</td>";
        echo "<td><a href='readMessage.php?id=$id'>Pokaż</a></td>";
        $i++;
    }

    echo "</table>";
?>
</div>

<div id="messageDiv">
    <h3>Wiadomości odebrane:</h3>
    <?php
    $userId = $_SESSION['user'];
    $sql = "SELECT * FROM user u LEFT JOIN message m ON m.sender_id=u.id WHERE m.receiver_id=$userId";
    $result = $connection->query($sql);

    if (!$result) {
        die ("Bład zapisu do bazy danych" . $connection->error);
    }

    echo "<table>";
    echo "<tr>";
    echo "<th>Nr</th><th>Autor</th><th>Przeczytaj</th><th>Status</th>";
    echo "</tr>";
    $i = 1;
    foreach ($result as $value) {
        $id = $value['id'];
        echo "<tr>";
        $id = $value['id'];
        echo "<td>" . $i . "</td><td>" . $value['username'] . "</td>";
        echo "<td><a href='readMessage.php?id=$id'>Pokaż</a></td>";
        if ($value['status'] == 0) {
            echo "<td>" . "<b> <span style = 'color: red'>Nieprzeczytane</span></b>" . "</td>";
        } else {
            echo "<td>" . "<span style='color:green'>Przeczytane</span>" . "</td>";
        }
        $i++;

        $sql = "UPDATE message SET status=1 WHERE id=$id";
        $result = $connection->query($sql);

        if (!$result) {
            die("Błąd zapisu do bazy danych" . $connection->error);
        }
    }
    echo "</table>";
    ?>
</div>
</body>
</html>