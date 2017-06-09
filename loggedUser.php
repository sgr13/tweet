<!DOCTYPE HTML>
<?php
require_once 'connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';


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
<div id="cos">
    <div id="hey">
        <nav class="navbar navbar-inverse sidebar" role="navigation" id="wtf">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-expand"></span>TWITTEREK</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="loggedUser.php">Start<span style="font-size:16px;"
                                                                               class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a>
                        </li>
                        <li><a href="newTweet.php">Nowy Tweet<span style="font-size:16px;"
                                                            class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span></a>
                        </li>
                        <li><a href="sendMessageForm.php">Wyślij wiadomość<span style="font-size:16px;"
                                                                  class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a>
                        </li>
                        <li><a href="account.php">Moje konto<span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                        </li>
                        </li>
                        <li><a href="web/logout.php">Wyloguj<span style="font-size:16px;"
                                                                  class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<?php
$result = Tweet::loadAllTweets($connection);
foreach($result as $value) {
    $name=$value->getuserId();
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
                <?php echo '<a href="showAllTweetsById.php?name=' . $name . '"><button>' . $value->getuserId() . '</button></a>' ; ?>
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
               Komentarze: <button class="commentButton" style="font-size: 90%; height: 30px">Pokaż</button><br>
            </div>
        </div>
    </div>
    <div class="col-md-3 commentMain" >
        <div class="col-md-12" id="commentHeader">
            Komentarze:
        </div>
        <?php

        $result2 = Comment::loadAllCommentsByPostId($connection, $id);
        ?>
        <div class="col-md-12" id="commentText">
        <?php
        foreach($result2 as $value) {
        ?>

            <span>
                <?php echo $value->getUserId();?><br>
            </span>
            <span>
                <?php echo $value->getComment();?><br>
            </span>
            <span>
                <?php echo $value->getCreationDate();?><br>
            </span>
            <hr>
        <?php }?>
        </div>
        <div class="col-md-12" id="commentAdd">
            <a href="addComment.php?id=<?php echo $id;?>"><button>Dodaj</button></a>
        </div>

    </div>

</div>
<?php } ?>
</body>
</html>
