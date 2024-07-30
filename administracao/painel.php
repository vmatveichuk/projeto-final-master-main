<?php
session_start();
if(!@$_SESSION['id']){
    header('Location: /');
}
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/message-box.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/topbar.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/elements/sidebar.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
$activity = "administracao painel";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-administradores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");

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
            <?php sidebar_admin("painel")?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4>Informações gerais</h4>
                    <br />
                    <hr>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center container mr-3"><?php SistemMessage();?></div>   
                    <div class="pl-4 mr-3" style="color: #575656">
                        <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de turmas
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_turmas()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de disciplinas
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_disciplinas()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de avaliações
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_avaliacoes()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                       Avaliações sem correção
                                        <br/>
                                        <span style="font-size: 32px; color:
                                        <?php
                                            $numero_sem_correcao = quantidade_avaliacoes_sem_avaliacao();
                                            if($numero_sem_correcao == 0){echo '#00cc66';}
                                            else {echo "#ff5050";}
                                        ?>
                                            ">
                                        <?=$numero_sem_correcao?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Média geral das avaliações
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?php 
                                            $media=media_geral_avaliacoes();
                                            if($media['resposta']==true){
                                                echo $media['media-geral'];
                                            } else {echo '0';}
                                        ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de alunos
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_alunos()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de professores
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_professores()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de admins.
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_administradores()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de cursos
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_cursos()?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de periodos
                                        <br/>
                                        <span style="font-size: 32px; color: #00cc66">
                                        <?=quantidade_periodo()?>
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
    <script >
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>