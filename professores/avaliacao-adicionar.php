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

if (@$_POST['acao1'] == "adicionar") {
    novo_avaliacoes($_POST['disci'],$_POST['turma'],$_POST['aluno'],$_POST['descricao'],$_POST['data']);
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
            <?php sidebar_professores('envio_documentos'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">

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
                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Descricao</b></label>
                                        <input id="nome" type="text" name="descricao" value="" class="form-control">
                                    </div>
                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Data para entrega</b></label>
                                        <input id="nome" type="text" name="data" value="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="turma"><b>Turma</b></label>
                                        <select class="form-control" name="turma">
                                            <?php
                                            $turmas = buscar_turmas_professor($_SESSION['id']);
                                            $i = 0;
                                            while ($i < sizeof($turmas)) {
                                                $turma = visualizar_turma_id($turmas[$i]);
                                                if($turma['nome']!=false){
                                            ?>
                                                <option value="<?= $turmas[$i] ?>"><?= $turma['nome'] ?></option>
                                            <?php } 
                                            $i++;
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="turma"><b>Disciplinas</b></label>
                                        <select class="form-control" name="disci">
                                            <?php
                                            $disciP = buscar_disciplinas_professor($_SESSION['id']);
                                            $i = 0;
                                            while ($i < sizeof($disciP)) {
                                                $disci = busca_nome_disciplina($disciP[$i]);
                                                if($disci['nome']!=false){
                                            ?>
                                                <option value="<?= $disciP[$i] ?>"><?= $disci['nome'] ?></option>
                                            <?php } 
                                            $i++;
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="turma"><b>Alunos</b></label>
                                        <select class="form-control" name="aluno">
                                            <?php
                                            $turmasProfessorID = buscar_turmas_professor($_SESSION['id']);
                                            $i = 0;
                                            while ($i < sizeof($turmasProfessorID)) {
                                                $turma=aluno_da_turma($turmasProfessorID[$i]);
                                                $i2=0;
                                                while ($i2 < sizeof($turma)) {
                                                    if(isset($turma['alunos'][$i2]['nome'])){
                                            ?>      
                                                    <option value="<?= $turma['alunos'][$i2]['matricula'] ?>"><?= $turma['alunos'][$i2]['nome'] ?></option>
                                            <?php 
                                                }$i2++; }
                                                $i++; } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" id="acao1" name="acao1" value="adicionar">
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6 pb-4">
                                            <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
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