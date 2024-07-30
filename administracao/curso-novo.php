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
$activity = "administracao nova aluno";
$usuario = "usuario-logado";
preInitializeLogVariables($activity, $usuario);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-usuarios.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;

if((@$_POST['acao1']=="novo_curso")){
    novo_curso($_POST['nome']);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Nova aluno</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('cursos');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4>Novo curso</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/cursos'"><-</button>
                    <div class="text-center"><?php SistemMessage();?></div>
                    <div class="pl-4 mr-3">
                    <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                    <div class="col-md-4 col-lg-4 col-xl-3">
                    <hr>
                    <?php 
                        // 0 - tag
                         if(!@$_POST['tag']){?>
                            <form class="form" action="" method="post">
                                <input type="hidden" id="tag" name="tag" value="1">
                                <input type="hidden" id="tag" name="acao1" value="novo_curso">
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome</b></label>
                                    <input id="nome" type="text"  name="nome" class="form-control">
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">+ Adicionar</button>
                                    </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/cursos'">Cancelar</button>
                                    </div>
                                </div>
                            
                        <?php }
                        if(@$_POST['tag'] == 1){
                            ?>
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome:<?php echo $_POST['nome']?> </b></label> 
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success btn-block btn-sm" onclick="window.location.href='/administracao/cursos'">Ver lista</button>
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