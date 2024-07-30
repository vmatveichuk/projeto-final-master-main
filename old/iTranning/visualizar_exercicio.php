<?php
require 'main_topo.php';

$ex = new Exercicio();
$ex->idexercicio = $_GET['i'];

$exercicio = $ex->consultarDadosExercicio();



?>


<div class="form-group">
    <label for="exampleInputEmail1">Nome</label>
    <input type="text" class="form-control" name="exercicioNome" id="exercicioNome" value="<?= $exercicio['nome'] ?>" disabled>
</div>

<div style="width: 500px;">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="<?= $exercicio['urlvideo'] ?>" allowfullscreen></iframe>
    </div>
</div>

<br/><br/><br/>

<div class="card">
    <div class="card-header">
        Instruções
    </div>
    <div>
        <?= $exercicio['instrucoes'] ?>
    </div>
</div>

<?php
require 'main_bottom.php';
?>