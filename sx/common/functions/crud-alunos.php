<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    function verifica_aluno_id2($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `user_id`=$id;
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
    function verifica_aluno_id($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `id`=$id;
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
    function presenca_aluno($id,$pre){
        if(!verifica_aluno_id($id)){
            $message = 'Essa aluno não existe.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message
                );
           } else {
               $sql = "
                UPDATE `alunos` SET 
                `presenca` = '$pre' 
                WHERE `id` = $id;
                ";
                $con = openDatabaseConnection();
                if(mysqli_query($con,$sql ) === true){
                    $message = 'Dados do aluno atualizado com sucesso.';
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
    function pegar_turmas_id($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `id`=$id;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            return array(
                "Turma1" => $row['Turma_id']    
            );
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_aluno_nome($nome){
        $sql = "
        SELECT * FROM `alunos` WHERE `nome`=$nome;
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
    function pegar_aluno_matricula($matricula){
        $sql = "
        SELECT * FROM `alunos` WHERE `matricula`='$matricula';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //localizado
            return array(
                "resposta" => true,
                "nome" => $row['nome']
                );
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_aluno_matricula($matricula){
        $sql = "
        SELECT * FROM `alunos` WHERE `matricula`='$matricula';
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
    function aluno_da_turma($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `Turma_id`='$id'  ORDER BY `alunos`.`nome` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $alunos[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula'],
                "presenca" => $row['Presenca']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem alunos cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de alunos.",
                "alunos" => $alunos,
                "size-alunos" => sizeof($alunos),
            );
        } else {
            //não existem alunos
            return array(
                "resposta" => false,
                "resposta_message" => "não existem alunos cadastrados.",
            );
        }  
    }
    function verifica_aluno_matricula2($matricula, $id){
        $sql = "
        SELECT * FROM `alunos` WHERE `matricula`='$matricula' and not `id` = '$id'
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
    function novo_alunos($matricula, $nome,$turma,$id){
        $sql = "
        INSERT INTO `alunos` (`id`, `matricula`, `nome`,`Turma_id`,`user_id`) VALUES ('NULL', '$matricula', '$nome','$turma','$id');
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)){
            $message = 'aluno registrado com sucesso.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            $message = 'Erro ao inserir aluno.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return false;
        }   
    }
    function editaraluno($id, $matricula, $nome,$turma){
       if(!verifica_aluno_id($id)){
        $message = 'Essa aluno não existe.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        return array(
            "resposta" => false,
            "resposta_message" => $message
            );
       } else {
           $sql = "
            UPDATE `alunos` SET 
            `nome` = '$nome',
            `Turma_id`='$turma', 
            `matricula` = '$matricula' 
            WHERE `id` = $id;
            ";
            $con = openDatabaseConnection();
            if(mysqli_query($con,$sql ) === true){
                $message = 'Dados do aluno atualizado com sucesso.';
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
    function lista_alunos($nome){
        $sql = "
        SELECT * FROM `alunos` WHERE `nome` LIKE '%$nome%' or `matricula` LIKE '%$nome%' ORDER BY `alunos`.`nome` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $alunos[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula'],
                "turma_id" => $row['Turma_id']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem alunos cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de alunos.",
                "alunos" => $alunos,
                "size-alunos" => sizeof($alunos),
            );
        } else {
            //não existem alunos
            return array(
                "resposta" => false,
                "resposta_message" => "não existem alunos cadastrados.",
            );
        }  
    }
    function deletar_aluno_id($id){
        if(aluno_avaliacao($id)){
            $message = 'Para deletar uma aluno, é necessário remover as <b>avaliações</b> desta aluno.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return false;
        } else {
            $sql = "
            DELETE FROM `alunos` WHERE `id` = $id;
            ";
            $con = openDatabaseConnection();
            if(mysqli_query($con,$sql ) === true){
                $message = 'Aluno excluído.';
                $message_type = 'success';
                managerMessage($message, $message_type);
                return true;
            } else {
                $message = 'Erro ao excluir a aluno';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                return false;
            } 
        }
     
    }
    function quantidade_alunos(){
        $sql = "
        SELECT * FROM `alunos`;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function quantidade_alunos2($id){
        $sql = "
        SELECT * FROM `alunos` where `Turma_id`= '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function aluno_avaliacao($id){
        $sql = "
        SELECT * FROM `avaliacao` where `matricula`= '$id';
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
    function visualizar_aluno_id($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `id` LIKE '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "aluno encontrado",
                "id" => $row['id'],
                "aluno_id" => $row['user_id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula'],
                "turma_id" => $row['Turma_id']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "aluno não encontrado",
            );
        }   
    }
    function visualizar_aluno_id2($id){
        $sql = "
        SELECT * FROM `alunos` WHERE `user_id` LIKE '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "aluno encontrado",
                "id" => $row['id'],
                "aluno_id" => $row['user_id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula'],
                "turma_id" => $row['Turma_id']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "aluno não encontrado",
            );
        }   
    }
    function visualizar_aluno_matricula($matricula){
        $sql = "
        SELECT * FROM `alunos` WHERE `matricula` LIKE '$matricula';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "aluno encontrado",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "aluno não encontrado",
            );
        }   
    }
    function visualizar_ultimo_id_aluno($nome){
        $sql = "
        SELECT * FROM `alunos` WHERE `nome` LIKE '%$nome%' ORDER BY `alunos`.`id` DESC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $alunos[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "matricula" => $row['matricula']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem alunos cadastrados
            return $alunos[0]['id'];
        } else {
            //não existem alunos
            return false;
        }  
    }
?>