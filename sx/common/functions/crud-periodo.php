<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-cursos.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-turmas.php");



function lista_periodos($curso)
{
    $sql = "
        SELECT * FROM `periodo` WHERE `curso-id` = '$curso'  ORDER BY `periodo`.`Periodo-num` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $periodos[$i] = array(
            "Periodo" => $row['Periodo-num'],
            "id" => $row['id'],
        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de periodos.",
            "periodos" => $periodos,
            "size-periodos" => sizeof($periodos),
        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem periodos cadastrados.",
        );
    }
}



function lista_de_disciplinas_periodo($curso, $cursoid)
{
    $sql = "
        SELECT * FROM `periodo` WHERE `Periodo-num` = '$curso' AND `curso-id` = '$cursoid';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $disciplinas = array(
            0 => $row['Disciplina-id1'],
            1 => $row['Disciplina-id2'],
            2 => $row['Disciplina-id3'],
            3 => $row['Disciplina-id4'],
            4 => $row['Disciplina-id5'],
            5 => $row['Disciplina-id6']

        );
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de disciplinas.",
            "disci" => $disciplinas,
            "size-disci" => sizeof($disciplinas),
        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem disciplinas cadastrados.",
        );
    }
}
function editarPeriodo($id, $periodoid, $cursoid)
{
    deletar_turma_periodo($id, 0);
    $sql = "
         UPDATE `periodo` SET 
         `turma-id` = '$id'      
         WHERE `Periodo-num` = '$periodoid' AND
          `curso-id` = '$cursoid';
         ;
         ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Turma editada com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return array(
            "resposta" => true,
            "resposta_message" => $message
        );
    } else {
        $message = 'Falha ao atualizar, tente novamente.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
        );
    }
}
function lista_de_disciplinas_turma($turmaid)
{
    $sql = "
        SELECT * FROM `periodo` WHERE `turma-id`='$turmaid';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $disciplinas = array(
            0 => $row['Disciplina-id1'],
            1 => $row['Disciplina-id2'],
            2 => $row['Disciplina-id3'],
            3 => $row['Disciplina-id4'],
            4 => $row['Disciplina-id5'],
            5 => $row['Disciplina-id6']

        );
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de disciplinas.",
            "disci" => $disciplinas,
            "size-disci" => sizeof($disciplinas),
        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem disciplinas cadastrados.",
        );
    }
}
function periodo_num($turmaid)
{
    $sql = "
        SELECT * FROM `periodo` WHERE `turma-id` = '$turmaid';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {

        $periodo = array(
            'num' => $row['Periodo-num'],
            'curso' => $row['curso-id']
        );
    }
    if (mysqli_num_rows($query)) {
        //existem alunos cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de disciplinas.",
            "periodo" => $periodo

        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem disciplinas cadastrados.",
        );
    }
}
function atualizar_disciPeriodo1($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id1` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function novo_periodo($cursoid, $periodo)
{
    $sql = "
        INSERT INTO `periodo` (`curso-id`, `Periodo-num`) VALUES ('$cursoid', '$periodo');
        ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $message = 'periodo registrado com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao inserir periodo.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}

function deletar_periodo($id, $periodo)
{
    $sql = "
            DELETE FROM `periodo` WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo'
            ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Periodo excluído.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao excluir o periodo';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}
function deletar_periodo_curso_id($id)
{
    $sql = "
            DELETE FROM `periodo` WHERE `curso-id` = '$id'
            ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        
        return true;
    } else {
      
        return false;
    }
}

function atualizar_disciPeriodo2($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id2` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function atualizar_disciPeriodo3($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id3` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function atualizar_disciPeriodo4($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id4` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function atualizar_disciPeriodo5($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id5` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function atualizar_disciPeriodo6($id, $disci, $periodo)
{
    $sql = "
        UPDATE `periodo` SET 
        `Disciplina-id6` = '$disci' 
        WHERE `curso-id` = '$id' AND `Periodo-num` = '$periodo';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disci atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function quantidade_periodo()
{
    $sql = "
    SELECT * FROM `periodo`;
    ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    return mysqli_num_rows($query);
}
