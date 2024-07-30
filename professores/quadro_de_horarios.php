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


$activity = "disciplinas";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
$instituicao = visualizar_instituicao_id('1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-aula.php");

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
            <?php sidebar_professores('quadro_horarios'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="background-color: #0091FF; color: white;">Aula<br>
                            </th>
                            <th style="text-align: center; background-color: #0091FF; color: white;" scope="col">1ª aula</th>
                            <th style="text-align: center; background-color: #0091FF; color: white;" scope="col">2ª aula</th>
                            <th style="text-align: center; background-color: #0091FF; color: white;" scope="col">3ª aula</th>
                            <th style="text-align: center; background-color: #0091FF; color: white;" scope="col">4ª aula</th>
                            <th style="text-align: center; background-color: #0091FF; color: white;" scope="col">5ª aula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Segunda</th>
                            <?php
                            $aulas = aula_por_dia_professor('segunda', $_SESSION['id']);
                            if ($aulas['resposta']!=false) {
                            for ($i = 0; $i < $aulas['size-aula']; $i++) {
                                $turma = pegar_turmas_aluno($aulas['aulas'][$i]['turma-id']);
                                echo '<td style="text-align: center;">' . $aulas['aulas'][$i]['nome'] . ' - ' . $turma['nome'] .'</br>'.$aulas['aulas'][$i]['inicial'].' até '.$aulas['aulas'][$i]['termino'].'</td>';
                            }; 
                        }?>


                        </tr>
                        <tr>
                            <th scope="row">Terça</th>
                            <?php
                            $aulas = aula_por_dia_professor('terca', $_SESSION['id']);
                            if ($aulas['resposta'] != false) {
                                for ($i = 0; $i < $aulas['size-aula']; $i++) {
                                    $turma = pegar_turmas_aluno($aulas['aulas'][$i]['turma-id']);
                                    echo '<td style="text-align: center;">' . $aulas['aulas'][$i]['nome'] . ' - ' . $turma['nome'] .'</br>'.$aulas['aulas'][$i]['inicial'].' até '.$aulas['aulas'][$i]['termino'].'</td>';
                                };
                            } ?>


                        </tr>
                        <tr>
                            <th scope="row">Quarta</th>
                            <?php
                            $aulas = aula_por_dia_professor('quarta', $_SESSION['id']);
                            if ($aulas['resposta'] != false) {
                                for ($i = 0; $i < $aulas['size-aula']; $i++) {
                                    $turma = pegar_turmas_aluno($aulas['aulas'][$i]['turma-id']);
                                    echo '<td style="text-align: center;">' . $aulas['aulas'][$i]['nome'] . ' - ' . $turma['nome'] .'</br>'.$aulas['aulas'][$i]['inicial'].' até '.$aulas['aulas'][$i]['termino'].'</td>';
                                };
                            }; ?>
                        </tr>
                        <tr>
                            <th scope="row">Quinta</th>
                            <?php
                            $aulas = aula_por_dia_professor('quinta', $_SESSION['id']);
                            if ($aulas['resposta']!=false) {
                            for ($i = 0; $i < $aulas['size-aula']; $i++) {
                                $turma = pegar_turmas_aluno($aulas['aulas'][$i]['turma-id']);
                                echo '<td style="text-align: center;">' . $aulas['aulas'][$i]['nome'] . ' - ' . $turma['nome'] .'</br>'.$aulas['aulas'][$i]['inicial'].' até '.$aulas['aulas'][$i]['termino'].'</td>';
                            };
                         } ?>
                        </tr>
                        <tr>
                            <th scope="row">Sexta</th>
                            <?php
                            $aulas = aula_por_dia_professor('sexta', $_SESSION['id']);
                            if ($aulas['resposta']!=false) {
                            for ($i = 0; $i < $aulas['size-aula']; $i++) {
                                $turma = pegar_turmas_aluno($aulas['aulas'][$i]['turma-id']);
                                echo '<td style="text-align: center;">' . $aulas['aulas'][$i]['nome'] . ' - ' . $turma['nome'] .'</br>'.$aulas['aulas'][$i]['inicial'].' até '.$aulas['aulas'][$i]['termino'].'</td>';
                            };
                         } ?>
                        </tr>
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