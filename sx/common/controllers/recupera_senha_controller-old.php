<?php
session_start();
$activity = "verificador-para-recuperacao-de-senha";
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/logs.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/sendemail_senha_email.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/controllers/senha_mail.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/controllers/senha_mail_2.php");
preInitializeLogVariables($activity);
insertLog();
posInitializeLogVariables();

function remove_utf8_bom($text) {
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}
function curl_request1($data=false, $url='auth.academus.pro/auth_api/userByCpf.php') {
    // Tratamento inicial dos dados recebidos
    $data['cpf'] = str_replace('.', '', $data['cpf']);
    $data['cpf'] = str_replace('-', '', $data['cpf']);
    //$url = str_replace('http://', '', $url);
    $url = 'http://'.$url;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch));
    curl_close($ch);

    return $response;
}

if(!isset($_POST['email'])){
    $_SESSION["message_academus"]="message3";
    $_SESSION["message_academus_type"]="danger";
    header("Location: /login");
    exit;
    }else{      
        if (!function_exists('curl_version')) {
            $_SESSION["message_academus"]="message5";
            $_SESSION["message_academus_type"]="danger";
            header("Location: /login");
            exit;
        }
        $data['cpf'] = $_POST['cpf'];
        $resposta = curl_request1($data, 'auth.academus.pro/auth_api/userByCpf.php');
        

        if($resposta->error == true){
            //esse usuario não tem um email válido ou seja
            //a api não localizou o email dele 
            // Resposta - não foi possível localizar os registros para esse usuário.
            $_SESSION["message_academus"]="message7";
            $_SESSION["message_academus_type"]="danger";
            header("Location: /login");
            exit;
        }
        
        $senha_unadultered = randon_pass();
        $senha = sha1($senha_unadultered);
        $email = $_POST['email'];
        if($resposta != NULL and $email != "" && $email == $resposta->user->email){
            $data['password_before'] = $resposta->user->encrypted_password;
            $data['password_after'] = $senha;
            $data['cpf'] = $_POST['cpf'];
            $response = curl_request1($data, 'auth.academus.pro/auth_api/update.php');
            senha_mail_2($email, $senha_unadultered);
            //sendemail_senha_email($email, $senha_unadultered);
            $_SESSION["message_academus"]="message1";
            $_SESSION["message_academus_type"]="success";
            header("Location: /login");
            exit;
        }
        else{
            $_SESSION["message_academus"]="message8";
            $_SESSION["message_academus_type"]="danger";
            header("Location: /login");
            exit;
        }
    }