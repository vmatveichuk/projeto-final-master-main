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
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-mensalidade.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");


$activity = "disciplinas";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
$instituicao = visualizar_instituicao_id('1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-aula.php");


if (@$_POST['acao1'] == 'presenca') {
    presenca_aluno($_POST['id'],1);
}
if (@$_POST['acao1'] == 'falta') {
    presenca_aluno($_POST['id'],0);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Aluno</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_professores('chamada'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("professores"); ?>
                <h4 style="padding: 15px;">
                    <div class="" style="width: 10%; min-width: 320px;">
                        <form class="form" action="" method="post">
                            <select class="form-control" name="aluno">
                                <option value="<?php if (isset($_POST['aluno'])) {
                                                    echo $_POST['aluno'];
                                                } else {
                                                    echo " ";
                                                } ?>"><?php if (isset($_POST['aluno'])) {
                                                            $aluno = visualizar_turma_id($_POST['aluno']);
                                                            echo $aluno['nome'];
                                                        } else {
                                                            echo " ";
                                                        } ?></option>
                                <?php
                                $turmas = buscar_turmas_professor($_SESSION['id']);
                                $i = 0;
                                while ($i < sizeof($turmas)) {
                                    $turma = visualizar_turma_id($turmas[$i]);
                                    if ($turma['nome'] != false && $turmas[$i]!=@$_POST['aluno']) {
                                ?>
                                        <option value="<?= $turmas[$i] ?>"><?= $turma['nome'] ?></option>
                                <?php }
                                    $i++;
                                } ?>
                            </select>
                            <button class="btn btn-sm btn-primary btn-block" type="submit">Selecionar</button>
                        </form>
                    </div>
                    <div class="text-center"><?php SistemMessage(); ?></div>
                </h4>
                <table class="table table-striped">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Matricula</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Nome</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Presença</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;"></th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;"></th>
                        </tr>
                        <?php
                        if (isset($_POST['aluno'])) {
                            $ID = $_POST['aluno'];
                        } else {
                            $ID = $turmas[0];
                        }
                        $alunos = aluno_da_turma ($ID);


                        if ($alunos['resposta'] == false) {
                            echo "Não existem boletos para este aluno";
                        } else {
                            $i1 = 0;

                            while ($i1 < $alunos['size-alunos']) {



                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $alunos['alunos'][$i1]['matricula'] ?></td>
                                    <td style="text-align: center;"><?php echo  $alunos['alunos'][$i1]['nome'] ?></td>
                                    <td style="text-align: center;"><?php if($alunos['alunos'][$i1]['presenca']==1){echo 'presente';}else{ echo 'faltou';} ?></td>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="id" value="<?= $alunos['alunos'][$i1]['id'] ?>">
                                        <input type="hidden" id="acao1" name="aluno" value="<?= $ID ?>">
                                        <input type="hidden" id="acao1" name="acao1" value="presenca">
                                        <td style="text-align: center;">
                                        <button class="btn btn-sm btn-primary btn-block" style="width: 50%;" type="submit">Confirmar presença</button>
                                        </td>
                                    </form>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="id" value="<?= $alunos['alunos'][$i1]['id'] ?>">
                                        <input type="hidden" id="acao1" name="aluno" value="<?= $ID ?>">
                                        <input type="hidden" id="acao1" name="acao1" value="falta">
                                        <td style="text-align: center;">
                                        <button class="btn btn-sm btn-danger btn-block" style="width: 50%;" type="submit">Confirmar falta</button>
                                        </td>
                                    </form>
                                </tr>

                        <?php $i1++;
                            }
                        } ?>
                    </tbody>
                </table>

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