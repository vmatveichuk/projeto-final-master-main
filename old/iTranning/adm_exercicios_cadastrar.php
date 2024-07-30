<?php
require 'main_topo.php';

$ex = new Exercicio();

if (!empty($_POST)) {
    exibirMesangem($ex->cadastrarExercicio());
}


?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Exercicios</h1>
</div>


<form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Nome</label>
        <input type="text" class="form-control" name="exercicioNome" id="exercicioNome" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">URL Video</label>
        <input type="text" class="form-control" name="exercicioUrl" id="exercicioUrl" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Instruções</label>
        <textarea class="form-control" name="exercicioInstru" id="exercicioInstru" required>
        </textarea>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php
require 'main_bottom.php';
?>