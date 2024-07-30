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
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-mensalidade.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");


$activity = "disciplinas";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
$instituicao = visualizar_instituicao_id('1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-aula.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-ajuste.php");


$aluno = visualizar_aluno_id2($_SESSION['id']);

$turma = pegar_turmas_id($_SESSION['id']);

$turmaNome = visualizar_turma_id($turma['Turma1']);

$turma1 = lista_de_disciplinas_turma($turmaNome['id']);




if (@$_POST['acao1'] == "ajuste") {
    if (selecionar_ajuste($_SESSION['id']) != true) {
        Insert_ajuste($_POST['disciplina1'], $_POST['disciplina2'], $_POST['disciplina3'], $_POST['disciplina4'], $_POST['disciplina5'], $_POST['disciplina6'], $_SESSION['id']);
    }else{
        atualizar_ajuste($_POST['disciplina1'], $_POST['disciplina2'], $_POST['disciplina3'], $_POST['disciplina4'], $_POST['disciplina5'], $_POST['disciplina6'], $_SESSION['id']);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Alunos</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_aluno('ajuste_academico'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("aluno"); ?>
                <div class="text-center"><?php SistemMessage(); ?></div>
                <table class="table table-striped">
                    <tbody>
                        <form class="form" action="" method="post">
                            <tr>
                                <th scope="row">1 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina1">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                                
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">2 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina2">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                               
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">3 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina3">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                                
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">4 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina4">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                                if ($disciplinas2['disciplinas'][$i5]['id'] != $turma1['disci'][3]) {
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                }
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">5 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina5">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                                
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">6 disciplina</th>
                                <th scope='row'>
                                    <div class="form-group">
                                        <select class="form-control" name="disciplina6">
                                            <option value="<?= 0 ?>">Sem disciplina</option>
                                            <?php
                                            $disciplinas2 = lista_disciplinas('');
                                            $i5 = 0;
                                            while ($i5 < $disciplinas2['size-disciplinas']) {
                                                
                                            ?>
                                                    <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                            <?php
                                                $i5++;
                                            } ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <input type="hidden" id="acao1" name="acao1" value="ajuste">

                                <th scope="row">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                    </div>
                                </th>
                            </tr>
                        </form>
                    </tbody>


                </table>

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