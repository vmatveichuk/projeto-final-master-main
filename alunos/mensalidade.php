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
    <title>Aluno</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_aluno('mensalidade'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("aluno"); ?>
                <h4 style="padding: 15px;"> Mensalidade </h4>
                <div class="text-center"><?php SistemMessage(); ?></div>
                </h4>
                <table class="table table-striped">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Download</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Mês/Ano</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Valor</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Status</th>
                        </tr>
                        <?php

                        $boletos = mensalidade_por_aluno($_SESSION['id']);


                        if ($boletos['resposta'] == false) {
                            echo "Não existem boletos para este aluno";
                        } else {
                            $i1 = 0;

                            while ($i1 < $boletos['size']) {



                        ?>
                                <tr>
                                    <th style="text-align: center;" scope="row">
                                        <img src="/sx/common/assets/download.png" width="30px" height="30px">
                                    </th>
                                    <td style="text-align: center;"><?php echo $boletos['boletos'][$i1]['mes'] ?></td>
                                    <td style="text-align: center;"><?php echo  $boletos['boletos'][$i1]['valor'] ?></td>
                                    <td style="text-align: center;"><?php echo $boletos['boletos'][$i1]['status'] ?></td>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="id" value="<?= $boletos['boletos'][$i1]['id'] ?>">
                                        <input type="hidden" id="acao1" name="aluno" value="<?= $boletos['boletos'][$i1]['aluno'] ?>">
                                    </form>
                                </tr>

                        <?php $i1++;
                            }
                        } ?>
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