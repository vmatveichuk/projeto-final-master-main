<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
function verifica_turma_id($id)
{
    $sql = "
        SELECT * FROM `turma` WHERE `id`=$id;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        //localizado
        return true;
    } else {
        //não localizado
        return false;
    }
}
function pegar_turmas_aluno($id)
{
    $sql = "
        SELECT * FROM `turma` WHERE `id`=$id;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        return array(
            "resposta" => true,
            "resposta_message" => "TurmasNome",
            "nome" => $row['nome'],
            "id_disci" => $row['Disciplina-id']
        );
    } else {
        //não localizado
        return false;
    }
}
function buscar_disciplinas_turma($id)
{
    $sql = "
        SELECT * FROM `turma` WHERE `id`='$id';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        return array(
            0 => $row['Disciplina-id'],
            1 => $row['Disciplina-id2']
        );
    } else {
        //não localizado
        return false;
    }
}
function verifica_turma_nome($nome)
{
    $sql = "
        SELECT * FROM `turma` WHERE `nome`=$nome;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        //localizado
        return true;
    } else {
        //não localizado
        return false;
    }
}
function novo_turmas($nome)
{
    $sql = "
        INSERT INTO `turma` (`id`, `nome`) VALUES (NULL, '$nome');
        ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $message = 'Turma registrada com sucesso.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao inserir turma.';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}
function deletar_turma_periodo($id, $num)
{
    $sql = "
    UPDATE `periodo` SET 
    `turma-id` = '$num'
    WHERE `turma-id` = $id;
            ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
     
        return true;
    } else {
      
        return false;
    }
}
function editarTurmaNome($id, $nome)
{
    if (!verifica_turma_id($id)) {
        $message = 'Essa turma não existe.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
        );
    } else {
        $sql = "
             UPDATE `turma` SET 
             `nome` = '$nome'
             WHERE `id` = $id;
             ";
        $con = openDatabaseConnection();
        if (mysqli_query($con, $sql) === true) {
            $message = 'Nome da turma atualizado com sucesso.';
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
}
function editarTurma($id, $nome, $disci1, $disci2)
{
    if (!verifica_turma_id($id)) {
        $message = 'Essa turma não existe.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
        );
    } else {
        $sql = "
            UPDATE `turma` SET 
            `nome` = '$nome',
            `Disciplina-id` = '$disci1',
            `Disciplina-id2` = '$disci2'
            WHERE `id` = $id;
            ";
        $con = openDatabaseConnection();
        if (mysqli_query($con, $sql) === true) {
            $message = 'Nome da turma atualizado com sucesso.';
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
}
function lista_turmas($nome)
{
    $sql = "
        SELECT * FROM `turma` WHERE `nome` LIKE '%$nome%' ORDER BY `turma`.`nome` ASC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $turmas[$i] = array(
            "id" => $row['id'],
            "nome" => $row['nome']
        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem turmas cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de turmas.",
            "turmas" => $turmas,
            "size-turmas" => sizeof($turmas),
        );
    } else {
        //não existem turmas
        return array(
            "resposta" => false,
            "resposta_message" => "não existem turmas cadastrados.",
        );
    }
}
function deletar_turma_id($id)
{
    deletar_turma_periodo($id, 0);
    $sql = "
                DELETE FROM `turma` WHERE `id` = $id;
                ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        $message = 'Turma excluída';
        $message_type = 'success';
        managerMessage($message, $message_type);
        return true;
    } else {
        $message = 'Erro ao excluir a turma';
        $message_type = 'danger';
        managerMessage($message, $message_type);
        return false;
    }
}
function quantidade_turmas()
{
    $sql = "
        SELECT * FROM `turma`;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    return mysqli_num_rows($query);
}
function turma_professor($id)
{
    $sql = "
        SELECT * FROM `professores` WHERE `turma_id` = $id;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query)) {
        //localizado
        return true;
    } else {
        //não localizado
        return false;
    }
}
function turma_avaliacao($id)
{
    $sql = "
        SELECT * FROM `avaliacao` where `turma_id`= $id;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query)) {
        //localizado
        return true;
    } else {
        //não localizado
        return false;
    }
}
function visualizar_turma_id($id)
{
    $sql = "
        SELECT * FROM `turma` WHERE `id` = '$id';
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query)) {
        //usuário localizado
        return array(
            "resposta" => true,
            "resposta_message" => "Turma encontrado",
            "id" => $row['id'],
            "nome" => $row['nome']
        );
    } else {
        //usuário não localizado
        return array(
            "resposta" => false,
            "resposta_message" => "Turma não encontrado",
        );
    }
}
function visualizar_ultimo_id_turma($nome)
{
    $sql = "
        SELECT * FROM `turma` WHERE `nome` LIKE '%$nome%' ORDER BY `turma`.`id` DESC;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $turmas[$i] = array(
            "id" => $row['id'],
            "nome" => $row['nome']
        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem turmas cadastrados
        return $turmas[0]['id'];
    } else {
        //não existem turmas
        return false;
    }
}
