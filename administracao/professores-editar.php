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
$activity = "administracao editar professor";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");

$instituicao = visualizar_instituicao_id('1');
//motor php
$gravar = false;
$gravar_admin = false;


if (@$_POST['acao10'] == "deletar") {

    if ($_POST['i'] == 0) {
        deletar_disci1($_POST['prof-id']);
    } else if ($_POST['i'] == 1) {
        deletar_disci2($_POST['prof-id']);
    } else if ($_POST['i'] == 2) {
        deletar_disci3($_POST['prof-id']);
    } else if ($_POST['i'] == 3) {
        deletar_disci4($_POST['prof-id']);
    }
}
if (@$_POST['acao1'] == "deletar") {

    if ($_POST['i'] == 0) {
        deletar_turma_id1($_POST['registro-id']);
        deletar_disci1($_POST['prof-id']);
    } else if ($_POST['i'] == 1) {
        deletar_turma_id2($_POST['registro-id']);
        deletar_disci2($_POST['prof-id']);
    } else if ($_POST['i'] == 2) {
        deletar_turma_id3($_POST['registro-id']);
        deletar_disci3($_POST['prof-id']);
    } else if ($_POST['i'] == 3) {
        deletar_turma_id4($_POST['registro-id']);
        deletar_disci4($_POST['prof-id']);
    }
}


$professor = visualizar_professor_id(@$_POST['id']);
if ($professor['resposta'] == false) {
    header("Location: /administracao/professores");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editar professor</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('professores'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">
                    <h4>Informações do professor</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class=" col-lg-9 col-xl-7">
                                <hr>
                                <?php
                                // 0 - tag
                                $professor = visualizar_professor_id(@$_POST['id']);
                                $ususariod = visualizar_usuario_id($professor['user_id']);
                                ?>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/professores'">Voltar</button>
                                <div class="form-group pt-4">
                                    <label for="nome"><b>Nome: </b></label> <?= @$ususariod['nome'] ?><br />
                                    <label for="nome"><b>CPF: </b></label> <?= @$ususariod['cpf'] ?><br />
                                    <label for="nome"><b>Email: </b></label> <?= @$ususariod['email'] ?><br />
                                    <label for="id"><b>Código do professor: </b></label> <?= $professor['user_id'] ?><br />
                                    <label for="id"><b>Disciplinas: </b></label> <?php
                                                                                    $i3 = 0;
                                                                                    $disciP = buscar_disciplinas_professor($professor['user_id']);
                                                                                    while ($i3 < sizeof($disciP)) {
                                                                                        if (isset($disciP[$i3])) {
                                                                                            $nome = busca_nome_disciplina($disciP[$i3]);
                                                                                            echo "-" . $nome['nome'];
                                                                                        }
                                                                                        $i3++;
                                                                                    }


                                                                                    ?>
                                </div>
                                <!-- inprime aqui as disciplinas do professor -->
                                <hr>
                                <h4>turmas e disciplinas do professor</h4>
                                <div class="my-3 p-3 bg-white rounded shadow-sm">
                                    <?php
                                    $turmas = buscar_turmas_professor($ususariod['id']);
                                    $i = 0;
                                    if ($turmas != false) {
                                        $disciplinas = buscar_disciplinas_professor($professor['user_id']);
                                        while ($i < sizeof($turmas)) { ?>
                                            <div class="media text-muted pt-3" id="">
                                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                    <div class="d-flex justify-content-between align-items-center w-100">
                                                        <strong class="text-gray-dark">Turma:
                                                            <?php
                                                            $info_turma = visualizar_turma_id($turmas[$i]);
                                                            if ($info_turma['resposta'] != false) {
                                                                echo $info_turma['nome'];
                                                            }
                                                            ?>
                                                        </strong>
                                                        <form class="form" action="/administracao/professores-editarII" method="post">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="turma">
                                                                            <?php
                                                                            $turmas2 = lista_turmas('');
                                                                            $i4 = 0;
                                                                            while ($i4 < $turmas2['size-turmas']) {
                                                                            ?>
                                                                                <option value="<?= $turmas2['turmas'][$i4]['id'] ?>"><?= $turmas2['turmas'][$i4]['nome'] ?></option>
                                                                            <?php $i4++;
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <?php
                                                                    if ($turmas[$i] != 0) {
                                                                        $periodo = periodo_num($turmas[$i]);
                                                                        if ($periodo['resposta'] != false) {
                                                                            echo '<strong class="text-gray-dark">Periodo:' . $periodo['periodo']['num'] . '</strong>';
                                                                        }
                                                                    } ?>
                                                                </div>
                                                                <div class="col">
                                                                    <?php
                                                                    if ($disciplinas[$i] != null) {
                                                                        $nome = busca_nome_disciplina($disciplinas[$i]);
                                                                        if ($nome['nome'] != null) {
                                                                            echo '<strong class="text-gray-dark">Disciplina:' . $nome['nome'] . '</strong>';
                                                                        }
                                                                    } ?>
                                                                </div>
                                                                <div class="col">
                                                                    <input type="hidden" id="acao1" name="acao5" value="atualizarTurma">
                                                                    <input type="hidden" id="registro-id" name="i" value="<?= $i ?>">
                                                                    <input type="hidden" id="registro-id" name="tag" value="<?= 2 ?>">
                                                                    <input type="hidden" id="registro-id" name="id" value="<?= $professor['user_id'] ?>">
                                                                    <input type="hidden" id="registro-id" name="prof-id" value="<?= $professor['user_id'] ?>">
                                                                    <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px">
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form class="form" action="" method="post">
                                                            <input type="hidden" id="acao1" name="acao1" value="deletar">
                                                            <input type="hidden" id="registro-id" name="registro-id" value="<?= $professor['user_id'] ?>">
                                                            <input type="hidden" id="registro-id" name="prof-id" value="<?= $professor['user_id']  ?>">
                                                            <input type="hidden" id="id" name="i" value="<?= $i ?>">
                                                            <input type="hidden" id="id" name="id" value="<?= $_POST['id'] ?>">
                                                            <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-trash.png" alt="Submit" width="22px">
                                                        </form>
                                                    </div>
                                                    <!-- <span class="d-block"><?php echo ucfirst($registros['registros'][$i]['status']); ?></span> -->
                                                </div>
                                            </div>
                                    <?php
                                            $i++;
                                        }
                                    } ?>
                                </div>

                                <?php
                                if (@$_POST['tag'] == 1) {
                                ?>
                                    <div class="form-group pt-4">
                                        <label for="nome"><b>Nome: </b></label> <?= $professor['nome'] ?>
                                    </div>
                                    <div class="form-group pt-1 pb-2">
                                        <label for="id"><b>Código da professor: </b></label> <?= $professor['id'] ?>
                                    </div>
                                    <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-success btn-block btn-sm" onclick="window.location.href='/administracao/professores'">Ver lista</button>
                                        </div>
                                    </div>
                                <?php } ?>
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
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>