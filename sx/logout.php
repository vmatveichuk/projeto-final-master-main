<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/logs.php");
    session_start();
    $activity = "logout";
    $usuarios = "visitante";
    preInitializeLogVariables($activity, $usuarios);
    insertLog();
    posInitializeLogVariables();

    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['cpf']);
    unset($_SESSION['status']);
    session_unset();
    session_destroy();

    session_start();
    $message = 'Sessão encerrada';
    $message_type = 'warning';
    managerMessage($message, $message_type);
    $activity = "sessao encerrada";
    $usuarios = "visitante";
    preInitializeLogVariables($activity, $usuarios);
    insertLog();
    posInitializeLogVariables();
    header("Location: /");
    exit;
?>