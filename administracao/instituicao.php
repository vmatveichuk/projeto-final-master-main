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
$activity = "administracao-instituicao";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
if (@$_POST['acao']=="editar-instituicao"){
    editarInstituicao('1', $_POST['nome'], $_POST['cidade'], $_POST['endereco'], $_POST['nome_diretor'], $_POST['telefone']);
}
$instituicao = visualizar_instituicao_id('1');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Instituição</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('instituicao');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4><?=$instituicao["faculdade"]?> </h4>
                    </div>
                <div id='conteudo-pagina' Class="">
                   <div class="text-center container"><?php SistemMessage();?></div>
                        <div class="pl-4 mr-3">
                            <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                <div class="col-md-4 col-lg-4 col-xl-3">
                                    <hr style="">
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="acao" value="editar-instituicao">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?=$instituicao["nome"]?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="cidade">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade" value="<?=$instituicao["cidade"]?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="endereco">Endereço</label>
                                            <input type="text" class="form-control" id="endereco" name="endereco" value="<?=$instituicao["endereco"]?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nome_diretor">Decana</label>
                                            <input type="text" class="form-control" id="nome_diretor" name="nome_diretor" value="<?=$instituicao["nome_diretor"]?>">
                                        </div>
                                        <div class="form-group pb-4">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?=$instituicao["telefone"]?>">
                                        </div>
                                        <button class="btn btn-sm btn-primary" type="submit">Salvar alterações</button>
                                    </form>
                                </div>
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