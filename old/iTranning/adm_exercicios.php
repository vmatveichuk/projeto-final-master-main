<?php
require 'main_topo.php';

$ex = new Exercicio();
$exercicios = $ex->consultarExercicios();

if ($_POST['action'] == 'deletar') {
    $ex->idexercicio = $_POST['idexercicio'];
    exibirMesangem($ex->deletarExercicio());
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Exercicios</h1>
    <a href="adm_exercicios_cadastrar.php"><button class="btn btn-success">Cadastrar</button></a>
</div>



<div class="table-responsive">
    <table id="tableEx" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Situação</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($exercicios as $exercicio) {
                echo "<tr>";
                echo "<td>{$exercicio['idexercicio']}</td>";
                echo "<td>{$exercicio['nome']}</td>";
                echo "<td>{$exercicio['status']}</td>";
                echo "<td><a href='adm_exercicios_editar.php?i={$exercicio['idexercicio']}'><span data-feather='edit'></span></a>  <a href='' class='btn-excluir'  data-toggle='modal' data-target='#exampleModal' data-iddel='{$exercicio['idexercicio']}' ><span data-feather='trash'></span></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Código:</label>
                        <input type="text" class="form-control" name="idexercicio" id="recipient-name" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="action" value="deletar" class="btn btn-success">Deletar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    require 'main_bottom.php';
    ?>

    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('iddel') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Deseja deletar o exercicio ' + recipient + '?')
            modal.find('.modal-body input').val(recipient)
        })
    </script>