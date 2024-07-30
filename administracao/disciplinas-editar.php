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
$activity = "administracao neditar disciplina";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;

if((@$_POST['id'] == "")){
    $message = 'Escolha uma disciplina.';
    $message_type = 'warning';
    managerMessage($message, $message_type);
    header("Location: /administracao/disciplinas");
    exit;
}
if(@$_POST['tag']){
    if((@$_POST['nome'] == "")){
        $message = 'Escreva um nome para a disciplina.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        $_POST['tag'] = 1;
    } else {
        $gravar = true;
    }
}
if(($gravar == true)){
    if(editardisciplina($_POST['id'],$_POST['nome'])){
        $message = 'disciplina atualizada com sucesso.';
        $message_type = 'success';
        //managerMessage($message, $message_type);
        $_POST['tag'] = 1;
    } else {
        $message = 'Ocorreu um erro na atualização da disciplina.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        $_POST['tag'] = false;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editar disciplina</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('disciplinas');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4>Editar disciplina</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage();?></div>
                    <div class="pl-4 mr-3">
                    <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                    <div class="col-md-4 col-lg-4 col-xl-3">
                    <hr>
                    <?php 
                        // 0 - tag
                        $disciplina = visualizar_disciplina_id(@$_POST['id']);
                         if(!@$_POST['tag']){?>
                            <form class="form" action="" method="post">
                                <input type="hidden" id="tag" name="tag" value="1">
                                <input type="hidden" id="id" name="id" value="<?=@$disciplina['id']?>">
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome</b></label>
                                    <input id="nome" type="text"  name="nome" value="<?=@$disciplina['nome']?>" class="form-control">
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Código da disciplina: </b></label> <?=$disciplina['id']?>
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                    </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/disciplinas'">Cancelar</button>
                                    </div>
                                </div>
                            
                        <?php }
                        if(@$_POST['tag'] == 1){
                            ?>
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome: </b></label> <?=$disciplina['nome']?>
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Código da disciplina: </b></label> <?=$disciplina['id']?>
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success btn-block btn-sm" onclick="window.location.href='/administracao/disciplinas'">Ver lista</button>
                                    </div>
                                </div>
                            <?php }?>
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
    <script >
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>