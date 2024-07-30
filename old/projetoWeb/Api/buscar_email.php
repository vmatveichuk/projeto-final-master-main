<?php
    require '../autoload.php';

    $query = $_POST['buscar_query'];
    $retorno = array();

    $email = new Email();
    $email->setDestinatario($_SESSION['user']['email']);
    $retornoEmails = $email->buscarEmails();

    foreach ($retornoEmails as $email) {
        if (preg_match("/$query/", $email['remetente'])) {
            $email['remetente'] = '<b class="marcacaoText">' . $email['remetente'] . '</b>';
            $retorno[] = $email;
        }

        if (preg_match("/$query/", $email['assunto'])) {
            $email['assunto'] = '<b class="marcacaoText">' . $email['assunto'] . '</b>';
            $retorno[] = $email;
        }

        if (preg_match("/$query/", $email['mensagem'])) {
            $email['mensagem'] = '<b class="marcacaoText">' . $email['mensagem'] . '</b>';
            $retorno[] = $email;
        }
    }

    echo json_encode($retorno);
?>





