<?php
require 'main_topo.php';

$treino = new Treino();
$ultimosTreinos = $treino->consultarUltimosTreinos();

$avaliacaoFisica = new EstadoFisico();
$avaliacaoFisica->usuario = $_SESSION['user']['idusuario'];
$estadoFisico = $avaliacaoFisica->consultarEstadoFisicoAtleta();
?>

<?php
if ($_SESSION['user']['idtipo'] == 1) :
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <!--<div class="btn-group mr-2">
                                                                                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                                                                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                                                                            </div>
                                                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                                                                <span data-feather="calendar"></span>
                                                                                This week
                                                                            </button>-->
        </div>
    </div>



    <h2>Ultimos treinos</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nome do Treino</th>
                    <th>Iniciado em</th>
                    <th>Concluido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ultimosTreinos as $treino) {
                    echo "<tr>";
                    echo "<td>{$treino['nome']}</td>";
                    echo "<td>" . date('d/m/Y', strtotime($treino['momento_inicio'])) . "</td>";
                    $concluido = ($treino['concluido'] == 1) ? 'Sim' : 'Não';
                    echo "<td>" . $concluido . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <h2>Avaliações Físicas</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nome Avaliação</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($estadoFisico as $avaliacao) {
                    echo "<tr>";
                    echo "<td>{$avaliacao['nome_avaliacao']}</td>";
                    echo "<td>" . $avaliacao['valor_avaliacao'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
endif;
?>

<?php
if ($_SESSION['user']['idtipo'] == 2) :
    ?>
    <h1 class="h2">Treinos de Atletas Finalizados</h1>
    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
<?php
endif;
?>


<?php
if ($_SESSION['user']['idtipo'] == 3) :
    ?>
    <h1>Médico</h1>
<?php
endif;
?>


<?php
require 'main_bottom.php';
?>