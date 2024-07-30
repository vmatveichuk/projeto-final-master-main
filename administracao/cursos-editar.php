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
if (@$_POST['acao1'] == "atualizarDisci") {
    if ($_POST['$i8'] == 0) {
        atualizar_disciPeriodo1($_POST['curso-id'], $_POST['disciplina0'], $_POST['periodo']);
    } else if ($_POST['$i8'] == 1) {
        atualizar_disciPeriodo2($_POST['curso-id'], $_POST['disciplina1'], $_POST['periodo'],);
    } else if ($_POST['$i8'] == 2) {
        atualizar_disciPeriodo3($_POST['curso-id'], $_POST['disciplina2'], $_POST['periodo'],);
    } else if ($_POST['$i8'] == 3) {
        atualizar_disciPeriodo4($_POST['curso-id'], $_POST['disciplina3'], $_POST['periodo'],);
    } else if ($_POST['$i8'] == 4) {
        atualizar_disciPeriodo5($_POST['curso-id'], $_POST['disciplina4'], $_POST['periodo'],);
    } else if ($_POST['$i8'] == 5) {
        atualizar_disciPeriodo6($_POST['curso-id'], $_POST['disciplina5'], $_POST['periodo'],);
    }
}

if (@$_POST['acao2'] == "adicionarPeriodo") {
    novo_periodo($_POST['curso-id'], $_POST['periodo']);
}
if (@$_POST['acao3'] == "deletarPeriodo") {
    deletar_periodo($_POST['curso-id'], $_POST['periodo']);
}
if (@$_POST['acao4'] == "atualizarCurso") {
    atualizar_curso($_POST['nome'],$_POST['curso-id']);
;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editar curso</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_admin('cursos'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <div class="pt-5 pl-4">
                    <h4>Editar curso</h4>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class=" col-lg-16 col-xl-11">
                                <hr>
                                <?php
                                // 0 - tag
                                ?>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/administracao/cursos'">Voltar</button>
                                <div class="form-group pt-4">
                                    <?php $periodos = lista_periodos($_POST['curso-id']);
                                    if ($periodos['resposta'] != false) {
                                        $qt = $periodos['size-periodos'];
                                    } else {
                                        $qt = 0;
                                    } ?>
                                    <label for="nome"><b>Nome: </b></label><br />
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="acao4" value="atualizarCurso">
                                        <input type="hidden" id="acao13" name="curso" value="<?= $_POST['curso'] ?>">
                                        <input type="hidden" id="acao13" name="curso-id" value="<?= $_POST['curso-id']  ?>">
                                        <input type="text" id="registro-id" name="nome" value="<?php if(isset($_POST['nome'])){ echo $_POST['nome'];}else{echo $_POST['curso'];} ?>">
                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px">
                                    </form>
                                    <!-- inprime aqui as disciplinas do professor -->
                                    <hr>
                                    <div class="my-3 p-3 bg-white rounded shadow-sm">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Periodos</h4>
                                            </div>
                                            <div class="col text-right">
                                                <form class="form" action="" method="post">
                                                    <input type="hidden" id="acao1" name="acao2" value="adicionarPeriodo">
                                                    <input type="hidden" id="acao13" name="curso" value="<?= $_POST['curso'] ?>">
                                                    <input type="hidden" id="acao13" name="curso-id" value="<?= $_POST['curso-id']  ?>">
                                                    <input type="int" id="acao13" name="periodo">
                                                    <button calss='btn-light' alt="Submit" width="22px"> + </button>
                                                </form>
                                            </div>
                                        </div>

                                        <?php
                                        $i = 0;
                                        if ($periodos['resposta'] != false) {
                                            while ($i < $periodos['size-periodos']) { ?>
                                                <div class="media text-muted pt-3" id="">
                                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                        <div class="d-flex justify-content-between align-items-center w-100">
                                                            <strong class="text-gray-dark">Periodo:
                                                                <?php
                                                                echo $periodos['periodos'][$i]['Periodo']
                                                                ?>
                                                            </strong>
                                                            <?php $disciplinas = lista_de_disciplinas_periodo($periodos['periodos'][$i]['Periodo'],$_POST['curso-id']);
                                                            $i8 = 0;
                                                            while ($i8 < 6) { ?>
                                                                <div class="row">
                                                                    <form class="form" action="" method="post">
                                                                        <div class="col">
                                                                            Disciplina:<?php $buscaId = $disciplinas['disci'][$i8];
                                                                                        $nome = busca_nome_disciplina($disciplinas['disci'][$i8]);
                                                                                        echo $nome['nome']; ?>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group">
                                                                                <select class="form-control" name="disciplina<?= $i8 ?>">
                                                                                    <option value="<?= 0 ?>">Sem disciplina</option>
                                                                                    <?php
                                                                                    $disciplinas2 = lista_disciplinas('');
                                                                                    $i5 = 0;
                                                                                    while ($i5 < $disciplinas2['size-disciplinas']) {
                                                                                    ?>
                                                                                        <option value="<?= $disciplinas2['disciplinas'][$i5]['id'] ?>"><?= $disciplinas2['disciplinas'][$i5]['nome'] ?></option>
                                                                                    <?php $i5++;
                                                                                    } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col">
                                                                            <input type="hidden" id="acao1" name="acao1" value="atualizarDisci">
                                                                            <input type="hidden" id="acao1" name="$i8" value="<?= $i8 ?>">
                                                                            <input type="hidden" id="acao13" name="curso" value="<?= $_POST['curso'] ?>">
                                                                            <input type="hidden" id="acao13" name="periodo" value="<?= $periodos['periodos'][$i]['Periodo'] ?>">
                                                                            <input type="hidden" id="acao13" name="curso-id" value="<?= $_POST['curso-id']  ?>">
                                                                            <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px">

                                                                    </form>

                                                                </div>


                                                        </div>

                                                    <?php
                                                                $i8++;
                                                            } ?>
                                                    </div>
                                                    <!-- <span class="d-block"><?php echo ucfirst($registros['registros'][$i]['status']); ?></span> -->
                                                </div>
                                    </div>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="acao3" value="deletarPeriodo">
                                        <input type="hidden" id="acao13" name="curso" value="<?= $_POST['curso'] ?>">
                                        <input type="hidden" id="acao13" name="periodo" value="<?= $periodos['periodos'][$i]['Periodo'] ?>">
                                        <input type="hidden" id="acao13" name="curso-id" value="<?= $_POST['curso-id']  ?>">
                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-trash.png" alt="Submit" width="22px">
                                    </form><?php
                                                $i++;
                                            }
                                        } ?>


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
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>