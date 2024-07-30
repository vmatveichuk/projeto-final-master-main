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
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-usuarios.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-ajuste.php");



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


$aluno = visualizar_aluno_id2($_SESSION['id']);

$turma = pegar_turmas_id($_SESSION['id']);

$turmaNome = visualizar_turma_id($turma['Turma1']);

$turma1 = lista_de_disciplinas_turma($turmaNome['id']);

$turma2= ajuste_disciplinas($_SESSION['id']);

$periodo = periodo_num($turmaNome['id']);



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Professores</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_aluno('disciplinas'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("aluno"); ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div>
                        <h3>Disciplinas da turma: <?php if (isset($_POST['nome-turma'])) {
                                                        echo $_POST['nome-turma'];
                                                    } else {
                                                        echo $turmaNome['nome'];
                                                    } ?> </h3>
                        <h3>Periodo: <?php echo $periodo['periodo']['num']; ?> </h3>

                        <hr>
                        <div class="text-center"><?php SistemMessage(); ?></div>
                    </div>
                    <?php
                    if (selecionar_ajuste($_SESSION['id']) != true) {
                        if ($turma1['resposta'] != true) {
                            echo "<br /><i>Não foram encontradas disciplinas para este aluno </i>";
                        } else {
                            $i = 0;
                            while ($i < sizeof($turma1['disci'])) {
                                $disci1 = visualizar_disciplina_id($turma1['disci'][$i]);

                    ?>


                                <div class="media text-muted pt-3" id="">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <div>
                                                <a class="" href="javascript:abrirDisc<?= $disci1['id'] ?>.submit()">
                                                    <div class="row">
                                                        <div class="col">
                                                            <?php if ($disci1 != false) { ?>
                                                                <strong class="text-gray-dark"><?php echo $disci1['nome'] ?></strong><br>
                                                            <?php } else {
                                                                echo "Não existem disciplinas cadastradas para este aluno";
                                                            } ?>
                                                        </div>
                                                        <div class="col">
                                                            <?php $result = media_geral_avaliacoes_aluno_disci($aluno['matricula'], $disci1['id']);
                                                            if ($result['resposta'] != false) {
                                                                echo $result['media-geral'];
                                                            } else {
                                                                echo "Não existem ainda notas para esta disciplina";
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </a>
                                                <form name="abrirDisc<?= $disci1['id']  ?>" class="form" action="/alunos/avaliacoes" method="post">
                                                    <input type="hidden" id="acao13" name="idTurma" value="<?= $turma['Turma1'] ?>">
                                                    <input type="hidden" id="acao13" name="disciId" value="<?= $disci1['id'] ?>">
                                                    <input type="hidden" id="acao13" name="disciNome" value="<?= $disci1['nome'] ?>">
                                                    <input type="hidden" id="acao13" name="matricula" value="<?= $aluno['matricula'] ?>">
                                                    <input type="hidden" id="acao13" name="nome-turma" value="<?= $turmaNome['nome'] ?>">
                                                    <input type="hidden" id="acao13" name="nome" value="">
                                                </form>

                                            </div>
                                            <div>
                                                <form class="form" action="" method="post">
                                                    <input type="hidden" id="turmas-id" name="turmas-id" value="<?= $turmas['turmas'][$i]['id'] ?>">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php $i++;
                            }
                        }
                    } else { ?>
                        <?php
                        if ($turma2['resposta'] != true) {
                            echo "<br /><i>Não foram encontradas disciplinas para este aluno </i>";
                        } else {
                            $i = 0;
                            while ($i < sizeof($turma2['disci'])) {
                                $disci1 = visualizar_disciplina_id($turma2['disci'][$i]);

                        ?>


                                <div class="media text-muted pt-3" id="">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <div>
                                                <a class="" href="javascript:abrirDisc<?= $disci1['id'] ?>.submit()">
                                                    <div class="row">
                                                        <div class="col">
                                                            <?php if ($disci1 != false) { ?>
                                                                <strong class="text-gray-dark"><?php echo $disci1['nome'] ?></strong><br>
                                                            <?php } else {
                                                                echo "Não existem disciplinas cadastradas para este aluno";
                                                            } ?>
                                                        </div>
                                                        <div class="col">
                                                            <?php $result = media_geral_avaliacoes_aluno_disci($aluno['matricula'], $disci1['id']);
                                                            if ($result['resposta'] != false) {
                                                                echo $result['media-geral'];
                                                            } else {
                                                                echo "Não existem ainda notas para esta disciplina";
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </a>
                                                <form name="abrirDisc<?= $disci1['id']  ?>" class="form" action="/alunos/avaliacoes" method="post">
                                                    <input type="hidden" id="acao13" name="idTurma" value="<?= $turma['Turma1'] ?>">
                                                    <input type="hidden" id="acao13" name="disciId" value="<?= $disci1['id'] ?>">
                                                    <input type="hidden" id="acao13" name="disciNome" value="<?= $disci1['nome'] ?>">
                                                    <input type="hidden" id="acao13" name="matricula" value="<?= $aluno['matricula'] ?>">
                                                    <input type="hidden" id="acao13" name="nome-turma" value="<?= $turmaNome['nome'] ?>">
                                                    <input type="hidden" id="acao13" name="nome" value="">
                                                </form>

                                            </div>
                                            <div>
                                                <form class="form" action="" method="post">
                                                    <input type="hidden" id="turmas-id" name="turmas-id" value="<?= $turmas['turmas'][$i]['id'] ?>">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php $i++;
                            }
                        }
                    } ?>
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