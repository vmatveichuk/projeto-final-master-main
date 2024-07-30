<?php
session_start();
$activity = "recuperacao de senha pelo applicativo";
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/logs.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/controllers/senha_mail_2.php");
preInitializeLogVariables($activity);
insertLog();
posInitializeLogVariables();

$email=$_GET['email'];
$senha=$_GET['senha'];

senha_mail_2($email, $senha);
header('Location:https://academus.pro/login');
exit;
?>