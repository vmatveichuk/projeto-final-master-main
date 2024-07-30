<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");


function atualizar_ajuste( $disci1,$disci2, $disci3, $disci4, $disci5, $disci6, $alunoid)
{
    $sql = "
        UPDATE `ajuste` SET 
        `Disciplina-id1` = '$disci1' , `Disciplina-id2` = '$disci2' ,`Disciplina-id3` = '$disci3' , `Disciplina-id4` = '$disci4' , `Disciplina-id5` = '$disci5' , `Disciplina-id6` = '$disci6'
        WHERE `aluno-id` = '$alunoid';
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Disciplinas atualizada';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        //não localizado
        return false;
    }
}
function Insert_ajuste($disci1,$disci2, $disci3, $disci4, $disci5, $disci6, $alunoid)
{
    $sql = "
        INSERT INTO `ajuste` (`aluno-id`, `Disciplina-id1` , `Disciplina-id2` , `Disciplina-id3` , `Disciplina-id4` ,  `Disciplina-id5`  , `Disciplina-id6`) VALUES ('$alunoid', '$disci1','$disci2','$disci3','$disci4','$disci5','$disci6');
        ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $message = 'Ajuste registrado com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao inserir ajuste.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}
function selecionar_ajuste($alunoid){
    $sql = "
    SELECT * FROM `ajuste` WHERE `aluno-id`=$alunoid;
    ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con,$sql);
    $row= mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        //localizado
        return true;
    } else {
        //não localizado
        return false;
    }   
}
function ajuste_disciplinas($alunoid)
{
    $sql = "
        SELECT * FROM `ajuste` WHERE `aluno-id`=$alunoid;
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
            "disci" => $disciplinas

        );
    } else {
        //não existem alunos
        return array(
            "resposta" => false,
            "resposta_message" => "não existem disciplinas cadastrados.",
        );
    }
}

?>