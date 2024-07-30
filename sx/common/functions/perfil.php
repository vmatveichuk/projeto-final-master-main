<?php
function perfileditavel($usuario_id){
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-administradores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
?>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  } 
}
</script>
<div class="pl-4 mr-3">
    <div class="row"  style=" margin-right: 0px;  margin-left: 0px;">
        <div class="col-md-4 col-lg-4 col-xl-3">
            <hr style="">
            <?php
            // var_dump($_SESSION);
                $usuario=visualizar_usuario_id($_SESSION['id']);
            ?>
            <form class="form" action="" method="post">
            <input type="hidden" id="acao1" name="acao" value="editar-usuario">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$usuario["nome"]?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$usuario["email"]?>">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input id="cpf" type="text" size= "14" name="cpf" maxlength="14" value="<?=$usuario['cpf']?>" OnKeyPress="formatar('###.###.###-##', this)" class="form-control">
                </div>
                <div class="form-group">
                    <label style=""><b>Status do usuário: </b> <?=$usuario["status"]?></label>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Salvar alterações</button>
            </form>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-3">
            <hr style="">
            <form class="form" action="" method="post">
            <input type="hidden" id="acao2" name="acao" value="trocar-senha">
                <div class="form-group">
                    <label for="nome">Troca de senha</label>
                    <input type="password" class="form-control" id="password-new1" name="passwordnew1" placeholder="Nova senha">
                    <input type="password" class="form-control" id="password-new2" name="passwordnew2" placeholder="Repetir senha">
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Trocar senha</button>
            </form>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-3 pb-3">
            <hr style="">
            <?php
                echo "<h5>Acessos</h5>";
                if (verifica_admin_id($usuario["id"])){
                    echo "Administrador<br/>";
                }
                if (verifica_professor_id($usuario["id"])){
                    echo "Professor<br/>";
                }
                if (verifica_aluno_id2($usuario["id"])){
                    echo "Aluno<br/>";
                }
            ?>
            <br />
        </div>
    </div>
</div>
<?php }?>