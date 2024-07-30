<?php

    require '../autoload.php';

    $email = new Email();
    $email->setRemetente($_SESSION['user']['email']);

    $retornoCaixaEntrada = $email->buscarCaixaDeEntrada();

    echo json_encode($retornoCaixaEntrada);
?>