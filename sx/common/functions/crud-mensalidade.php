<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");


function mensalidade_por_aluno($id)
{
    $sql = "
        SELECT * FROM `mensalidade` WHERE `aluno-id` = '$id'   ORDER BY `boleto-id` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $boletos[$i] = array(
            "mes" => $row['mes'],
            "id" => $row['boleto-id'],
            "aluno" => $row['aluno-id'],
            "status" => $row['status'],
            "valor" => $row['valor']
        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem avaliacoes cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de boletos.",
            "boletos" => $boletos,
            "size" => sizeof($boletos),
        );
    } else {
        //não existem avaliacoes
        return array(
            "resposta" => false,
            "resposta_message" => "não existem avaliacoes cadastrados.",
        );
    }
}

function nova_mensalidade($boletoid, $mes, $valor, $alunoid)
{
    $sql = "
        INSERT INTO `mensalidade` (`boleto-id`, `mes`, `valor`,`aluno-id`) VALUES ('$boletoid', '$mes','$valor','$alunoid');
        ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $message = 'boleto registrado com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao inserir boleto.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}

function editarBoleto($valor, $boletoID)
{
    $sql = "
             UPDATE `mensalidade` SET  
             `valor` = '$valor'
             WHERE `boleto-id` = $boletoID;
             ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Dados do boleto atualizado com sucesso.';
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
function deletarBoleto($id)
{
    $sql = "
            DELETE FROM `mensalidade` WHERE `boleto-id` = $id;
            ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Boleto excluído.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao excluir boleto';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}
