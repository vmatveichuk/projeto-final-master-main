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
    $activity = "administracao alunos";
    preInitializeLogVariables($activity, $_SESSION['id']);
    insertLog();
    posInitializeLogVariables();
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    $instituicao = visualizar_instituicao_id('1');
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
    if (@$_POST['acao1']=="deletar"){
        deletar_usuario_id($_POST['alunos-id']);
    ;
    }
    if (@$_POST['acao']=="filtrar"){
        $usuarios= lista_usuarios_nome($_POST['filtro']);
    } else {
        $usuarios=lista_usuarios_nome("");
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Alunos</title>
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
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div >
                        <h3>Usuarios</h3>
                        <hr>
                        <div class="text-center"><?php SistemMessage();?></div>
                        <div class="row text-justify">
                            <div class="col- col-sm-4 col-md-3 col-lg-2 pb-2 pt-1">
                                <button type="button" class="btn btn-primary btn-sm btn-block" onclick="window.location.href='/administracao/usuario-novo'">+ Adicionar</button>
                            </div>
                            <div class=" col- col-sm-8 col-md-9 col-lg-10">
                                <div class="input-group d-flex flex-row" style="border: 1px solid #ccc; border-radius: 5px;">
                                    <form class="form-inline" action="" method="post">
                                        <div class="input-group-text transparent-prepend" style="background-color: #fff; border: none; border-radius: 5px; margin-right: none;">
                                            <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-lupa-dark.png" alt="Submit" width="28" height="32">
                                        </div>
                                        <div >
                                            <input type="hidden" id="acao1" name="acao" value="filtrar"> 
                                            <input class="form-control" style="border: none;" id="palavraPesquisada" type="text" placeholder="Buscar" name="filtro" aria-label="Search">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="my-3 p-3 bg-white rounded shadow-sm">
                            <?php 
                             if ((@$_POST['acao']=="filtrar") and (@$_POST['filtro']!=="") ){
                                 echo '<a href="/administracao/usuarios" style="color: #009933;"class="text-succes">Mostrar todos os usuarios</a><br/>';
                              }
                                $i=0;
                                if(!@$usuarios['size-usuarios']){
                                    echo "<br /><i>Não foram encontrados resultados para a busca <b>'".@$_POST['filtro']."'</b></i>";
                                    $usuarios['size-usuarios']=0;
                                }
                                while($i<$usuarios['size-usuarios']){?>
                                    <div class="media text-muted pt-3"  id="">
                                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                            <div class="d-flex justify-content-between align-items-center w-100">
                                                <div>
                                                    <form class="form" action="/administracao/usuario-editar" method="post">
                                                        <input type="hidden" id="usuario-id" name="id" value="<?=$usuarios['usuarios'][$i]['id']?>"> 
                                                        <input type="hidden" id="usuario-id" name="nome" value="<?=$usuarios['usuarios'][$i]['nome']?>"> 
                                                        <input type="hidden" id="usuario-id" name="email" value="<?=$usuarios['usuarios'][$i]['email']?>"> 
                                                        <input type="hidden" id="usuario-id" name="cpf" value="<?=$usuarios['usuarios'][$i]['cpf']?>"> 
                                                        <input type="hidden" id="usuario-id" name="senha" value="<?=$usuarios['usuarios'][$i]['senha']?>"> 
                                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px">
                                                    </form>
                                                    <strong class="text-gray-dark"><?php echo ucfirst($usuarios['usuarios'][$i]['nome']);?></strong>
                                                </div>
                                                <div>
                                                    <form class="form" action="" method="post">
                                                        <input type="hidden" id="acao1" name="acao1" value="deletar"> 
                                                        <input type="hidden" id="alunos-id" name="alunos-id" value="<?=$usuarios['usuarios'][$i]['id']?>"> 
                                                        <?php 
                                                        if (@$_POST['acao']=="filtrar"){?>
                                                        <input type="hidden" id="acao1" name="acao" value="filtrar"> 
                                                        <input type="hidden" id="acao1" name="filtro" value="<?=$_POST['filtro']?>"> 
                                                        <?php }?>
                                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-trash.png" alt="Submit" width="24px">
                                                    </form>
                                                </div>
                                            </div>
                                            <span class="d-block">Email: <?=$usuarios['usuarios'][$i]['email']?></span>
                                            <span class="d-block">cpf: <?=$usuarios['usuarios'][$i]['cpf']?></span>
                                            
                                        </div>  
                                    </div>
                                <?php 
                                $i++;
                                }?>
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