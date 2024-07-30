<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");



function lista_cursos($nome)
{
    $sql = "
        SELECT * FROM `curso` WHERE `nome` LIKE '%$nome%' or `id` LIKE '%$nome%' ORDER BY `curso`.`nome` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $cursos[$i] = array(
            "id" => $row['id'],
            "nome" => $row['nome'],
            "turma_id" => $row['turma-id'],
            "periodo" => $row['periodo']

        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de cursos.",
            "cursos" => $cursos,
            "size-cursos" => sizeof($cursos),
        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem cursos cadastrados.",
        );
    }
}


function pegar_curso_por_turma($id)
{
    $sql = "
        SELECT * FROM `curso` WHERE `id` = '$id';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $cursos[$i] = array(
            "id" => $row['id'],
            "nome" => $row['nome'],
            "turma_id" => $row['turma-id'],
            "periodo" => $row['periodo']

        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de cursos.",
            "cursos" => $cursos,
            "size-cursos" => sizeof($cursos),
        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem cursos cadastrados.",
        );
    }
}
function novo_curso( $nome)
{
    $sql = "
        INSERT INTO `curso` (`nome`) VALUES ('$nome');
        ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $message = 'curso registrado com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao inserir curso.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}

function deletar_curso($id)
{
    deletar_periodo_curso_id($id);
    $sql = "
            DELETE FROM `curso` WHERE `id` = '$id' 
            ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Curso excluído.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao excluir o curso';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}

function atualizar_curso($nome,$id)
{
    $sql = "
        UPDATE `curso` SET 
        `nome` = '$nome' 
        WHERE `id` = '$id';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Curso atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function quantidade_cursos(){
    $sql = "
    SELECT * FROM `curso`;
    ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con,$sql);
    return mysqli_num_rows($query);
}
