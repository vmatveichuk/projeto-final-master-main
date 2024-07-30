<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/message-box.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/visitor-topbar.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/visitor-footer.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/language-selector.php");
$text = languageSelector("404-lang.php");
$activity = "erro404";
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
preInitializeLogVariables($activity);
insertLog();
posInitializeLogVariables();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.3.1/css/bootstrap.min.css">
    <title><?php echo $text['title']; ?></title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/login.css">
</head>
<body>
    <?php VisitorTopbar(); ?>
    <main role="main">
        <section id="cabecalho" class="jumbotron">
            <?php SistemMessage(); ?>
            <article class="container">
                <h1 class="display-4"><?php echo $text['text1']; ?></h1>
                <p class="lead">
                    <?php echo $text['text2']; ?>
                </p>
                <hr class="my-4">
                <p><?php echo $text['text3']; ?></p>
                <button class="btn btn-primary" onclick="window.location.href='/'"><?php echo $text['button1']; ?></button>
            </article>
        </section>
        <section id="conteudo" class="container">
        </section>
    </main>
    <script src="/sx/bootstrap/4.3.1/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/sx/bootstrap/4.3.1/js/popper.min.js"></script>
    <script src="/sx/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>