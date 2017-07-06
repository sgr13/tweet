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
<?php ShowLayout::showSideBar();

$result = Tweet::loadAllTweets($connection);
foreach ($result as $value) {
    $name = $value->getuserId();
    $id = $value->getId();
    ?>

    <div class="col-md-12" id="mainer">
        <div class="col-md-1">
        </div>
        <div class="col-md-8 paper" id="rest">
            <div class="col-md-12">
                <div class="col-md-6" id="date">
                    <?php echo $value->getcreationDate(); ?>
                </div>
                <div class="col-md-6" id="author">
                    <?php echo '<a href="showAllTweetsById.php?name=' . $name . '"><button>' . $value->getuserId() . '</button></a>'; ?>
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
                    <span><b>
                            <?php echo $value->getUserId(); ?></b><br>
                </span>
                    <span>
                    <?php echo $value->getComment(); ?><br>
                </span>
                    <span><b>
                            <?php echo $value->getCreationDate(); ?></b><br>
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
<?php } ?>
</body>
</html>
