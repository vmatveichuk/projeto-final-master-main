<?php
function senha_mail_2($email, $senha){

   include_once($_SERVER["DOCUMENT_ROOT"] . "/login/sx/common/functions/email-recuperar-senha-layout.php");
    $to = $email . "," . "";
    $subject = "Academus login - Recuperaçõa de senha";
    $message = layout_email($senha);
    $from = "suporte@academus.pro";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: Academus-login@academus.pro";

    mail($to, $subject, $message, $headers);
}