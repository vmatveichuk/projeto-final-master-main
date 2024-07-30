<?php
function openDatabaseConnection(){
    $host = 'localhost';
    $user = 'root';
    // $pass = 'OY1X8U4aTVV2DHJC';
    $pass = '';
    $db = 'printe81_grade';
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
    //aqui falta um messagem de erro
    if (!$mysqli) {
        die('Erro ao conectar ao banco: ' . mysqli_error($mysqli));
    }
return $mysqli;
}