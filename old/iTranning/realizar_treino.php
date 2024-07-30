<?php
require 'main_topo.php';

$treino = new Treino();
$treino->usuario = $_SESSION['user']['idusuario'];
$treinosCon = $treino->consultarTreinosAluno();

$treinoIniciado = $treino->consultarTreinoIniciado();

if (empty($treinoIniciado)) {
    $controleTreinoIniciado  = false;
    $controleAvaliacoes = false;

    if ($_POST['idTreino'] == 'Selecione o Treino') {
        $retorno['status'] = 'error';
        $retorno['mensagem'] = 'Treino não selecionado';
        exibirMesangem($retorno);
    } else {
        if ($_POST['actionButon'] == 'go_consultar') {
            $controleTreinoIniciado = true;
            $treino->treino = addslashes($_POST['idTreino']);
            $treino->iniciarTreino();
            $exerciciosTreino = $treino->consultarExerciciosTreino();

            foreach ($exerciciosTreino as $exercicio) {
                $treino->cadastrarExercicioTreino($exercicio['idexercicio'], $exercicio['qnt_repeticoes'], $exercicio['repeticoes']);
            }

            $exerciciosTreino = $treino->consultarExerciciosRealizando();
        }
    }
} else {
    $controleTreinoIniciado = true;
    $controleAvaliacoes = false;
    $treino->treinoIniciado = addslashes($treinoIniciado['idti']);

    if ($_POST['actionButon'] == 'go_marcar_realizar') {
        $treino->marcarExercicioRealizado($_POST['idExercico']);
    }

    if ($_POST['actionButon'] == 'go_finalizar_treino') {
        $exerciciosNaoRealizado = $treino->consultarExerciciosNaoRealizado();

        if (empty($exerciciosNaoRealizado)) {
            $treino->deletarExerciciosRealizando();
            $treino->finalizarTreino();

            $controleTreinoIniciado = false;
            $controleAvaliacoes = true;

            $retorno['status'] = 'success';
            $retorno['mensagem'] = 'Treino finalizado';
            exibirMesangem($retorno);
        } else {
            $retorno['status'] = 'error';
            $retorno['mensagem'] = 'Existe exercicios não realizados';
            exibirMesangem($retorno);
        }
    }

    $exerciciosTreino = $treino->consultarExerciciosRealizando();
}
?>

<style>
    .estrelas {
        margin-left: 5px;
    }

    .estrelas input[type=radio] {
        display: none;
    }

    .estrelas label i.fa:before {
        content: '\f005';
        color: #FC0;
    }

    .estrelas input[type=radio]:checked~label i.fa:before {
        color: #CCC;
    }


    .coracoes {
        margin-left: 5px;
    }

    .coracoes input[type=radio] {
        display: none;
    }

    .coracoes label i.fa:before {
        content: '\f004';
        color: #ff0040;
    }

    .coracoes input[type=radio]:checked~label i.fa:before {
        color: #CCC;
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Realizar treino</h1>
</div>

<?php
if ($controleAvaliacoes) :
    ?>
    <div class="card">
        <div class="card-body" style="display: grid;">
            <h5 class="card-title">Avaliações do Treino</h5>

            <form method="POST">
                <div>
                    <p class="card-text">Instruções exercicio</p>
                    <div class="estrelas">
                        <input type="radio" id="cm_star-empty" name="fb" value="" checked />
                        <label for="cm_star-1"><i class="fa"></i></label>
                        <input type="radio" id="cm_star-1" name="fb" value="1" />
                        <label for="cm_star-2"><i class="fa"></i></label>
                        <input type="radio" id="cm_star-2" name="fb" value="2" />
                        <label for="cm_star-3"><i class="fa"></i></label>
                        <input type="radio" id="cm_star-3" name="fb" value="3" />
                        <label for="cm_star-4"><i class="fa"></i></label>
                        <input type="radio" id="cm_star-4" name="fb" value="4" />
                        <label for="cm_star-5"><i class="fa"></i></label>
                        <input type="radio" id="cm_star-5" name="fb" value="5" />
                    </div>
                </div>

                <div>
                    <p class="card-text">Estado físico</p>
                    <div class="coracoes">
                        <input type="radio" id="cm_cor-empty" name="cor" value="" checked />
                        <label for="cm_cor-1"><i class="fa"></i></label>
                        <input type="radio" id="cm_cor-1" name="cor" value="1" />
                        <label for="cm_cor-2"><i class="fa"></i></label>
                        <input type="radio" id="cm_cor-2" name="cor" value="2" />
                        <label for="cm_cor-3"><i class="fa"></i></label>
                        <input type="radio" id="cm_cor-3" name="cor" value="3" />
                        <label for="cm_cor-4"><i class="fa"></i></label>
                        <input type="radio" id="cm_cor-4" name="cor" value="4" />
                        <label for="cm_cor-5"><i class="fa"></i></label>
                        <input type="radio" id="cm_cor-5" name="cor" value="5" />
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Enviar</button>
            </form>
        </div>
    </div>
<?php
exit();
endif;
?>
<?php
if ($controleTreinoIniciado == false) :
    ?>
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
                        <button class="btn btn-success" type="submit" value="go_consultar" name="actionButon">Inciar Treino</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

<?php
endif;
?>

<?php
if ($controleTreinoIniciado == true) :
    ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $treinoIniciado['nometreino'] ?></h5>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome Exercicio</th>
                        <th scope="col">Repeticoes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($exerciciosTreino  as $exTreino) {
                        echo "<tr>";
                        echo "<td><a href='visualizar_exercicio.php?i={$exTreino['idexercicio']}' >{$exTreino['nome_exercicio']}</a></td>";
                        echo "<td>{$exTreino['qnt_repeticoes']} x {$exTreino['repeticoes']}</td>";
                        echo "<td>" . (($exTreino['concluido'] == false) ?  "<form method='POST'><input type='hidden' name='idExercico' value=' {$exTreino['idexercicio']}' /><button type='submit' name='actionButon' value='go_marcar_realizar' class='btn btn-success'>Marcar Realizado</button></form>"  : 'Exercicio Realizado') . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <form method="POST">
                <button style="float:right" name="actionButon" value="go_finalizar_treino" type="submit" class="btn btn-primary">Finalizar Treino</button>
            </form>
        </div>
    </div>

<?php
endif;
require 'main_bottom.php';
?>