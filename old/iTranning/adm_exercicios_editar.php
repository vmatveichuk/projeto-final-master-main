<?php
require 'main_topo.php';

$ex = new Exercicio();
$ex->idexercicio = $_GET['i'];

if (!empty($_POST)) {
    exibirMesangem($ex->editarExercico());
}


$exercicio = $ex->consultarDadosExercicio();



?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Exercicios</h1>
</div>


<form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Nome</label>
        <input type="text" class="form-control" name="exercicioNome" id="exercicioNome" value="<?= $exercicio['nome'] ?>" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">URL Video</label>
        <input type="text" class="form-control" name="exercicioUrl" id="exercicioUrl" value="<?= $exercicio['urlvideo'] ?>" required>
    </div>

    <div style="width: 500px;">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?= $exercicio['urlvideo'] ?>" allowfullscreen></iframe>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Instruções</label>
        <textarea class="form-control" name="exercicioInstru" id="exercicioInstru">
        <?= $exercicio['instrucoes'] ?>
        </textarea>
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
</form>

<?php
require 'main_bottom.php';
?>