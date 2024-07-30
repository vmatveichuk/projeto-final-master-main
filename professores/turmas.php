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
$activity = "professores-turmas";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");





?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>turmas</title>
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
                <?php topbar("professores");
                $instituicao=visualizar_instituicao_id(1) ?>
                <div class="pt-5 pl-4">
                    <h4><?php echo $instituicao['nome'];?></h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <?php SistemMessage(); ?>
                    <?php



                    $turmaid = buscar_turmas_professor($_SESSION['id']);            


                    $i1 = 0;
                    $turmas = array();
                    while ($i1 < sizeof($turmaid)) {
                        $nome = pegar_turmas_aluno($turmaid[$i1]);
                        $turmas[$i1] = $nome['nome'];
                        $i1++;
                    }
                    $i = 0;
                    if ($turmas[0] == null && $turmas[1] == null && $turmas[2] == null && $turmas[3] == null) {
                        echo "<br /><i>Não foram encontradas turmas </i>";
                    }
                    while ($i < sizeof($turmas)) { ?>
                        <div class="media text-muted pt-3" id="">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div>
                                        <a class="" href="javascript:abrirTurma<?= $turmaid[$i] ?>.submit()">
                                            <strong class="text-gray-dark"><?php echo " " . $turmas[$i] ?></strong><br>
                                        </a>
                                        <form name="abrirTurma<?= $turmaid[$i] ?>" class="form" action="/professores/disciplinas" method="post">
                                            <input type="hidden" id="acao13" name="idTurma" value="<?= $turmaid[$i] ?>">
                                            <input type="hidden" id="acao13" name="nome" value="<?= $turmas[$i] ?>">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $i++;
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