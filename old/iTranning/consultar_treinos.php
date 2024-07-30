<?php
require 'main_topo.php';

$treino = new Treino();
$treino->usuario = $_SESSION['user']['idusuario'];
$treinosCon = $treino->consultarTreinosAluno();


if ($_POST['idTreino'] == 'Selecione o Treino') { 
    $retorno['status'] = 'error';
    $retorno['mensagem'] = 'Treino não selecionado';
    exibirMesangem($retorno);
} else {
    if ($_POST['actionButon'] == 'go_consultar') {
        $treino->treino = addslashes($_POST['idTreino']);
        $exerciciosTreino = $treino->consultarExerciciosTreino();
    }
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar Treinos</h1>
</div>


<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Selecione Treino</label>
                        <select class="form-control" name="idTreino">
                            <option>Selecione o Treino</option>
                            <?php
                            foreach ($treinosCon as $treino) {
                                $checked = ($treino['idtreino'] == $_POST['idTreino']) ? 'selected' : '';
                                echo "<option value='{$treino['idtreino']}' {$checked} >{$treino['nometreino']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-6" style="margin-top:30px">
                    <button class="btn btn-success" type="submit" value="go_consultar" name="actionButon">Consultar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nome Exercicio</th>
            <th scope="col">Repeticoes</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($exerciciosTreino)) {
            foreach ($exerciciosTreino  as $exTreino) {
                echo "<tr>";
                echo "<td><a href='visualizar_exercicio.php?i={$exTreino['idexercicio']}' >{$exTreino['nome_exercicio']}</a></td>";
                echo "<td>{$exTreino['qnt_repeticoes']} x {$exTreino['repeticoes']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan='2' >Sem exercicios</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>



<?php
require 'main_bottom.php';
?>