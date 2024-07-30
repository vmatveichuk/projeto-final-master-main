<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/message_manager.php");
function insertLog(){
    $client_ip = $_SERVER['REMOTE_ADDR'];
    $resposta = @unserialize(file_get_contents('http://ip-api.com/php/'.$client_ip));
    if ($resposta["status"] == "fail"){
        $resposta = @unserialize(file_get_contents('http://ip-api.com/php/grade.printercloud.com.br'));
        $resposta["status"] = "fail";
    }
    if ($resposta["country"] == ""){
        $resposta = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
    }
    if ($resposta["status"] == "fail"){
        $resposta = @unserialize(file_get_contents('http://ip-api.com/php/grade.printercloud.com.br'));
        $resposta["status"] = "fail";
    }
    if(isset($_SESSION['last-request-response']['data'])){
        $lastRequestConvertedToString = print_r($_SESSION['last-request-response']['data'],true);
    } else {
        $lastRequestConvertedToString = "";
    }
    if(!isset($_SESSION['page_name_start'])){
        $_SESSION['page_name_start'] = $_SERVER['REQUEST_URI'];
    }
    if(!isset($_SESSION['timestamp_start'])){
        $_SESSION['timestamp_start'] = date("Y.m.d H:i:s", time());
    }
      $sql = "
        INSERT INTO `logs` (
            `id`,
            `session_name`,
            `ip`,
            `user_id`,
            `user_document_type`,
            `user_document_number`,
            `activity`,
            `page_name_start`,
            `timestamp_start`,
            `page_name_end`,
            `timestamp_end`,
            `duration`,
            `datas`,
            `lat`,
            `lon`,
            `city`,
            `regionName`,
            `country`
        )
        VALUES (
            NULL,
            '".$_SESSION['session_name']."',
            '".$_SERVER['REMOTE_ADDR']."',
            '".@$_SESSION['id']."',
            '".@$_SESSION['nome']."',
            '".@$_SESSION['cpf']."',
            '".$_SESSION['activity']."',
            '".$_SESSION['page_name_start']."',
            '".$_SESSION['timestamp_start']."',
            '".$_SESSION['page_name_end']."',
            '".$_SESSION['timestamp_end']."',
            '".$_SESSION['duration']."',
            '".$lastRequestConvertedToString."',
            '".$resposta['lat']."',
            '".$resposta['lon']."',
            '".$resposta['city']."',
            '".$resposta['regionName']."',
            '".$resposta['country']."');
    ";
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql)) {
        $_SESSION['log'] = "o log foi registrado";
        $_SESSION['log_status'] = 'success';
    } else {
        $_SESSION['log'] = 'erro ao registrar o log';
        managerMessage("error_bd_log", "danger");
    }
}
function preInitializeLogVariables($activity, $usuario){
    if(!isset($_SESSION['session_name'])) {
        $th = time();
        $_SESSION['session_name'] = '' . $th . '';
        $_SESSION['usuario'] = $usuario;
    }
    $_SESSION['page_name_end'] = $_SERVER['REQUEST_URI'];
    $_SESSION['timestamp_end'] = date("Y.m.d H:i:s", time());
    $_SESSION['microtime_end'] = microtime(true);
    if(isset($_SESSION['microtime_start'])){
        $_SESSION['duration'] = $_SESSION['microtime_end'] - $_SESSION['microtime_start'];
    } else{
        $_SESSION['duration'] = $_SESSION['microtime_end'];
    }
    $_SESSION['activity'] = "$activity";
}
function posInitializeLogVariables(){
    $_SESSION['page_name_start'] = $_SERVER['REQUEST_URI'];
    $_SESSION['timestamp_start'] = date("Y.m.d H:i:s", time());
    $_SESSION['microtime_start'] = microtime(true);
}