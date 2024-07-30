<?php
    session_start();
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/message-box.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/visitor-topbar.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/visitor-footer.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
    $activity = "acesso";
    $usuario = "visitante";
    preInitializeLogVariables($activity, $usuario);
    insertLog();
    posInitializeLogVariables();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Acesso</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/login.css">
</head>
<body>
    <main role="main" class="container text-center">
        <form class="form-login" action="/sx/logar.php" method="post">
            <div class="text-center m-6 shadow-sm p-3 bg-white rounded">
                <a class="mb-3 font-weight-normal ">Acesso</small></a>
                <br/><br/>
                <br/>
                <a class="h1 font-weight-normal" sytle="margin-bottom: 0.0rem!important; color: #4e5257"></a>
                <br/>
                <a class= mt-2 >
                    <?php SistemMessage();?>
                </a>
                <input id="logar" type="hidden" name="acao" value="logar">
                <label for="inputEmail" class="sr-only">Email</label>
                <input id="email" type="mail"  name="email"  class="form-control" placeholder="Email" required autofocus>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                <br/>
                <br/>
                <button type="button" class="btn btn-link" onclick="window.location.href='/recuperar-senha'">Esqueci minha senha</button>
                <br/><br/>
            </div>
        </form>
    </main> 
    <br/><br/><br/><br/>
    <script src="/sx/bootstrap/4.4.1/js/jquery-3.4.1.slim.min.js"></script>
    <!-- <script src="/sx/bootstrap/4.4.1/js/popper.min.js  -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/sx/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>