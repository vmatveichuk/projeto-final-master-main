<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    function verifica_disciplina_id($id){
        $sql = "
        SELECT * FROM `disciplina` WHERE `id`=$id;
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
    function busca_nome_disciplina($id){
        $sql = "
        SELECT * FROM `disciplina` WHERE `id`=$id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            return array(
                "resposta" => true,
                "nome" => $row['nome']
                );      
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_disciplina_nome($nome){
        $sql = "
        SELECT * FROM `disciplina` WHERE `nome`=$nome;
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
    function novo_disciplinas($nome){
        $sql = "
        INSERT INTO `disciplina` (`id`, `nome`) VALUES (NULL, '$nome');
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)){
            $message = 'disciplina registrada com sucesso.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            $message = 'Erro ao inserir disciplina.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return false;
        }   
    }
    function editardisciplina($id, $nome){
       if(!verifica_disciplina_id($id)){
        $message = 'Essa disciplina não existe.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
            );
       } else {
            $sql = "
            UPDATE `disciplina` SET 
            `nome` = '$nome' 
            WHERE `id` = $id;
            ";
            $con = openDatabaseConnection();
            if(mysqli_query($con,$sql ) === true){
                $message = 'Nome da disciplina atualizado com sucesso.';
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
    function lista_disciplinas($nome){
        $sql = "
        SELECT * FROM `disciplina` WHERE `nome` LIKE '%$nome%' ORDER BY `disciplina`.`nome` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $disciplinas[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem disciplinas cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de disciplinas.",
                "disciplinas" => $disciplinas,
                "size-disciplinas" => sizeof($disciplinas),
            );
        } else {
            //não existem disciplinas
            return array(
                "resposta" => false,
                "resposta_message" => "não existem disciplinas cadastrados.",
            );
        }  
    }
    function deletar_disciplina_id($id){
        if(disciplina_professor($id)){
            $message = 'Para deletar uma disciplina, é necessário remover os <b>professores</b> desta disciplina.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return false;
        } else {
            if(disciplina_avaliacao($id)){
                $message = 'Para deletar uma disciplina, é necessário remover as <b>avaliações</b> desta disciplina.';
                $message_type = 'warning';
                managerMessage($message, $message_type);
                return false;
            } else {
                $sql = "
                DELETE FROM `disciplina` WHERE `id` = $id;
                ";
                $con = openDatabaseConnection();
                if(mysqli_query($con,$sql ) === true){
                    $message = 'disciplina excluída';
                    $message_type = 'success';
                    managerMessage($message, $message_type);
                    return true;
                } else {
                    $message = 'Erro ao excluir a disciplina';
                    $message_type = 'danger';
                    managerMessage($message, $message_type);
                    return false;
                } 
            }
        }  
    }
    function quantidade_disciplinas(){
        $sql = "
        SELECT * FROM `disciplina`;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    
    function disciplina_professor($id){
        $sql = "
        SELECT * FROM `professores` WHERE `disciplina_id` = $id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        
        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }  
    }
    function disciplina_avaliacao($id){
        $sql = "
        SELECT * FROM `avaliacao` where `disciplina_id`= $id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        
        if (mysqli_num_rows($query)) {
            //localizado
            return true;
        } else {
            //não localizado
            return false;
        }  
    }
    function visualizar_disciplina_id($id){
        $sql = "
        SELECT * FROM `disciplina` WHERE `id` LIKE '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "disciplina encontrado",
                "id" => $row['id'],
                "nome" => $row['nome']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "disciplina não encontrado",
            );
        }   
    }
    function visualizar_ultimo_id_disciplina($nome){
        $sql = "
        SELECT * FROM `disciplina` WHERE `nome` LIKE '%$nome%' ORDER BY `disciplina`.`id` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $disciplinas[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem disciplinas cadastrados
            return $disciplinas[0]['id'];
        } else {
            //não existem disciplinas
            return false;
        }  
    }

?>