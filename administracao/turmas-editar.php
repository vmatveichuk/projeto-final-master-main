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
$activity = "administracao neditar turma";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;


if (@$_POST['acao1']=='editarNome') {
    if (editarTurmaNome($_POST['id'],$_POST['nome'])) {
        $message = 'Turma atualizada com sucesso.';
        $message_type = 'success';
        //managerMessage($message, $message_type);
    } else {
        $message = 'Ocorreu um erro na atualização da turma.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
    }
}
if (@$_POST['acao1']=='editar_turma') {
    $respo=editarPeriodo($_POST['id'],$_POST['periodo'],$_POST['cursos']);
    if ($respo['resposta']==true) {
        $message = 'Turma atualizada com sucesso.';
        $message_type = 'success';
        //managerMessage($message, $message_type);
    } else {
        $message = 'Ocorreu um erro na atualização da turma.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editar turma</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('turmas'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">
                    <h4>Editar turma</h4>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/turmas'">Voltar</button>

                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">

                            <div class="col-md-4 col-lg-4 col-xl-3">
                                <hr>
                                <?php
                                // 0 - tag
                                $turma = visualizar_turma_id(@$_POST['id']);
                                if (!@$_POST['tag']) { ?>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="tag" name="tag" value="1">
                                        <input type="hidden" id="tag" name="acao1" value="editarNome">
                                        <input type="hidden" id="id" name="id" value="<?= @$turma['id'] ?>">
                                        <div class="form-group pt-4">
                                            <label for="nome"><b>Nome</b></label>
                                            <input id="nome" type="text" name="nome" class="form-control" value="<?= @$turma['nome'] ?>">
                                        </div>
                                        <?php  $cursoNome = pegar_curso_por_turma($_POST['cursos']); ?>
                                        <div class="form-group pt-4">
                                            <label for="nome"><b>Curso</b></label><br>
                                            <?php if ($cursoNome['resposta'] != false) {
                                                echo $cursoNome['cursos'][0]['nome'];
                                            } ?>
                                        </div>
                                        <select class="form-control" name="cursos" value="">
                                            <?php
                                            $cursos = lista_cursos("");
                                            $i5 = 0;
                                            while ($i5 < sizeof($cursos['cursos'])) {
                                            ?>
                                                <option value="<?= $cursos['cursos'][$i5]['id'] ?>"><?= $cursos['cursos'][$i5]['nome'] ?></option>
                                            <?php $i5++;
                                            } ?>
                                        </select><br>
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">Proximo</button>



                                        <div class="form-group pt-1 pb-2">
                                            <label for="id"><b>Código da turma: </b></label> <?= $turma['id'] ?>
                                        </div>
                                    </form>

                            </div>

                        <?php }
                                if (@$_POST['tag'] == 1) {
                        ?>
                            <form class="form" action="" method="post">
                                <input type="hidden" id="tag" name="nome" value="<?= $_POST['nome'] ?>">
                                <input type="hidden" id="tag" name="cursos" value="<?= $_POST['cursos'] ?>">
                                <input type="hidden" id="id" name="id" value="<?= $_POST['id'] ?>">
                                <input type="hidden" id="tag" name="acao1" value="editar_turma">
                                <?php $periodoNum = periodo_num($_POST['id']);
                                    echo '<strong class="text-gray-dark">Periodo:</strong>';
                                    if ($periodoNum['resposta'] != false) {
                                        echo $periodoNum['periodo']['num'];
                                    } ?>
                                <select class="form-control" name="periodo">
                                    <?php
                                    $curso = lista_periodos($_POST['cursos']);
                                    $i5 = 0;
                                    while ($i5 < $curso['size-periodos']) {
                                    ?>
                                        <option value="<?= $curso['periodos'][$i5]['Periodo'] ?>"><?= $curso['periodos'][$i5]['Periodo'] ?></option>
                                    <?php $i5++;
                                    } ?>
                                </select>
                                <br>
                                <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                    </div>
                            </form>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/turmas'">Cancelar</button>
                            </div>
                        </div>
                    <?php } ?>
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