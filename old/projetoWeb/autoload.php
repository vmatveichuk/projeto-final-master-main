<?php

    session_start();
    define('BASE_URL', __DIR__);

    spl_autoload_register(function($class) {
        if(file_exists(__DIR__.DIRECTORY_SEPARATOR . 'Class' . DIRECTORY_SEPARATOR . $class . '.php')) {
            require __DIR__ . DIRECTORY_SEPARATOR . 'Class' . DIRECTORY_SEPARATOR . $class . '.php';
        }
        else {
            throw new Exception("Classe não encontrada'{$class}'");
        }
    });
?>