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
$activity = "professores-painel";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");

include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");

$instituicao = visualizar_instituicao_id('1');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Painel</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_professores('painel'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <div class="pt-5 pl-4">
                    <h4>Informações gerais</h4>
                    <br />
                    <hr>
                    <?php
                    // echo '<pre>';
                    // var_dump($_SESSION);
                    // echo '</pre>';
                    // exit;
                    ?>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center container mr-3"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3" style="color: #575656">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Avaliações sem correção
                                        <br />
                                        <?php

                                        $turmasProfessor = buscar_turmas_professor($_SESSION['id']);
                                        $disciplinas = buscar_disciplinas_professor($_SESSION['id']);
                                        $i2 = 0;
                                        $soma = 0;
                                        while ($i2 < sizeof($turmasProfessor)) {
                                            $i1 = 0;
                                            while ($i1 < sizeof($disciplinas)) {
                                                $soma += quantidade_avaliacoes_sem_avaliacao_professsor($turmasProfessor[$i2], $disciplinas[$i1]);
                                                $i1++;
                                            }
                                            $i2++;
                                        }
                                        echo '<span style="font-size: 32px; color:#ff5050">' . $soma . '</span>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de avaliações
                                        <br />
                                        <?php
                                        $i2 = 0;
                                        $soma = 0;
                                        while ($i2 < sizeof($turmasProfessor)) {
                                            $i1 = 0;
                                            while ($i1 < sizeof($disciplinas)) {
                                                $soma += quantidade_avaliacoes_professsor($turmasProfessor[$i2], $disciplinas[$i1]);
                                                $i1++;
                                            }
                                            $i2++;
                                        }

                                        ?>
                                        <span style="font-size: 32px; color:#00cc66">
                                            <?= $soma ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de alunos
                                        <br />
                                        <?php
                                              $i2 = 0;
                                              $soma = 0;
                                              while ($i2 < sizeof($turmasProfessor)) {
                                                $soma+=quantidade_alunos2($turmasProfessor[$i2]);
                                                  $i2++;
                                              }
                                 
                                        //var_dump($aluno);
                                       
                                        //var_dump($result);
                                        ?>
                                        <span style="font-size: 32px; color:#00cc66">
                                            <?= $soma ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de turmas
                                        <br />
                                        <span style="font-size: 32px; color: #00cc66">
                                            <?php
                                            echo sizeof($turmasProfessor);
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de disciplinas
                                        <br />
                                        <span style="font-size: 32px; color: #00cc66">
                                            <?php
                                            $a=array();
                                              for($i=0;$i<sizeof($disciplinas);$i++){
                                                  if($disciplinas[$i]!=0 && $disciplinas[$i]!=null){
                                                    array_push($a,$disciplinas[$i]);
                                                  }
                                              }
                                              echo sizeof($a);
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- ---------------- -->
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