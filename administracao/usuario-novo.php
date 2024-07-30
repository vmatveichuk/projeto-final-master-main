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
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;

if((@$_POST['acao1']=="novo_usuario")){
    if(novo_usuario($_POST['nome'], $_POST['cpf'], $_POST['email'],$_POST['senha'])){
        $message = 'Usuario cadastrado com sucesso.';
        $message_type = 'success';
        //managerMessage($message, $message_type);
        $_POST['tag'] = 1;

    } else {
        $message = 'Ocorreu um erro no cadastro do aluno.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        $_POST['tag'] = false;
    }
}
?>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  } 
}
</script>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Novo usuario</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('usuarios');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4>Novo usuario</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/usuarios'"><-</button>
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
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome</b></label>
                                    <input id="nome" type="text"  name="nome" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="turma"><b>Cpf</b></label>
                                    <input id="cpf" type="text" size= "14" name="cpf" maxlength="14"  OnKeyPress="formatar('###.###.###-##', this)" class="form-control">
                            
                                </div>
                                <div class="form-group pt-2 pb-3">
                                    <label for="nome"><b>Email</b></label>
                                    <input id="nome" type="text"  name="email" class="form-control">
                                </div>
                                <div class="form-group pt-2 pb-3">
                                    <label for="nome"><b>Senha</b></label>
                                    <input id="nome" type="text"  name="senha" class="form-control">
                                </div>
                                <input id="nome" type="hidden"  name="acao1" value="novo_usuario" class="form-control">
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">+ Adicionar</button>
                                    </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/usuarios'">Cancelar</button>
                                    </div>
                                </div>
                            
                        <?php }
                        if(@$_POST['tag'] == 1){
                             $ultimo_id = visualizar_ultimo_id_aluno($_POST['nome']);
                             $aluno = visualizar_aluno_id($ultimo_id);
                            ?>
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome: </b></label> <?=$_POST['nome']?>
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Cpf: </b></label> <?=$_POST['cpf']?>
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Email: </b></label> <?=$_POST['email']?>
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success btn-block btn-sm" onclick="window.location.href='/administracao/usuarios'">Ver lista</button>
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