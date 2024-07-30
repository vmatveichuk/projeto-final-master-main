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


$activity = "disciplinas";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
$instituicao = visualizar_instituicao_id('1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-aula.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");



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
            <?php sidebar_professores('turmas'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <div class="pt-5 pl-4">
                    <h4><?php echo 'Turma:'.$_POST['nome']?></h4>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/professores/turmas'"><-</button>
                <?php
                $DiscipT = lista_de_disciplinas_turma($_POST['idTurma']);
                $i2 = 0;
                $disciP = buscar_disciplinas_professor($_SESSION['id']);
                $disciplinas = array();
                while ($i2 < sizeof($disciP)) {
                    $i3 = 0;
                    while ($i3 < sizeof($DiscipT['disci'])) {
                        if ($disciP[$i2] == $DiscipT['disci'][$i3]) {
                            $nome = busca_nome_disciplina( $DiscipT['disci'][$i3]);
                            array_push($disciplinas,$disciP[$i2]);
                        }
                        $i3++;
                    }

                    $i2++;
                }
                if ($disciplinas[0] == null &&  $disciplinas[1] == null || $disciplinas[0] == null) {
                    echo "<br /><i>Não foram encontradas disciplinas para esta turma </i>";
                } else {
                    $i = 0;
                    while ($i < sizeof($disciplinas)) { 
                        $nome=busca_nome_disciplina($disciplinas[$i]);
                        ?>

                        <div class="media text-muted pt-3" id="">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div>
                                        <a class="" href="javascript:abrirDisc<?= $disciP[$i] ?>.submit()">
                                            <div class="row">
                                                <div class="col">
                                                   <?php $periodo=periodo_num($_POST['idTurma']);
                                                   $curso=pegar_curso_por_turma($periodo['periodo']['curso']);
                                                   echo 'Curso:'.$curso['cursos'][0]['nome']; ?> 
                                                </div>
                                                <div class="col">
                                                <?php echo 'Periodo:'.$periodo['periodo']['num'];?>
                                                 </div>
                                                <div class="col">
                                                    <strong class="text-gray-dark"><?php echo 'Disciplina:'.$nome['nome'] ?></strong><br>
                                                </div>
                                                <div class="col">
                                                    <?php $result = media_geral_avaliacoes_turma_disciplina($_POST['idTurma'], $disciP[$i]);
                                                    if ($result['resposta'] != false) {
                                                        echo $result['media-geral'];
                                                    } else{
                                                        echo "Não existem avaliacoes cadastradas para esta disciplina";
                                                    }?>
                                                </div>
                                            </div>
                                        </a>
                                        <form name="abrirDisc<?= $disciP[$i] ?>" class="form" action="/professores/avaliacoes" method="post">
                                            <input type="hidden" id="acao13" name="idTurma" value="<?= $_POST['idTurma']?>">
                                            <input type="hidden" id="acao13" name="disciId" value="<?=$disciplinas[$i] ?>">
                                            <input type="hidden" id="acao13" name="disciNome" value="<?= $nome['nome']?>">
                                            <input type="hidden" id="acao13" name="nome" value="<?= $_POST['nome']?>">
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
                } ?>
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