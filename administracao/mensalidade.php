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


if(@$_POST['acao1']=='editar'){
    editarBoleto($_POST['valor'],$_POST['id']);
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
            <?php sidebar_admin('mensalidades'); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("administracao"); ?>
                <h4 style="padding: 15px;">
                    <div class="" style="width: 10%; min-width: 320px;">
                        <form class="form" action="" method="post">
                            <select class="form-control" name="aluno">
                                <option value="<?php if (isset($_POST['aluno'])) {
                                                    echo $_POST['aluno'];
                                                } else {
                                                    echo " ";
                                                } ?>"><?php if (isset($_POST['aluno'])) {
                                                                                                                                    $aluno = visualizar_aluno_id($_POST['aluno']);
                                                                                                                                    echo $aluno['nome'];
                                                                                                                                } else {
                                                                                                                                    echo " ";
                                                                                                                                } ?></option>
                                <?php
                                $i = 0;

                                $aluno = lista_alunos("");
                                $i2 = 0;

                                while ($i2 < sizeof($aluno['alunos'])) {
                                    if (isset($aluno['alunos'][$i2]['nome']) && $aluno['alunos'][$i2]['id']!=$_POST['aluno']) {
                                ?>
                                        <option value="<?= $aluno['alunos'][$i2]['id'] ?>"><?= $aluno['alunos'][$i2]['nome'] ?></option>
                                <?php
                                    }
                                    $i2++;
                                }

                                ?>
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
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Download</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Mês/Ano</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Valor</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Status</th>
                            <th scope="col" style="text-align: center;background-color: #b3e0ff; color: #0091FF;">Editar</th>
                        </tr>
                        <?php
                        if (isset($_POST['aluno'])) {
                            $ID = $_POST['aluno'];
                        } else {
                            $ID = $aluno['alunos'][0]['id'];
                        }
                        $boletos = mensalidade_por_aluno($ID);


                        if ($boletos['resposta'] == false) {
                            echo "Não existem boletos para este aluno";
                        } else {
                            $i1 = 0;

                            while ($i1 < $boletos['size']) {



                        ?>
                                <tr>
                                    <th style="text-align: center;" scope="row">
                                        <img src="/sx/common/assets/download.png" width="30px" height="30px">
                                    </th>
                                    <td style="text-align: center;"><?php echo $boletos['boletos'][$i1]['mes'] ?></td>
                                    <td style="text-align: center;"><?php echo  $boletos['boletos'][$i1]['valor'] ?></td>
                                    <td style="text-align: center;"><?php echo $boletos['boletos'][$i1]['status'] ?></td>
                                    <form class="form" action="" method="post">
                                        <input type="hidden" id="acao1" name="id" value="<?= $boletos['boletos'][$i1]['id'] ?>">
                                        <input type="hidden" id="acao1" name="aluno" value="<?= $boletos['boletos'][$i1]['aluno'] ?>">
                                        <input type="hidden" id="acao1" name="acao1" value="editar">
                                        <td style="text-align: center;">
                                        <input type="int" id="acao1" name="valor" value="">
                                        <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px"></td>
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