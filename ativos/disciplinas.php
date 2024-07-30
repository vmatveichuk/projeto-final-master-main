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
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-usuarios.php");
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

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Professores</title>
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
                <?php

                //deletarBoleto(13);

                //nova_mensalidade(13, 'janeiro', 2000,2222);

                //editarBoleto( 2000, 'pendente',1);

                $turma=aluno_da_turma(4);

                $i2=0;

                while ($i2 < sizeof($turma['alunos'])) {
                    echo $turma['alunos'][$i2]['nome'] . "<br>";
                    $i2++;
                }

                echo "<br>";
                
                $aulas = aula_por_dia_professor('segunda', $_SESSION['id']);

                var_dump($aulas);

                //$resultado = novo_avaliacoes(1,15,1010813, "prova sobre redacao");

                //$resultado=presenca_aluno(48,1);

                //var_dump($resultado);

                //$resultado= confirma_nota_avaliacao(294,100);


                //var_dump($resultado);

                //deletar_avaliacao_id(17);

                $disciP = lista_avaliacoes_por_disciplina(4, 1);
                $i2 = 0;

                while ($i2 < $disciP['size-avaliacoes']) {
                    echo $disciP['avaliacoes'][$i2]['descricao'] . "<br>";
                    $i2++;
                }

                echo "<br>";

                $disciP = buscar_disciplinas_professor($_SESSION['id']);
                $i2 = 0;

                while ($i2 < sizeof($disciP)) {
                    echo $disciP[$i2] . "<br>";
                    $i2++;
                }

                echo "<br>";

                $turmasProfessor = buscar_turmas_professor($_SESSION['id']);
                $i2 = 0;

                while ($i2 < sizeof($turmasProfessor)) {
                    echo $turmasProfessor[$i2] . "<br>";
                    $i2++;
                }

                echo "<br>";

                $DiscipT = buscar_disciplinas_turma($turmasProfessor[0]);

                $i2 = 0;

                while ($i2 < sizeof($DiscipT)) {
                    echo $DiscipT[$i2] . "<br>";
                    $i2++;
                }

                echo "<br>";
                $i1 = 0;
                while ($i1 < sizeof($turmasProfessor)) {
                    $DiscipT = buscar_disciplinas_turma($turmasProfessor[$i1]);
                    $i2 = 0;
                    while ($i2 < sizeof($disciP)) {
                        $i3 = 0;
                        while ($i3 < sizeof($DiscipT)) {
                            if ($disciP[$i2] == $DiscipT[$i3]) {
                                $nome = busca_nome_disciplina($DiscipT[$i3]);
                                echo $nome['nome'] . "<br>";
                            }
                            $i3++;
                        }

                        $i2++;
                    }
                    echo "<br>";
                    $i1++;
                }

                echo "<br>";

                $boletos = mensalidade_por_aluno($_SESSION['id']);


                $i2 = 0;

                while ($i2 < $boletos['size']) {
                    echo $boletos['boletos'][$i2]['mes'] . "<br>";
                    $i2++;
                }
                echo "<br>";

                $aulas = aula_por_turmaID(15);

                $i1 = 0;

                while ($i1 < $aulas['size-aula']) {
                    echo $aulas['aulas'][$i1]['nome'] . "<br>";

                    $i1++;
                }
                echo "<br>";

                $media = media_geral_avaliacoes_turma_disciplina(15, 1);

                echo $media['media-geral'];

                echo "<br>";
                $avalia = lista_avaliacoes_por_aluno(1, 15, 1010813);

                $alunoN=busca_usuario_id('teste');
                var_dump($alunoN);

                $i = 0;

                while ($i < $avalia['size-avaliacoes']) {
                    echo $avalia['avaliacoes'][$i]['descricao'] . "<br>";

                    $i++;
                }

                echo "<br>";

                $turma = pegar_turmas_id($_SESSION['id']);
                $turma1 = pegar_turmas_aluno($turma['Turma1']);


                $disci1 = busca_nome_disciplina($turma1['id_disci']);


                ?>
                <div id='conteudo-pagina' Class=" mr-3 pt-3 pl-4">
                    <div>
                        <h3>Disciplinas</h3>
                        <hr>
                        <?php $disciplinas = lista_disciplinas("") ?>
                        <div class="text-center"><?php SistemMessage(); ?></div>


                    </div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome da disciplina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><?php echo $disci1['nome'] ?></td>
                            </tr>
                        </tbody>
                    </table>
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