<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/sender_email.php");
    function novo_usuario($nome, $cpf, $email,$novaSenha){
        //$novaSenhaSha1= sha1($novaSenha);
        $sql = "
        INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `senha`, `status`) 
        VALUES (NULL, '$nome', '$email', '$cpf', '$novaSenha', 'ativo');
        ";
        $mysqli = openDatabaseConnection();
        if ($mysqli->query($sql)) {
            $assunto = "Bem vindo";
            $layout = "novo-usuario";
            $instituicao = visualizar_instituicao_id('1');
            $message = 'Sucesso ao cadastrar usuario';
            $message_type = 'success';
            managerMessage($message, $message_type);
            return array(
                "resposta" => true,
                "resposta_message" => $message,
            );
            //$ans = sender_email($email, $novaSenha, $assunto, $instituicao['nome'], $layout);
            //if($ans == ""){
                //$message = 'Email enviado para o usuário.';
               // $message_type = 'success';
               // managerMessage($message, $message_type);
                //return array(
                //    "resposta" => true,
                //    "resposta_message" => $message,
            //    );
           // } else {
              //  $message = 'Erro ao enviar email para o usuário.';
             //   $message_type = 'danger';
             //   managerMessage($message, $message_type);
             //   return array(
              //  "resposta" => false,
              //  "resposta_message" => $message,
              //  );
           // }
        } else {
            $message = 'Erro ao inserir usuário';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message,
            );
        }   
    }
    function visualizar_usuario_cpf($cpf){
        $sql = "
        SELECT * FROM `usuarios` WHERE `cpf` LIKE '$cpf';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Usuário encontrado",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "cpf" => $row['cpf'],
                "email" => $row['email'],
                "status" => $row['status'],
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Usuário não encontrado",
            );
        }   
    }
    function visualizar_usuario_email($email){
        $sql = "
        SELECT * FROM `usuarios` WHERE `email` LIKE '$email';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Usuário encontrado",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "cpf" => $row['cpf'],
                "email" => $row['email'],
                "senha" => $row['senha'],
                "status" => $row['status'],
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Usuário não encontrado",
            );
        }   
    }
    function visualizar_usuario_id($usuario_id){
        $sql = "
        SELECT * FROM `usuarios` WHERE `id` LIKE '$usuario_id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Usuário encontrado",
                "id" => $row['id'],
                "nome" => $row['nome'],
                "cpf" => $row['cpf'],
                "email" => $row['email'],
                "status" => $row['status'],
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Usuário não encontrado",
            );
        }   
    }
    function nome_usuario_id($usuario_id){
        $sql = "
        SELECT * FROM `usuarios` WHERE `id` LIKE '$usuario_id';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            //usuário localizado
            return array(
                "resposta" => true,
                "resposta_message" => "Usuário encontrado",
                "nome" => $row['nome'],
            );

        } else {
            //usuário não localizado
            return array(
                "resposta" => false,
                "resposta_message" => "Usuário não encontrado",
            );
        }   
    }
    function verifica_usuario_cpf($cpf){
        $sql = "
        SELECT * FROM `usuarios` WHERE `cpf` LIKE '$cpf';
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
    function verifica_usuario_email($email){
        $sql = "
        SELECT * FROM `usuarios` WHERE `email` LIKE '$email';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            // localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_usuario_acessos($usuario_id, $acesso){
        $sql = "
        SELECT * FROM `usuarios_acessos` WHERE `usuairos_id` LIKE '$usuario_id' AND `acesso` LIKE '$acesso';
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $row= mysqli_fetch_array($query);

        if (mysqli_num_rows($query)) {
            // localizado
            return true;
        } else {
            //não localizado
            return false;
        }   
    }
    function verifica_usuario_cpf_com_id($id, $cpf){
        $sql = "
        SELECT * FROM `usuarios` WHERE `cpf` LIKE '$cpf' and not `id`=$id;
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
    function verifica_usuario_email_com_id($id, $email){
        $sql = "
        SELECT * FROM `usuarios` WHERE `email` LIKE '$email' and not `id`=$id;
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
    function trocarSenha($usuario_id, $password1, $password2){
        if($password1 !== $password2){
            $message = 'As senhas precisam ser iguais.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message
                );
        } else {
            if(strlen($password1) < 6 ){
                $message = 'A senha deve ser maior ou igual a 6 caracteres.';
                $message_type = 'warning';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message
                    );
            } else {
                $senhaSha1= sha1($password1);
                $sql = "
                UPDATE `usuarios` SET `senha` = '$senhaSha1' WHERE `usuarios`.`id` = $usuario_id;
                ";
                $con = openDatabaseConnection();
                if(mysqli_query($con,$sql ) === true){
                    $message = 'Senha subistituida com sucesso.';
                    $message_type = 'success';
                    managerMessage($message, $message_type);
                    return array(
                        "resposta" => true,
                        "resposta_message" => $message
                        );
                } else {
                    $message = 'Falha ao trocar a senha, tente novamente.';
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
    function trocarSenha_s($usuario_id, $password1, $password2){
        if($password1 !== $password2){
            $message = 'As senhas precisam ser iguais.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            return array(
                "resposta" => false,
                "resposta_message" => $message
                );
        } else {
            if(strlen($password1) < 6 ){
                $message = 'A senha deve ser maior ou igual a 6 caracteres.';
                $message_type = 'warning';
                managerMessage($message, $message_type);
                return array(
                    "resposta" => false,
                    "resposta_message" => $message
                    );
            } else {
                $senhaSha1= sha1($password1);
                $sql = "
                UPDATE `usuarios` SET `senha` = '$senhaSha1' WHERE `usuarios`.`id` = $usuario_id;
                ";
                $con = openDatabaseConnection();
                $message = 'Senha alterada';
                 $message_type = 'success';
                if(mysqli_query($con,$sql ) === true){
                    return array(
                        "resposta" => true,
                        "resposta_message" => $message
                        );
                } else {
                    $message = 'Falha ao trocar a senha, tente novamente.';
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
    function validaCPF($cpf = null){
        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
        } else {   
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }
    function editarUsuario($id, $nome, $email, $cpf){
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
    }
    function editarUsuario2($id, $nome, $email, $cpf,$senha){
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
                    `cpf` = '$cpf',
                    `senha` = '$senha' 
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
    function lista_usuarios_nome($nome){
        $sql = "
        SELECT * FROM `usuarios` WHERE `nome` LIKE '%$nome%' ORDER BY `nome` ASC;
        ";
        $con = openDatabaseConnection();
        $query = mysqli_query($con,$sql);
        $i=0;
        while($row= mysqli_fetch_array($query)){
            $usuarios[$i]= array(
                "id" => $row['id'],
                "nome" => $row['nome'],
                "cpf" => $row['cpf'],
                "email" => $row['email'],
                "status" => $row['status'],
                "senha" => $row['senha']
            );
            $i++;
        }
        if (mysqli_num_rows($query)) {
            //existem administradores cadastrados
            return array(
                "resposta" => true,
                "resposta_message" => "lista de usuários.",
                "usuarios" => $usuarios,
                "size-usuarios" => sizeof($usuarios),
            );
        } else {
            //não existem administradores
            return array(
                "resposta" => false,
                "resposta_message" => "não existem usuários cadastrados.",
            );
        }
    }
    function deletar_usuario_id($id){
        $sql = "
        DELETE FROM `usuarios` WHERE `id` = $id;
         ";
         $con = openDatabaseConnection();
         if(mysqli_query($con,$sql ) === true){
             $message = 'Usuário excluído';
             $message_type = 'success';
             managerMessage($message, $message_type);
             return true;
         } else {
             //não localizado
             return false;
         }   
     }
?>