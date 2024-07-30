<?php
session_start();
if (!@$_SESSION['id']) {
    header('Location: /');
}
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/message-box.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/topbar.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/sidebar.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
$activity = "administracao-administrador";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();

if (@$_POST['acao1'] == "editar-adm") {
    editarAdministrador($_POST['admin-id'], $_POST['nome'],$_POST['email'],$_POST['cpf']);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Administrador</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('administradores'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">
                    Editar administrador
                </div>
                <hr>
                <div id='conteudo-pagina' Class="">
                    <div class="pl-4 mr-3">
                    <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                    <div class="col-md-4 col-lg-4 col-xl-3">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/administradores'"><-</button>
                    <?php SistemMessage(); ?>
                    <form class="form" action="" method="post">
                        <input type="hidden" id="acao1" name="acao" value="editar-usuario">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" size='12' id="nome" name="nome" value="<?= $_POST["nome"] ?>">
                        </div>
                        <input type="hidden" id="admin-id" name="admin-id" value="<?= $_POST['admin-id']?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $_POST["email"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input id="cpf" type="text" size="14" name="cpf" maxlength="14" value="<?= $_POST['cpf'] ?>" OnKeyPress="formatar('###.###.###-##', this)" class="form-control">
                        </div>
                        <button class="btn btn-sm btn-primary" type="submit">Salvar alterações</button>
                    </form>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/sx/bootstrap/4.4.1/js/jquery-3.4.1.slim.min.js"></script>
    <!-- <script src="/sx/bootstrap/4.4.1/js/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/sx/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>