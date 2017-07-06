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

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['name'])) {
        $user = User::loadUserByUsername($connection, $_GET['name']);
        $id = $user->getId();
        $result = Tweet::loadAllTweetsByUserId($connection, $id);
    }
}
if (!isset($_GET['name'])) {
    $result = Tweet::loadAllTweetsByUserId($connection, $_SESSION['user']);
}
foreach ($result as $value) {
    $id = $value->getId();
    ?>
    <div class="col-md-12" id="mainer">
        <div class="col-md-1">
        </div>
        <div class="col-md-8" id="rest">
            <div class="col-md-12">
                <div class="col-md-6" id="date">
                    <?php echo $value->getcreationDate(); ?>
                </div>
                <div class="col-md-6" id="author">
                    <?php echo $value->getuserId(); ?>
                </div>
            </div>
            <div class="col-md-12" id="text">
                <?php echo $value->gettext(); ?>
            </div>
            <div class="col-md-12 down">
                <div class="col-md-6" id="mail">
                    Napisz wiadomość:
                </div>
                <div class="col-md-6 commentButtonDiv">
                    Komentarze:
                    <button class="commentButton" style="font-size: 90%; height: 30px">Pokaż</button>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-3 commentMain">
            <div class="col-md-12" id="commentHeader">
                Komentarze:
            </div>
            <?php
            $result2 = Comment::loadAllCommentsByPostId($connection, $id);
            ?>
            <div class="col-md-12" id="commentText">
                <?php
                foreach ($result2 as $value) {
                    ?>
                    <span>
                        <?php echo $value->getUserId(); ?><br>
                    </span>
                    <span>
                        <?php echo $value->getComment(); ?><br>
                    </span>
                    <span>
                        <?php echo $value->getCreationDate(); ?><br>
                    </span>
                    <hr>
                <?php } ?>
            </div>
            <div class="col-md-12" id="commentAdd">
                <a href="addComment.php?id=<?php echo $id; ?>">
                    <button>Dodaj</button>
                </a>
            </div>
        </div>
    </div>
<?php
}
$connection->close();
?>
</body>
</html>
