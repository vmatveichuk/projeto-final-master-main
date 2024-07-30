<?php
function sendemail_senha_email($email, $senha){
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/send_email.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/email-recuperar-senha-layout.php");

//foi criato um send grid expecificamente para envio dos email do rpa 
//sendgrid
//conta: cibra-rpa@fluxo.pro//cibra-rpa
//senha: Cibra!2019

$email_costumer = $email;
$name_costumer = $email;
$email_sender = "cibra-rpa@fluxo.pro";
$name_sender = "CIBRA RPA";
$subject="Recuperação de senha - Cibra RPA";

$body = layout_email($senha);

//------------------------------------------------------------------------------------------------
$response = send_email($email_costumer, $name_costumer, $email_sender, $name_sender, $body, $subject);
return $response;
}
?>