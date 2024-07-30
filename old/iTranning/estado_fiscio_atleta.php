<?php
require 'main_topo.php';

$usuario = new Usuario();
$resultUsuarios = $usuario->listarUsuarios(1, 1);

if ($_POST['idUsuario'] == 'Selecione o Atleta') {
    $retorno['status'] = 'error';
    $retorno['mensagem'] = 'Atleta não selecionado';
    exibirMesangem($retorno);
} else {
    if ($_POST['action'] == 'registar-avaliacao') {
        $estadoFiscio = new EstadoFisico();
        $estadoFiscio->usuario = $_POST['idUsuario'];
        exibirMesangem($estadoFiscio->registarEstadoFisico(addslashes($_POST['avalicao']), addslashes($_POST['valor'])));
    }
    if (!empty($_POST['idUsuario'])) {
        $estadoFiscio = new EstadoFisico();
        $estadoFiscio->usuario = $_POST['idUsuario'];
        //$estadoFiscio->usuario = 3;
        $estadoFiscioCon = $estadoFiscio->consultarEstadoFisicoAtleta();
    }
}



?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Estado Físico Atleta</h1>
</div>


<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Selecione Atleta</label>
                        <select class="form-control" id="idUsuario" name="idUsuario">
                            <option>Selecione o Atleta</option>
                            <?php
                            foreach ($resultUsuarios as $usuario) {
                                $checked = ($usuario['idusuario'] == $_POST['idUsuario']) ? 'selected' : '';
                                echo "<option value='{$usuario['idusuario']}' {$checked} >{$usuario['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-6" style="margin-top:30px">
                    <button class="btn btn-primary" type="submit" value="go_consultar" name="actionButon">Consultar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<br /><br /><br /><br />
<?php
if (!empty($estadoFiscio->usuario)) :
    ?>
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="idUsuario" value="<?= $_POST['idUsuario'] ?>" />
                <label>Inserir Avaliação</label>
                <div class="row">
                    <div class="col-4 form-group">
                        <label>Avaliação</label>
                        <input name="avalicao" class="form-control" required />
                    </div>
                    <div class="col-4 form-group">
                        <label>Valor</label>
                        <input name="valor" class="form-control" required/>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="action" value="registar-avaliacao" style="margin-top:27px" class="btn btn-success">Registrar</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome Avaliação</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($estadoFiscioCon)) {
                foreach ($estadoFiscioCon  as $estadoFisico) {
                    echo "<tr>";
                    echo "<td>{$estadoFisico['nome_avaliacao']}</td>";
                    echo "<td>{$estadoFisico['valor_avaliacao']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='2' >Aguardando Avaliação</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<?php
endif;
require 'main_bottom.php';
?>