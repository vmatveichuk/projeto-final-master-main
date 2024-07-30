<?php
function send_email($email_costumer, $name_costumer, $email_sender, $name_sender, $body, $subject){
$headers = array(
    'Authorization: Bearer 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',
    'Content-Type: application/json',
    'Accept: application/json'
);
$data = array(
    "personalizations" => array(
        array(
            "to" => array(
                array(
                    "email" => $email_costumer,
                    "name" => $name_costumer
                )
            )
        )
    ),
    "from" => array(
        "email" => $email_sender
    ),
    "subject" => $subject,
    "content" => array(
        array(
            "type" => "text/html",
            "value" => $body
            )
    )
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
return $response;
}
?>