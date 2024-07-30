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
$activity = "administracao editar aluno";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
$instituicao = visualizar_instituicao_id('1');

//motor php
$gravar = false;
$gravar_admin = false;

if((@$_POST['id'] == "")){
    $message = 'Escolha um aluno.';
    $message_type = 'warning';
    managerMessage($message, $message_type);
    header("Location: /administracao/alunos");
    exit;
}
if(@$_POST['tag']){
    if((@$_POST['nome'] == "")){
        $message = 'Escreva um nome para o aluno.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        $_POST['tag'] = false;
    } else {
        if(!verifica_aluno_matricula2(@$_POST['matricula'], $_POST['id'])){
        $gravar = true;
        } else {
        $message = 'Já existe um aluno com esse número de matrícula.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        $_POST['tag'] = false;
        }
    }
}
if(($gravar == true)){
    if(editaraluno($_POST['id'], $_POST['matricula'], $_POST['nome'],$_POST['turma'])){
        $message = 'Aluno atualizado com sucesso.';
        $message_type = 'success';
        //managerMessage($message, $message_type);
        $_POST['tag'] = 1;
    } else {
        $message = 'Ocorreu um erro na atualização do aluno.';
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
    <title>Editar aluno</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('alunos');?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">      
                    <h4>Editar aluno</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage();?></div>
                    <div class="pl-4 mr-3">
                    <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                    <div class="col-md-4 col-lg-4 col-xl-3">
                    <hr>
                    <?php 
                        // 0 - tag
                        $aluno = visualizar_aluno_id(@$_POST['id']);
                         if(!@$_POST['tag']){?>
                            <form class="form" action="" method="post">
                                <input type="hidden" id="tag" name="tag" value="1">
                                <input type="hidden" id="id" name="id" value="<?=@$aluno['id']?>">
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome</b></label>
                                    <input id="nome" type="text"  name="nome" value="<?=@$aluno['nome']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="turma"><b>Turma</b></label>
                                    <select class="form-control" name="turma">
                                    <option value="<?=0?>">Sem turma</option>
                                    <?php
                                    $turmas=lista_turmas('');
                                    $i=0;
                                    while($i<$turmas['size-turmas']){
                                        ?>
                                        <option value="<?=$turmas['turmas'][$i]['id']?>"><?=$turmas['turmas'][$i]['nome']?></option>
                                    <?php $i++; } ?>
                                    </select>
                                </div>
                                <div class="form-group pt-4">
                                    <label for="matricula"><b>Matrícula</b></label>
                                    <input id="matricula" type="text"  name="matricula" value="<?=@$aluno['matricula']?>" class="form-control">
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Código da aluno: </b></label> <?=$aluno['id']?>
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6 pb-4">
                                        <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
                                    </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-secondary btn-block btn-sm" onclick="window.location.href='/administracao/alunos'">Cancelar</button>
                                    </div>
                                </div>
                            
                        <?php }
                        if(@$_POST['tag'] == 1){
                            ?>
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome: </b></label> <?=$aluno['nome']?>
                                </div>
                                <div class="form-group pt-1 pb-1">
                                    <label for="id"><b>Mátricula: </b></label> <?=$aluno['matricula']?>
                                </div>
                                <div class="form-group pt-1 pb-2">
                                    <label for="id"><b>Código do aluno: </b></label> <?=$aluno['id']?>
                                </div>
                                <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success btn-block btn-sm" onclick="window.location.href='/administracao/alunos'">Ver lista</button>
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