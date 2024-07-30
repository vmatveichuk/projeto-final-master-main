<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
    session_start();
    if(!$_POST['email']){
        $activity = "email enviado vazio";
        preInitializeLogVariables($activity, $_POST['email']);
        insertLog();
        posInitializeLogVariables();
        $message = 'Email não localizado.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        header("Location: /recuperar-senha");
        exit;
    }
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/sender_email.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    if(!verifica_usuario_email($_POST['email'])){
        $activity = "email informado não existe na base";
        preInitializeLogVariables($activity, $_POST['email']);
        insertLog();
        posInitializeLogVariables();
        $message = 'Usuario não localizado.';
        $message_type = 'warning';
        managerMessage($message, $message_type);
        header("Location: /recuperar-senha");
        exit;
    } else {
        //cria uma nova senha aleatório de 6 numeros e criptografa para sha1
        $novaSenha = "";
        for($i=0;$i<6;$i++){
           $novaSenha = $novaSenha."".rand(0,9);
        }
        $novaSenha2 =$novaSenha;
        $novaSenhaSha1= sha1($novaSenha2);
        //com email, localiza id do usuario
        $usuario= visualizar_usuario_email($_POST['email']);
        if(($usuario["resposta"]) == false){
            $activity = "não foi possivel localizar o usuario no banco de dados";
            preInitializeLogVariables($activity, $_POST['email']);
            insertLog();
            posInitializeLogVariables();
            $message = 'O Email informado foi localizado.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            header("Location: /recuperar-senha");
            exit;
        }
        //com nova senha e id do usuario é solicitado que seja trocada a senha do usuario no banco de dados
        $resp=trocarSenha_s($usuario['id'], $novaSenha2, $novaSenha2);
        if($resp['resposta'] == false){
            $activity = "erro ao trocar a senha do usuário";
            preInitializeLogVariables($activity, $_POST['email']);
            insertLog();
            posInitializeLogVariables();
            $message = $resp['resposta-message'];
            $message_type = 'danger';
            managerMessage($message, $message_type);
            header("Location: /recuperar-senha");
            exit;
        }
        //enviar email do usário com a nova senha
        $assunto = "Senha de acesso";
        $layout = "nova-senha";
        //falta uma função para buscar o nome da instituição no banco de dados
        include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-instituicao.php");
        $instituicao = visualizar_instituicao_id('1');
        $ans = sender_email($_POST['email'], $novaSenha2, $assunto, $instituicao['nome'], $layout);
        if($ans !== ""){
            $activity = "erro ao enviar o email";
            preInitializeLogVariables($activity, $_POST['email']);
            insertLog();
            posInitializeLogVariables();
            $message = 'Erro ao enviar o email.';
            $message_type = 'danger';
            managerMessage($message, $message_type);
            header("Location: /recuperar-senha");
            exit;
        }
        $activity = "Foi enviada uma nova senha para o email informado.";
        preInitializeLogVariables($activity, $_POST['email']);
        insertLog();
        posInitializeLogVariables();
        $message = 'Foi enviado um email com sua nova senha.';
        $message_type = 'success';
        managerMessage($message, $message_type);
        header("Location: /");
        exit;
    }
?>
