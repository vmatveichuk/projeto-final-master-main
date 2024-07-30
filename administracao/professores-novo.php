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
$activity = "administracao-novo professor";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-usuarios.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;

if (@$_POST['acao1']=='novo_professor') {
    $aluno=busca_usuario_id($_POST['nome']);
    // var_dump($usuario);
    $resp = novo_professor($aluno['id']);
    if ($resp['resposta'] == true) {
        $message = 'Professor cadastrado com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        $_POST['tag'] = 5;
    } else {
        $message = 'Ocorreu um erro no cadastro do professor.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        $_POST['tag'] = 2;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Novo professor</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    }
</script>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('professores'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/professores'"><-</button>
                <div class="pt-5 pl-4">
                    <h4>Novo registro de professor</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class="col-md-4 col-lg-4 col-xl-3">
                                <hr>
                                <form class="form" action="" method="post">
                                    <input type="hidden" id="tag" name="tag" value="3">
                                    <div class="form-group pt-2">
                                        <label for="nome"><b>Nome</b></label>
                                        <input id="cpf" type="text" size= "14" name="nome" maxlength="14"  class="form-control">

                                    </div>
                                    <input type="hidden"  id="nome" name="acao1" value="novo_professor">
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6 pb-4">
                                            <button class="btn btn-sm btn-primary btn-block" type="submit">+ Adicionar</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/professores'">Cancelar</button>
                                        </div>
                                    </div>
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