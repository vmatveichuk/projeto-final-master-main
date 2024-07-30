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
$activity = "professores avaliacoes";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
$instituicao = visualizar_instituicao_id('1');

if (@$_POST['acao1'] == "editar") {
    editar_avaliacao($_POST['descricao'], $_POST['data'], $_POST['id-avali']);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Avaliações</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_professores('turmas'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div class="col-md-6">
                        <form class="form" action="/professores/avaliacoes" method="post">
                            <input type="hidden" id="acao13" name="idTurma" value="<?= $_POST['idTurma'] ?>">
                            <input type="hidden" id="acao13" name="disciId" value="<?= $_POST['disciId'] ?>">
                            <input type="hidden" id="acao13" name="disciNome" value="<?= $_POST['disciNome'] ?>">
                            <input type="hidden" id="acao13" name="nome" value="<?= $_POST['nome'] ?>">
                            <button type="submit" class="btn btn-secondary btn-sm">
                                <-< /button>
                        </form>
                    </div>

                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class="col-md-4 col-lg-4 col-xl-3">
                                <hr>
                                <?php
                                // 0 - tag
                                $turma = visualizar_turma_id(@$_POST['id']);
                                ?>
                                <form class="form" action="" method="post">
                                    <input type="hidden" id="tag" name="tag" value="1">
                                    <input type="hidden" id="id" name="id" value="<?= @$turma['id'] ?>">
                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Descricao</b></label>
                                        <input id="nome" type="text" name="descricao" value="<?= $_POST['descricao'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Data</b></label>
                                        <input id="nome" type="text" name="data" value="<?= $_POST['data'] ?>" class="form-control">
                                    </div>
                                    <input type="hidden" id="acao1" name="id-avali" value="<?= $_POST['id-avali'] ?>">
                                    <input type="hidden" id="acao1" name="acao1" value="editar">
                                    <input type="hidden" id="acao13" name="idTurma" value="<?= $_POST['idTurma'] ?>">
                                    <input type="hidden" id="acao13" name="disciId" value="<?= $_POST['disciId'] ?>">
                                    <input type="hidden" id="acao13" name="disciNome" value="<?= $_POST['disciNome'] ?>">
                                    <input type="hidden" id="acao13" name="nome" value="<?= $_POST['nome'] ?>">
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6 pb-4">
                                            <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                        </div>
                                </form>
                                <div class="col-md-6">
                                    <form class="form" action="/professores/avaliacoes" method="post">
                                        <input type="hidden" id="acao13" name="idTurma" value="<?= $_POST['idTurma'] ?>">
                                        <input type="hidden" id="acao13" name="disciId" value="<?= $_POST['disciId'] ?>">
                                        <input type="hidden" id="acao13" name="disciNome" value="<?= $_POST['disciNome'] ?>">
                                        <input type="hidden" id="acao13" name="nome" value="<?= $_POST['nome'] ?>">
                                        <button type="submit" class="btn btn-secondary btn-block btn-sm">Cancelar</button>
                                    </form>
                                </div>
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