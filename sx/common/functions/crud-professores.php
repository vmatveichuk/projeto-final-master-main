<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-administradores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    function novo_professor($user_id){
        if(!verifica_professor_id_turma_disciplina($user_id)){
            $sql = "
            INSERT INTO `professores` (`id`, `user_id`) VALUES (NULL, '$user_id');
            ";
            $mysqli = openDatabaseConnection();
            if ($mysqli->query($sql)) {
                $assunto = "Atualizações";
                $layout = "atualizacao";
                $instituicao = visualizar_instituicao_id('1');
                $usuario = visualizar_usuario_id($user_id);

                $message = 'Professor registrado com sucesso.';
                $message_type = 'success';
                //managerMessage($message, $message_type);
                return array(
                    "resposta" => true,
                    "resposta_message" => $message,
                );
                
            } else {
                $message = 'Erro ao inserir professor.';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message,
                );
            } 
        } else {
            $message = 'Este professor já está registrado nesta <b>turma</b> e <b>disciplina</b>.';
                $message_type = 'warning';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => true,
                    "resposta_message" => $message,
                );
        }
    }
    function verifica_professor_id_turma_disciplina($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id`='$id';
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
    function buscar_turmas_professor($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id`='$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            return array(
                0 => $row['turma_id'],
                1 => $row['Turma_id2'],
                2 => $row['Turma_id3'],   
                3 => $row['Turma_id4']
            );   

        } else {
            //não localizado
            return false;
        }   
    }
    function buscar_disciplinas_professor($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id`='$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            return array(
                0 => $row['disciplina_id'],
                1 => $row['Disciplina-id2'],
                2 => $row['Disciplina-id3'],
                3 => $row['Disciplina-id4']

            );   

        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_professor_id($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id`=$id;
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
    function visualizar_professor_id($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id` = '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Professor encontrado",
                "id" => $row['id'],
                "user_id" => $row['user_id'],
                "turma_id" => $row['turma_id'],
                "disciplina_id" => $row['disciplina_id']
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Professor não encontrado",
            );
        }   
    }
    /*function editarProfessor($id, $usuarios_id){
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
                if(!validaCPF($cpf)){
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
    }*/
    function lista_professores($nome){
        $resp=lista_usuarios_nome($nome);
        if($resp['resposta']){
            $usuarios=$resp["usuarios"];
            $usuarios_size=$resp["size-usuarios"];
            $i=0;
            $p=0;
            while($usuarios_size>$i){
            if(verifica_professor_id($usuarios[$i]['id'])){
                $lista_professores[$p] = $usuarios[$i];
                $p++;
                }
                $i++;
            }
            if ($p == 0){
                return array(
                    "resposta" => false,
                    "resposta_message" => "não existem professores cadastrados.",
                );
            } else {
                return array(
                    "resposta" => true,
                    "resposta_message" => "lista de professores.",
                    "size-professores" => sizeof($lista_professores),
                    "professores" => $lista_professores,
                );
            }
        } else {
            return array(
                "resposta" => false,
                "resposta_message" => "não existem usuarios cadastrados.",
            );
        }
    }
    function deletar_professor_id($id){
       $sql = "
       DELETE FROM `professores` WHERE `user_id` = '$id';
        ";
        $con = openDatabaseConnection();
        if(mysqli_query($con,$sql ) === true){
            if(!verifica_admin_id($id))
            deletar_usuario_id($id);

            $message = 'Professor excluído.';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function deletar_registro_id($id){
        $sql = "
        DELETE FROM `professores` WHERE `id` = '$id';
         ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             if(!verifica_admin_id($id))
             deletar_usuario_id($id);
 
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_disci1($id){
        $sql = "
        UPDATE `professores` SET 
        `disciplina_id` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_disci2($id){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id2` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_disci3($id){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id3` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_disci4($id){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id4` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_disci1($id,$disci){
        $sql = "
        UPDATE `professores` SET 
        `disciplina_id` = '$disci' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Disci atualizada';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_disci2($id,$disci){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id2` = '$disci' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Disci atualizada.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_disci3($id,$disci){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id3` = '$disci' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Disci atualizada.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_disci4($id,$disci){
        $sql = "
        UPDATE `professores` SET 
        `Disciplina-id4` = '$disci' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Disci atualizada.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_turma_id1($id){
        $sql = "
        UPDATE `professores` SET 
        `turma_id` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_turma_id2($id){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id2` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_turma_id3($id){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id3` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function deletar_turma_id4($id){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id4` = 'NULL' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
            $message = 'Registor excluído.';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_turmaid1($id,$turmaid){
        $sql = "
        UPDATE `professores` SET 
        `turma_id` = '$turmaid' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Turma atualizada';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_turmaid2($id,$turmaid){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id2` = '$turmaid' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Turma atualizada';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_turmaid3($id,$turmaid){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id3` = '$turmaid' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Turma atualizada';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function atualizar_turmaid4($id,$turmaid){
        $sql = "
        UPDATE `professores` SET 
        `Turma_id4` = '$turmaid' 
        WHERE `user_id` = $id;
        ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
            $message = 'Turma atualizada';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
    }
    function quantidade_professores(){
        $sql = "
        SELECT DISTINCT `user_id` FROM `professores`;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }   
    function lista_registros_professor_id($id){
        $sql = "
        SELECT * FROM `professores` WHERE `user_id`='$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $registros[$i] = array(
                "id" => $row['id'],
                "user_id" => $row['user_id'],
                "turma_id" => $row['turma_id'],
                "disciplina_id" => $row['disciplina_id']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem registros cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de registros.",
                "registros" => $registros,
                "size-registros" => sizeof($registros)
            );
        } else {
            //não existem registros
            return array(
                "resposta" => false,
                "resposta_message" => "não existem registros cadastrados.",
            );
        }  
    }
    function quantidade_disciplinas_professor($id){
        $sql = "
        SELECT distinct `disciplina_id`  FROM `professores` where `user_id` = '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
    function quantidade_turmas_professor($id){
        $sql = "
        SELECT distinct `turma_id` FROM `professores` where `user_id` = '$id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        return mysqli_num_rows($query);
    }
?>