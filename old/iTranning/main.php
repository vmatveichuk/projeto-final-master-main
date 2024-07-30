<?php
session_start();
define('BASE_URL', __DIR__);

function exibirMesangem($retorno)
{
    if ($retorno['status'] == 'success') {
        echo '<div class="alert alert-success" role="alert"> ' . $retorno['mensagem'] . '</div>';
    }else{
        echo '<div class="alert alert-danger" role="alert"> ' . $retorno['mensagem'] . '</div>';
    }
}

spl_autoload_register(function ($class) {
    if (file_exists(BASE_URL . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $class . '.php')) {
        require BASE_URL . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $class . '.php';
    } else if (file_exists(BASE_URL . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . $class . '.php')) {
        require BASE_URL . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . $class . '.php';
    } else {
        throw new Exception("Classe não encontrada'{$class}'");
    }
});
