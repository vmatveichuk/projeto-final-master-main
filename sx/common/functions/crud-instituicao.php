<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    function visualizar_instituicao_id($id){
        $sql = "
        SELECT * FROM `instituicaoes` WHERE `id`=$id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Instituição encontrada.",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "faculdade" => $row['faculdade'],
                "cidade" => $row['cidade'],
                "endereco" => $row['endereco'],
                "nome_diretor" => $row['decana'],
                "telefone" => $row['telefone']
            );
        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Insittuição não encontrada.",
            );
        }   
    }
    function editarInstituicao($id, $nome, $cidade, $endereco, $nome_diretor, $telefone){
       $sql = "
        UPDATE `instituicaoes` SET 
        `nome` = '$nome', 
        `cidade` = '$cidade', 
        `endereco` = '$endereco', 
        `decana` = '$nome_diretor', 
        `telefone` = '$telefone' 
        WHERE `instituicaoes`.`id` = $id;
        ";
        $con = openDatabaseConnection();
        if(mysqli_query($con,$sql ) === true){
            $message = 'Dados da instituição atualizados com sucesso.';
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
?>