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
$activity = "professores avaliacoes";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
$instituicao = visualizar_instituicao_id('1');

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
            <?php sidebar_professores('turmas');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div>
                        <h3>Avaliações</h3>
                        <hr>
                        <a href="/professores/avaliacoes" style="color: #007bff;;" class="breadcrumb-item"><b>Turma: </b></a> 
                        <?php 
                        $info_turma=visualizar_turma_id($_POST['turma_id']);
                        echo $info_turma['nome'];
                        echo "<b> >  Disciplina: </b> ";
                        $info_disciplina=visualizar_disciplina_id($_POST['disciplina_id']);
                        echo $info_disciplina['nome'];
                      
                        ?>
                        <!-- <div class='d-flex flex-row'>
                            <div class=''>
                                <a href="/professores/avaliacoes" style="color: #007bff;;" class="breadcrumb-item">Turma: </a> 
                            </div>
                            <div class='pl-1 pr-2'>
                                <?php 
                                $info_turma=visualizar_turma_id($_POST['turma_id']);
                                echo $info_turma['nome'];?>
                            </div>
                            <div class='pl-1'>
                            <b> > </b>
                            </div>
                            <div class='pl-3'>
                                <form class="form" action="/professores/avaliacoes-avaliacao" method="post">
                                    <input type="hidden" id="registros-id3" name="turma_id" value="<?=$_POST['turma_id']?>">
                                    <input type="hidden" id="registros-id3" name="disciplina_id" value="<?=$_POST['disciplina_id']?>">
                                    <button style='padding: 0; border: none; background: none;'type="submit"> <span style="color: #007bff;;" class="breadcrumb-item" > Disciplina:</span></button>
                                </form>
                            </div>
                            <div class='pl-1'>
                                <?php $info_disciplina=visualizar_disciplina_id($_POST['disciplina_id']);
                                echo $info_disciplina['nome'];
                                ?>
                            </div>
                        </div> -->

                        <div class="text-center"><?php SistemMessage();?></div>
                            <div class="row text-justify">
                                <div class="col- col-sm-4 col-md-3 col-lg-2 pb-2 pt-1">
                                        <!-- <button type="button" class="btn btn-success btn-sm btn-block" onclick="window.location.href='/professores/avaliacoes'">Lista de turmas</button> -->
                                </div>
                                <div class=" col- col-sm-8 col-md-9 col-lg-10 pt-2">
                                <div>
                            </div>
                        </div>
                            <h5 class='pt-2 pl-3'>Lista de avaliações</h5>
                        </div>
                        <div class="my-3 p-3 bg-white rounded shadow-sm">
                            <?php 
                                $avaliacoes=lista_avaliacoes($_POST['disciplina_id'], $_POST['turma_id']);
                                // echo "<pre>";
                                // var_dump($avaliacoes);
                                // echo "</pre>";

                                // if ((@$_POST['acao']=="filtrar") and (@$_POST['filtro']!=="") ){
                                    //echo '<a href="/professores/avaliacoes" style="color: #009933;"class="text-succes">Mostrar todos as turmas</a><br/>';
                                // }
                                if(!@$avaliacoes['size-avaliacoes']){
                                    echo "<br /><i>Não existem avaliações cadastradas para esta turma.</i>";
                                    $disciplinas['size-disciplinas']=0;
                                }
                                //echo '<hr>';
                                $i=0;
                                while($i<@$avaliacoes['size-avaliacoes']){?>
                                    <div class="media text-muted pt-3"  id="">
                                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                            <div class="d-flex justify-content-between align-items-center w-100">
                                                <div>
                                                    <span style="color: #0091FF; font-size: 24px;"><?=$i+1?></span>
                                                    <strong class="pl-2 text-gray-dark">Data: <?=$avaliacoes['avaliacoes'][$i]['data']?></strong>
                                                    <?php 
                                            $n = quantidade_avaliacoes_sem_avaliacao_professsor_data($_POST['turma_id'], $_POST['disciplina_id'],$avaliacoes['avaliacoes'][$i]['data'] );
                                            if($n>1){?>
                                            <h6><span class="badge badge-danger"><span class="badge badge-light"><?=$n?></span> Avaliações sem correção</span></h6>
                                            <?php }
                                            if($n==1){?>
                                                <h6><span class="badge badge-danger"><span class="badge badge-light"><?=$n?></span> Avaliação sem correção</span></h6>
                                                <?php }?>
                                                </div>
                                                <div>
                                                    <form class="form" action="/professores/avaliacoes-avaliacao" method="post">
                                                        <input type="hidden" id="avaliacoes-id3" name="data" value="<?=$avaliacoes['avaliacoes'][$i]['data']?>"> 
                                                        <input type="hidden" id="registros-id3" name="turma_id" value="<?=$_POST['turma_id']?>">
                                                        <input type="hidden" id="registros-id3" name="disciplina_id" value="<?=$_POST['disciplina_id']?>">
                                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/visualizar-icon.png" alt="Submit" width="28px">
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>  
                                    </div>
                                <?php 
                                $i++;
                                }
                                ?>
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