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
$activity = "professores avaliacoes";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
$instituicao = visualizar_instituicao_id('1');
// if (@$_POST['acao']=="filtrar"){
//     $avaliacoes= lista_avaliacoes($_POST['filtro']);
// } else {
//     $disciplinas=lista_disciplinas("");
// }
if (@$_POST['acao1']=="entregar"){
    entregar($_POST['id']);
}

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
            <?php sidebar_aluno('disciplinas'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("aluno"); ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div>
                        <a class="btn btn-light" href="javascript:voltar.submit()">
                            <button type="button" class="btn btn-secondary btn-sm">
                                <- </button>
                        </a>
                        <form name="voltar" action="/alunos/disciplinas" method="post">
                            <input type="hidden" id="diretorio-id" name='idTurma' value="<?= $_POST['idTurma'] ?>">
                            <input type="hidden" id="acao13" name="nome" value="<?= $_POST['nome'] ?>">
                            <input type="hidden" id="acao13" name="nome-turma" value="<?= $_POST['nome-turma']?>">

                        </form>
                        <h3><?php echo "Avaliações de " . $_POST['disciNome'] ?></h3>
                        <hr>
                        <div class="text-center"><?php SistemMessage(); ?></div>

                        <?php
                        $avalia =lista_avaliacoes_por_aluno ($_POST['disciId'],$_POST['idTurma'] ,$_POST['matricula']);


                        $i = 0;


                        if ($avalia['resposta'] == false) {
                            echo "<br /><i>Não foram encontradas avaliacoes para esta disciplina </i>";
                        } else {

                        while ($i < $avalia['size-avaliacoes']) {
                        ?>
                            <?php $aluno = pegar_aluno_matricula($avalia['avaliacoes'][$i]['matricula']); ?>
                            <div class="media text-muted pt-3" id="">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="row">
                                        <div class="d-flex justify-content-between align-items-center w-100">

                                            <div class="col">
                                                <strong class="text-gray-dark"><?php echo $avalia['avaliacoes'][$i]['descricao']  ?></strong><br>
                                            </div>
                                            <div class="col">
                                                <strong class="text-gray-dark"><?php echo $avalia['avaliacoes'][$i]['nota']  ?></strong><br>
                                            </div>
                                            <div class="col">
                                                <strong class="text-gray-dark"><?php echo $avalia['avaliacoes'][$i]['data']  ?></strong><br>
                                            </div>
                                            <div class="col">
                                                <strong class="text-gray-dark"><?php echo $avalia['avaliacoes'][$i]['estado']  ?></strong><br>
                                            </div>
                                            <div class="col">
                                                <strong class="text-gray-dark"> <?php if ($avalia['avaliacoes'][$i]['revisar'] == 1) {
                                                                                    echo "corrigida";
                                                                                } else {
                                                                                    echo "falta corrigir";
                                                                                } ?></strong><br>
                                            </div>
                                            <div class="col">
                                                <form class="form" action="" method="post">
                                                    <input type="hidden" id="acao1" name="acao1" value="entregar"> 
                                                    <input type="hidden" id="acao13" name="idTurma" value="<?= $_POST['idTurma']?>">
                                                    <input type="hidden" id="acao13" name="disciId" value="<?= $_POST['disciId']?>">
                                                    <input type="hidden" id="acao13" name="disciNome" value="<?= $_POST['disciNome']?>">
                                                    <input type="hidden" id="acao13" name="matricula" value="<?= $_POST['matricula']?>">
                                                    <input type="hidden" id="acao13" name="id" value="<?= $avalia['avaliacoes'][$i]['id']?>">
                                                    <input type="hidden" id="acao13" name="nome-turma" value="<?= $_POST['nome-turma']?>">
                                                    <button class="btn btn-sm btn-primary" type="submit">Confirmar entrega </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php $i++;
                        } } ?>


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