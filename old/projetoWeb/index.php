<?php
    require 'autoload.php';
    if (!empty($_POST)) {
        $login = new Usuario();
        $login->setEmail($_POST['email-login']);
        $login->setSenha($_POST['senha-login']);
        $login->realizarLogin();
    }
?>
<html>
    <head>
        <title>Login - Email</title>
        <meta charset='utf-8'>
        <!-- CSS -->
        <link rel="stylesheet" href="css/index.css"/>
    </head>
    <body id="body-login">

        <div id="body-form">
            <img src="imagem/perfil.png">
            <form id="form-login-block" enctype="multipart/form-data" method="POST">
                <div class="form-group-block">
                    <input id="email-usuario" class="form-control" name="email-login" type="text" placeholder="Digite seu e-mail"/>
                </div>
                <div class="form-group-block">
                    <input id="email-cadeado" class="form-control" name="senha-login" type="password" placeholder="Digite sua senha"/>
                </div>
                <button type="submit">Login</button>
            </form>
            <div id="conteudo-login">
                <a class="btn btn-red" href="paginas/registrar.php">Crie seu email</a>
            </div>
        </div>
        
    </body>
</html>