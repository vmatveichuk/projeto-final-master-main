<?php
function itemLista($numero, $titulo, $texto){
?>
    <div class="pl-4 pt-3 pr-3">
        <table>
            <tr>
                <td style="color: #0091FF; font-size: 26px;" valign="top">
                    <?=$numero?>
                </td>
                <td class="pt-1 pl-3"> 
                    <table>
                        <tr>
                            <td style="color: #575656; font-size: 18px;">
                                <b><?=$titulo?></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-1 pb-2">
                                <?=$texto?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
<?php }?>

<?php
function mostrarTutotial(){
    $numeros = array("1º","2º","3º","4º","5º","6º","7º","8º","9º","10º");
    $titulos = array(
        "Instituição",
        "Professores",
        "Alunos",
        "Administradores",
        "Mensalidades",
        "Turmas",
        "Coordenadores",
        "Disciplinas",
        "Perfil",
        "Sair",
        );
    $textos = array(
        "O administrador poderá criar uma instituição com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá criar um professor com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá criar um aluno com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá criar um administrador com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá selecionar o aluno desejado e publicar o boleto para o mesmo.",
        "O administrador poderá criar uma turma com campos para preenchimento, ele também poderá editar estes campos em outro momento.   ",
        "O administrador poderá criar uma turma com campos para preenchimento, ele também poderá editar estes campos em outro momento.  ",
        "O administrador poderá criar um coordenador com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá criar uma disciplina com campos para preenchimento, ele também poderá editar estes campos em outro momento.",
        "O administrador poderá editar seu perfil.",
        "O administrador poderá realizar o logoff em “Sair”"
        );
    $n=0;
    while(sizeof($numeros)>$n){
        itemLista($numeros["$n"], $titulos["$n"], $textos["$n"]);
        $n++;
    }
 }
 function mostrarTutotial2(){
    $numeros = array("1º","2º","3º","4º","5º","6º");
    $titulos = array(
        "Disciplinas",
        "Quadro de Horários",
        "Mensalidade",
        "Ajustes Acadêmicos",
        "Perfil",
        "Sair"
        );
    $textos = array(
        "O aluno poderá visualizar suas disciplinas com suas médias e notas",
        "O aluno poderá verificar suas aulas semanais com as informações necessárias.",
        "O aluno poderá visualizar e baixar seus boletos bancários através do ícone de download.",
        "O aluno poderá editar suas disciplinas para o período que está por vir.",
        "O Aluno poderá editar seu perfil.",
        "O Aluno poderá realizar o logoff em “Sair”"
        );
    $n=0;
    while(sizeof($numeros)>$n){
        itemLista($numeros["$n"], $titulos["$n"], $textos["$n"]);
        $n++;
    }
 }
 function mostrarTutotial3(){
    $numeros = array("1º","2º","3º","4º","5º","6º");
    $titulos = array(
        "Turmas",
        "Quadro de Horários",
        "Envio de Avaliações",
        "Chamada",
        "Perfil",
        "Sair"
    
        );
    $textos = array(
        "O professor poderá selecionar a turma, escolher a disciplina desejada e corrigir a avaliação pendente do aluno.",
        "O professor poderá verificar suas aulas semanais com as informações necessárias.",
        "O professor poderá criar uma avaliação para os alunos, preenchendo os campos necessários.",
        "O professor poderá selecionar a turma e confirmar se o aluno estava presente na aula ou não.",
        "O professor poderá editar seu perfil.",
        "O professor poderá realizar o logoff em “Sair”"
   
        );
    $n=0;
    while(sizeof($numeros)>$n){
        itemLista($numeros["$n"], $titulos["$n"], $textos["$n"]);
        $n++;
    }
 }
 ?>