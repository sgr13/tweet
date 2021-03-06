<?php

class ShowLayout
{
    static public function showSideBar()
    {
        echo '
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
        </div>';
    }

    public static function showHeadInMain()
    {
        echo '
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
        ';
    }
}
