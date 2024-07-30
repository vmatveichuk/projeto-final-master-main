<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");


function aula_por_turmaID($turma_id)
{
    $sql = "
        SELECT * FROM `aula` WHERE `turma_id` = '$turma_id'   ORDER BY `aula-id` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $aulas[$i] = array(
            "id" => $row['aula-id'],
            "nome" => $row['aula-nome'],
        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem avaliacoes cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de aulas.",
            "aulas" => $aulas,
            "size-aula" => sizeof($aulas),
        );
    } else {
        //não existem avaliacoes
        return array(
            "resposta" => false,
            "resposta_message" => "não existem avaliacoes cadastrados.",
        );
    }
}
function aula_por_dia_aluno($dia,$user_id)
{
    $sql = "
        SELECT * FROM `aula` WHERE `dia` = '$dia' AND `turma_id` = '$user_id' ORDER BY `horario-inicial` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $aulas[$i] = array(
            "id" => $row['aula-id'],
            "nome" => $row['aula-nome'],
            "disciplina_id" => $row['disciplina_id'],
            "turma-id" => $row['turma_id'],
            "inicial" => $row['horario-inicial'],
            "termino" => $row['horario-termino']

        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem avaliacoes cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de aulas.",
            "aulas" => $aulas,
            "size-aula" => sizeof($aulas),
        );
    } else {
        //não existem avaliacoes
        return array(
            "resposta" => false,
            "resposta_message" => "não existem avaliacoes cadastrados.",
        );
    }
}

function aula_por_dia_professor($dia,$prof_id)
{
    $sql = "
        SELECT * FROM `aula` WHERE `dia` = '$dia' AND `prof_id` = '$prof_id' ORDER BY `horario-inicial` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $aulas[$i] = array(
            "id" => $row['aula-id'],
            "nome" => $row['aula-nome'],
            "disciplina_id" => $row['disciplina_id'],
            "turma-id" => $row['turma_id'],
            "inicial" => $row['horario-inicial'],
            "termino" => $row['horario-termino']

        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem avaliacoes cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de aulas.",
            "aulas" => $aulas,
            "size-aula" => sizeof($aulas),
        );
    } else {
        //não existem avaliacoes
        return array(
            "resposta" => false,
            "resposta_message" => "não existem avaliacoes cadastrados.",
        );
    }
}
