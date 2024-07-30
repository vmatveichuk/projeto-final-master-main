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
$activity = "administracao editar professor";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");

$instituicao = visualizar_instituicao_id('1');
//motor php
$gravar = false;


if (@$_POST['acao5'] == "atualizarTurma") {
    if ($_POST['i'] == 0) {
        atualizar_turmaid1($_POST['prof-id'], $_POST['turma']);
    } else if ($_POST['i'] == 1) {
        atualizar_turmaid2($_POST['prof-id'], $_POST['turma']);
    } elseif ($_POST['i'] == 2) {
        atualizar_turmaid3($_POST['prof-id'], $_POST['turma']);
    } else if ($_POST['i'] == 3) {
        atualizar_turmaid4($_POST['prof-id'], $_POST['turma']);
    }
}

if (@$_POST['acao1'] == "editarDisciplina" && @$_POST['disciplina'] != null) {
    if ($_POST['i'] == 0) {
        atualizar_disci1($_POST['prof-id'], $_POST['disciplina']);
    } else if ($_POST['i'] == 1) {
        atualizar_disci2($_POST['prof-id'], $_POST['disciplina']);
    } else if ($_POST['i'] == 2) {
        atualizar_disci3($_POST['prof-id'], $_POST['disciplina']);
    } else if ($_POST['i'] == 3) {
        atualizar_disci4($_POST['prof-id'], $_POST['disciplina']);
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editar professor</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('professores'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">
                    <h4>Editar periodo e disciplina</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class=" col-lg-5 col-xl-7">
                                <?php
                                if (@$_POST['tag'] == 2) {
                                ?>
                                    <hr>
                                    <div class="col">
                                        <form class="form" action="" method="post">
                                            <div class="form-group">
                                                <select class="form-control" name="periodo">
                                                    <?php
                                                    if ($_POST['turma'] != 0) {
                                                        $periodo = periodo_num($_POST['turma']);
                                                        $periodos = lista_periodos($periodo['periodo']['curso']);
                                                        $i5 = 0;
                                                        while ($i5 < sizeof($periodos['periodos'])) {
                                                    ?>
                                                            <option value="<?= $periodos['periodos'][$i5]['Periodo'] ?>"><?= $periodos['periodos'][$i5]['Periodo'] ?></option>
                                                    <?php $i5++;
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6 pb-4">
                                            <button class="btn btn-sm btn-primary btn-block" type="submit">Selecionar</button>
                                        </div>
                                        <input type="hidden" id="tag" name="tag" value="<?= 1 ?>">
                                        <input type="hidden" id="tag" name="i" value="<?= $_POST['i'] ?>">
                                        <input type="hidden" id="tag" name="prof-id" value="<?= $_POST['prof-id'] ?>">
                                        <input type="hidden" id="tag" name="turma" value="<?= $_POST['turma'] ?>">
                                        </form>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/professores'">Cancelar</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                if (@$_POST['tag'] == 1) {


                                ?>
                                    <form class="form" action="" method="post">
                                        <div class="form-group">
                                            <select class="form-control" name="disciplina">
                                                <?php
                                                    $curso = periodo_num($_POST['turma']);

                                                    $disciplinas = lista_de_disciplinas_periodo($_POST['periodo'], $curso['periodo']['curso']);

                                                    $i5 = 0;
                                                    while ($i5 < sizeof($disciplinas['disci'])) {
                                                        $nome = busca_nome_disciplina($disciplinas['disci'][$i5]);
                                                ?>
                                                        <option value="<?= $disciplinas['disci'][$i5] ?>"><?= $nome['nome'] ?></option>
                                                <?php $i5++;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="tag" name="prof-id" value="<?= $_POST['prof-id'] ?>">
                                        <input type="hidden" id="acao1" name="acao1" value="editarDisciplina">
                                        <input type="hidden" id="tag" name="i" value="<?= $_POST['i'] ?>">
                                        <input type="hidden" id="tag" name="turma" value="<?= $_POST['turma'] ?>">
                                        <input type="hidden" id="tag" name="periodo" value="<?= $_POST['periodo'] ?>">
                                        <input type="hidden" id="tag" name="tag" value="<?= 5 ?>">
                                        <br>
                                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                            <div class="col-md-6 pb-4">
                                                <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                            </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/professores'">Cancelar</button>
                                    </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (@$_POST['tag'] == 5) {
                            if (@$_POST['disciplina'] != null) {
                                $turma = visualizar_turma_id($_POST['turma']);
                                $disciplina = busca_nome_disciplina($_POST['disciplina']);
                        ?>
                                <form class="form" action="/administracao/professores-editar" method="post">
                                    <input type="hidden" id="tag" name="id" value="<?= $_POST['prof-id'] ?>">

                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Turma: </b></label> <?= $turma['nome'] ?>
                                    </div>
                                    <div class="form-group pt-1 pb-2">
                                        <label for="id"><b>Periodo: </b></label> <?= $_POST['periodo'] ?>
                                    </div>
                                    <div class="form-group pt-1 pb-2">
                                        <label for="id"><b>Disciplina: </b></label> <?= $disciplina['nome'] ?>
                                    </div>
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success btn-block btn-sm">Ver lista</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } else {
                                echo '<label for="nome"><b>Nenhuma disciplina identificada </b></label>';
                            ?>
                                <form class="form" action="/administracao/professores-editar" method="post">
                                    <input type="hidden" id="tag" name="id" value="<?= $_POST['prof-id'] ?>">
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success btn-block btn-sm">Ver lista</button>
                                        </div>
                                    </div>
                                </form>
                        <?php }
                        } ?>
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