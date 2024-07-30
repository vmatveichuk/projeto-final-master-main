<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-administradores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
function topbar($sessao){
     
    ?>
    <header class="pl-4" style="padding-top: 30px">
        <div class="row" style=" margin-right: 0px;  margin-left: 0px;">
            <div calss="col-">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <img src="/sx/common/assets/menu-icon.svg" width="16" height="16" class="" alt="">
                </button>
            </div>
            <?php 
            if (($_SESSION['professor'] == true) and ($_SESSION['administrador'] == true) and ($_SESSION['aluno']==true)){?>
            <div calss="col-">
                <span class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($sessao == "administracao"){echo "Administração";}if($sessao == "aluno"){echo "Aluno";}else{echo "Professores";} ?>
                </span>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../administracao/painel">Administração</a>
                    <a class="dropdown-item" href="../professores/painel">Professores</a>
                    <a class="dropdown-item" href="../aluno/painel">Aluno</a>
                </div>
            </div>
            <?php
            }else{
            echo '<div calss="col-"><div class="pl-2 pt-2">';
                if($sessao == "administracao"){
                    echo "Administração";
                }if($sessao == "aluno"){
                    echo "aluno";
                }else{
                    echo "Professores";
                } 
            echo '</div></div>';
            }?>
        </div>
    </header>
<?php } ?>
