<?php
    require '../autoload.php';

    $query = $_POST['buscar_query'];

    $usuario = new Usuario();
    $usuarios = $usuario->buscarUsuarios();

    $retorno = array();

    for ($i = 0; $i < count($usuarios); $i++) {
        if (preg_match("/$query/", $usuarios[$i]['email'])) {
            $retorno[] = $usuarios[$i];
        }

    }

    echo json_encode($retorno);
?>