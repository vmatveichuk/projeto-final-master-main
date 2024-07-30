<?php
function sender_email($email, $senha, $assunto, $instituicao, $layout){
include_once ($_SERVER["DOCUMENT_ROOT"] . '/sx/common/functions/send_email.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/sx/common/functions/email-layout-senha.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/sx/common/functions/email-novo-usuario-layout.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/sx/common/functions/email-layout-atualizacao.php');

//foi criato um send grid expecificamente para envio dos email do grade
//sendgrid
//conta: sendgrid-grade@printercloud.com.br//gradeprinter
//senha: Fluxo!2020

$email_costumer = $email;
$name_costumer = $email;
$email_sender = "grade@printercloud.com.br";
$name_sender = "Grade";
$subject= $assunto. " - Grade - ". $instituicao;

if($layout == "nova-senha"){
  $body = layout_email_senha($senha, $instituicao);
}
if($layout == "novo-usuario"){
  $body = layout_email_novo($senha, $instituicao); 
}
if($layout == "atualizacao"){
    $body = layout_email_atualizacao($instituicao);
}
//------------------------------------------------------------------------------------------------
$response = send_email($email_costumer, $name_costumer, $email_sender, $name_sender, $body, $subject);
return $response;
}
?>
