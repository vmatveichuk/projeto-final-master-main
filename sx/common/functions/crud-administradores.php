<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    function novo_admin($id){
        if (verifica_admin_id($id)){
            $message = 'Usuário já está cadastrado.';
            $message_type = 'success';
            //managerMessage($message, $message_type);
            return array(
                "resposta" => true,
                "resposta_message" => $message,
            );
        } else {
            $sql = "
            INSERT INTO `administradores` (`id`, `usuarios_id`) VALUES (NULL, '$id');
            ";
            $mysqli = openDatabaseConnection();
            if ($mysqli->query($sql)) {

                $message = 'Administrador registrado com sucesso';
                $message_type = 'success';
                //managerMessage($message, $message_type);
                return array(
                    "resposta" => true,
                    "resposta_message" => $message,
                );
                
            } else {
                $message = 'Erro ao inserir administrador';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message,
                );
            }   
        }
    }
    function verifica_admin_id($id){
        $sql = "
        SELECT * FROM `administradores` WHERE `usuarios_id`=$id;
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
    function editarAdministrador($id, $nome,$email,$cpf){
        //consulta se existe ja tem alguem utilizando o cpf que seja diferente do id atual
        if(verifica_usuario_cpf_com_id($id, $cpf)){
            $message = 'Já exite um usuário utilizando este CPF.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message
                );
        } else {
        //consulta se existe ja tem alguem utilizando o email que seja diferente do id atual
            if(verifica_usuario_email_com_id($id, $email)){
                $message = 'Já exite um usuário utilizando este email.';
                $message_type = 'warning';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message
                    );
            } else {
                if(validaCPF($cpf)){
                    $message = 'O número de CPF informado não é válido.';
                    $message_type = 'warning';
                    managerMessage($message, $message_type);
                    return array(
                    "resposta" => false,
                    "resposta_message" => $message
                    );
                } else {
                    $sql = "
                    UPDATE `usuarios` SET 
                    `nome` = '$nome', 
                    `email` = '$email',  
                    `cpf` = '$cpf' 
                    WHERE `usuarios`.`id` = $id;
                    ";
                    $con = openDatabaseConnection();
                    if(mysqli_query($con,$sql ) === true){
                        $message = 'Dados pessoais atualizados com sucesso.';
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
        }
   }
    function lista_administradores($nome){
        $resp=lista_usuarios_nome($nome);
        if($resp['resposta']){
            $usuarios=$resp["usuarios"];
            $usuarios_size=$resp["size-usuarios"];
            $i=0;
            $p=0;
            while($usuarios_size>$i){
            if(verifica_admin_id($usuarios[$i]['id'])){
                $lista_admins[$p] = $usuarios[$i];
                $p++;
                }
                $i++;
            }
            if ($p == 0){
                return array(
                    "resposta" => false,
                    "resposta_message" => "não existem administradores cadastrados.",
                );
            } else {
                return array(
                    "resposta" => true,
                    "resposta_message" => "lista de administradores.",
                    "size-administradores" => sizeof($lista_admins),
                    "administradores" => $lista_admins,
                );
            }
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem usuarios cadastrados.",
            );
        }
    }
    function deletar_admin_id($id){
       $sql = "
       DELETE FROM `administradores` WHERE `usuarios_id` = $id;
        ";
        $con = openDatabaseConnection();
        if(mysqli_query($con,$sql ) === true){
            if(!verifica_professor_id($id))
            
            $message = 'Adminstrador excluído';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function quantidade_administradores(){
        $sql = "
        SELECT * FROM `administradores`;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
?>