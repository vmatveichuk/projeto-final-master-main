<?php
session_start();
$activity = "recuperacao de senha pelo applicativo";
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/logs.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/email-novo-usuario-layout.php");

preInitializeLogVariables($activity);
insertLog();
posInitializeLogVariables();

$email=$_GET['email'];
$senha=$_GET['senha'];
$k=$_GET['k'];
$ip = $_GET['ip'];
$id = $_GET['id'];
$location = $_GET['location'];

$to = $email . "," . "";
$subject = "Bem vindo ao Academus";
$message = layout_email($senha, $k);
$from = "suporte@academus.pro";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: acesso@academus.pro";

mail($to, $subject, $message, $headers);

header('Location:http://'.$ip.'/academus/'.$location.'.php?id='.$id);
exit;
?>