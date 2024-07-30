<?php
    session_start();
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-professores.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-alunos.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-administradores.php");

    $activity = "logar";
    $usuarios = "visitante";
    preInitializeLogVariables($activity, $usuarios);
    insertLog();
    posInitializeLogVariables();

    if($_POST['acao'] == "logar"){//com usuario e senha, verifica dado do usuario no banco 
        $email=$_POST['email'];
        // echo $_POST['senha'];
        // echo '<br />';
        $senha=sha1($_POST['senha']);
        // // exit;
        // echo '<br />';

        $usuario= visualizar_usuario_email($email);
        // echo $usuario['senha'];
     
        if($usuario['resposta']==true){//usuário localizado

            if($usuario['senha'] == $senha) {//verifica se a senha está correta
                // echo 'deucerto';
                // exit;
                $_SESSION["session_name"]= time();
                $_SESSION['cpf']= $usuario['cpf'];
                $_SESSION['id']= $usuario['id'];
                $_SESSION['nome']= $usuario['nome'];
                $_SESSION['email']= $usuario['email'];
                $_SESSION['status']= $usuario['status'];
                $_SESSION['professor']= false;
                $_SESSION['administrador']= false;
                $_SESSION['aluno']= false;
    
                $activity = "login-realizado: usuário foi  ";
                preInitializeLogVariables($activity, $usuarios);
                insertLog();
                posInitializeLogVariables();
                //com base nos acessos é direccionado
                if (verifica_professor_id($_SESSION['id'])){
                    $_SESSION['professor'] = true;
                    $_SESSION['registro'] = lista_registros_professor_id($_SESSION['id']);
                }
                if (verifica_admin_id($_SESSION['id'])){
                    $_SESSION['administrador']= true;
                }
                if (verifica_aluno_id2($_SESSION['id'])){
                    $_SESSION['aluno']= true;
                }
                
                if($_SESSION['professor']== true){
                    header("Location: /professores/painel");
                    exit;
                }
                if($_SESSION['administrador']== true){
                    header("Location: /administracao/painel");
                    exit;
                }
                // se ele não for nada, ele vira professor
                $_SESSION['professor']= true;
                header("Location: /professores/painel");          
                exit;

            } else { //senha errada
                $activity = "senha errada";
                $usuarios = "visitante";
                preInitializeLogVariables($activity, $usuarios);
                insertLog();
                posInitializeLogVariables();
                $message = 'Acesso negado, email ou senha incorretos.';
                $message_type = 'danger';
                managerMessage($message, $message_type);
                header("Location: /");
                exit;
            }
        } else {//usuário não localizado
            $activity = "email nao existe na base";
            $usuarios = "visitante";
            preInitializeLogVariables($activity, $usuarios);
            insertLog();
            posInitializeLogVariables();
            $message = 'Usuário não localizado.';
            $message_type = 'warning';
            managerMessage($message, $message_type);
            header("Location: /");
            exit;
        }
    }
    //susperde a sessão, manda para o começo
    if(!isset($_SESSION["id"])){
        unset($_SESSION['id']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['cpf']);
        unset($_SESSION['status']);
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
   
?>
