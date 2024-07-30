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
$activity = "professores-painel";
preInitializeLogVariables($activity, $_SESSION['id']);
insertLog();
posInitializeLogVariables();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");

include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-avaliacoes.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-disciplinas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-periodo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-aula.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");

$instituicao = visualizar_instituicao_id('1');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Painel</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/fixed-navbar.css">
    <link rel="stylesheet" type="text/css" href="/sx/common/styles/sidebar.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <?php sidebar_aluno("painel"); ?>
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <?php topbar("aluno"); ?>
                <div class="pt-5 pl-4">
                    <h4>Informações gerais</h4>
                    <br />
                    <hr>
                    <?php
                    // echo '<pre>';
                    // var_dump($_SESSION);
                    // echo '</pre>';
                    // exit;
                    ?>
                </div>
                <div id='conteudo-pagina' Class="">
                    <div class="text-center container mr-3"><?php SistemMessage(); ?></div>
                    <div class="pl-4 mr-3" style="color: #575656">
                        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Avaliações sem correção
                                        <br />
                                        <?php
                                        $registro = $_SESSION['registro'];
                                        $registros = $registro['registros'];
                                        $i = 0;
                                        $aluno = visualizar_aluno_id2($_SESSION['id']);
                                        $numero_sem_correcao_t = 0;
                                        while ($i < $registro['size-registros']) {
                                            $numero_sem_correcao = quantidade_avaliacoes_sem_correcao_aluno($aluno['matricula']);
                                            $numero_sem_correcao_t = $numero_sem_correcao_t + $numero_sem_correcao;
                                            $i++;
                                        }
                                        if ($numero_sem_correcao_t == 0) {
                                            echo '<span style="font-size: 32px; color:#00cc66">';
                                        } else {
                                            echo '<span style="font-size: 32px; color:#ff5050">';
                                        }
                                        ?>
                                        <?= $numero_sem_correcao_t ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Média das avaliações
                                        <br />
                                        <span style="font-size: 32px; color: #00cc66">
                                            <?php
                                            $i = 0;
                                            $y = 0;
                                            $media_t = 0;
                                            while ($i < $registro['size-registros']) {
                                                $media = media_geral_avaliacoes_aluno($aluno['matricula']);
                                                if ($media['resposta'] == true) {
                                                    $media_t =  $media_t + $media['media-geral'];
                                                    $y++;
                                                }
                                                $i++;
                                            }
                                            if ($y > '0') {
                                                $media_t = $media_t / $y;
                                            } else {
                                                $media_t = 0;
                                            }
                                            $media_t = number_format($media_t, 2, '.', '');
                                            ?>
                                            <span style="font-size: 32px; color:#00cc66">
                                                <?= $media_t ?>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Avaliacoes corrigidas
                                        <br />
                                        <?php
                                        $registro = $_SESSION['registro'];
                                        $registros = $registro['registros'];
                                        $i = 0;
                                        $numero_sem_correcao_t = 0;
                                        while ($i < $registro['size-registros']) {
                                            $numero_sem_correcao = quantidade_avaliacoes_corrigidas_aluno($aluno['matricula']);;
                                            $numero_sem_correcao_t = $numero_sem_correcao_t + $numero_sem_correcao;
                                            $i++;
                                        }
                                        ?>
                                        <span style="font-size: 32px; color:#00cc66">
                                            <?= $numero_sem_correcao_t ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de disciplinas
                                        <br />
                                        <?php
                                        $disciplinas = lista_de_disciplinas_turma($aluno['turma_id']);
                                        $a = array();
                                        for ($i = 0; $i < sizeof($disciplinas['disci']); $i++) {
                                            if ($disciplinas['disci'][$i] != 0 && $disciplinas['disci'][$i] != null) {
                                                array_push($a, $disciplinas['disci'][$i]);
                                            }
                                        }

                                        //var_dump($aluno);

                                        //var_dump($result);
                                        ?>
                                        <span style="font-size: 32px; color:#00cc66">
                                            <?php echo sizeof($a); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 pb-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        Quantidade de aulas
                                        <br />
                                        <span style="font-size: 32px; color: #00cc66">
                                            <?php
                                            $aulas = aula_por_turmaID($aluno['turma_id']);
                                            echo $aulas['size-aula'];
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- ---------------- -->
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