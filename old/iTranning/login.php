<?php
require 'main.php';

if (!empty($_SESSION['user']['nome'])) {
    session_destroy();
}

if (!empty($_POST)) {
    $usuario = addslashes($_POST['loginUsuario']);
    $senha = addslashes($_POST['loginSenha']);

    $login = new Login();
    $login->setUsuario($usuario);
    $login->setSenha($senha);
    $login->criptografarSenha();
    if ($login->verificarLogin()) {
        header('Location: index.php');
    } else {
        $erroLogin = true;
    }
}

?>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/css/login.css" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>iTranning<br> Login </h2>
            <p>Faça o Login</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <?php
                if ($erroLogin == true) {
                    echo '<div class="alert alert-danger" role="alert">Usuário e/ou senha inválidos</div>';
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Usuário</label>
                        <input type="text" class="form-control" placeholder="Usuario" name="loginUsuario">
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control" placeholder="Senha" name="loginSenha">
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>