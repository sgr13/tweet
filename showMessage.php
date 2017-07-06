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
<div id="messageDiv">
    <h3>Wiadomości wysłane:</h3>
    <?php
    $userId = $_SESSION['user'];
    $userId = intval($userId);
    $sql = "SELECT * FROM user u LEFT JOIN message m ON m.receiver_id=u.id WHERE m.sender_id=$userId ORDER BY creationDate DESC";
    $result = $connection->query($sql);

    if (!$result) {
        die ("Bład zapisu do bazy danych" . $connection->error);
    }
    ?>
    <table>
        <tr>
            <th>Data</th>
            <th>Adresat</th>
            <th>Przeczytaj</th>
        </tr>
        <?php
        $i = 1;
        foreach ($result as $value) {
            $id = $value['id'];
            ?>
            <tr>
                <td> <?php echo $value['creationDate'] ?></td>
                <td> <?php echo $value['username'] ?></td>
                <td><a href='readMessage.php?id=<?php echo $id; ?>'>Pokaż</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<div id="messageDiv">
    <h3>Wiadomości odebrane:</h3>
    <?php
    $userId = $_SESSION['user'];
    $userId = intval($userId);
    $sql = "SELECT * FROM user u LEFT JOIN message m ON m.sender_id=u.id WHERE m.receiver_id=$userId ORDER BY creationDate DESC";
    $result = $connection->query($sql);

    if (!$result) {
        die ("Bład zapisu do bazy danych" . $connection->error);
    }
    ?>
    <table>
        <tr>
            <th>Data</th>
            <th>Autor</th>
            <th>Przeczytaj</th>
            <th>Status</th>
        </tr>
        <?php
        $i = 1;
        foreach ($result as $value) {
            $id = $value['id'];
            ?>
            <tr>
                <td><?php echo $value['creationDate'] ?></td>
                <td><?php echo $value['username'] ?></td>
                <td><a href='readMessage.php?id=<?php echo $id;?>'>Pokaż</a></td>
                <?php
                if ($value['status'] == 0) {
                    echo "<td>" . "<b> <span style = 'color: red'>Nieprzeczytane</span></b>" . "</td>";
                } else {
                    echo "<td>" . "<span style='color:green'>Przeczytane</span>" . "</td>";
                }

                $sql = "UPDATE message SET status=1 WHERE id=$id";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Błąd zapisu do bazy danych" . $connection->error);
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    $connection->close();
    ?>
</div>
</body>
</html>
