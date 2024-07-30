<?php
    require '../autoload.php';

    if(!empty($_POST)){
        $email = new Email();
        $email->setDestinatario($_POST['enviar-email']);
        $email->setRemetente($_SESSION['user']['email']);
        $email->setAssunto($_POST['enviar-assunto']);
        $email->setMensagem($_POST['enviar-mensagem']);
        $email->setCC($_POST['enviar-email-cc']);
        $email->novoEmail($_POST['enviar-email-novo']);
    }
?>

<html>
    <head>
        <title>Email</title>
        <meta charset="utf-8">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/index.css"/>

        <!-- JS -->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/index.js"></script>
    </head>
    <body>
        <div id="body-navbar-top">
            <img id="icon-menu" src="../imagem/icon/icon_menu.png"/>
            <div id="buscar-email">
                <input id="pesquisar-email" class="form-input" type="text" placeholder="Pesquisar"/>
            </div>
        </div>
        <div id="body-main-principal">
            <div id="principal-navbar">
                <p class="text-center" id="nome-user">Bem-vindo, <?= $_SESSION['user']['nome'] ?></p>

                <a href="new_email.php">
                    <button class="btn btn-grey" id="btn-novaMsg"> + Nova Mensagem</button>
                </a>

                <table id="menu-opcoes" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td><a href="favoritos.php">Favoritos</a></td>
                    </tr>
                    <tr>
                        <td><a href="principal.php">Caixa de Entrada</a></td>
                    </tr>
                    <tr>
                        <td><a href="lixo_eletronico.php">Lixo Eletrônico</a></td>
                    </tr>
                    <tr>
                        <td><a href="rascunho.php">Rascunho</a></td>
                    </tr>
                    <tr>
                        <td><a href="enviados.php">Itens Enviados</a></td>
                    </tr>
                    <tr>
                        <td><a href="excluidos.php">Itens Excluidos</a></td>
                    </tr>
                    <tr>
                        <td><a href="arquivo_morto.php">Arquivo Morto</a></td>
                    </tr>
                    <tr>
                        <td><a href="../index.php">Sair</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="principal-body">
                <div id="body-title">
                    <p>Novo Email</p>
                </div>
                <div class="container">
                    <form method="POST">
                        <div class="form-group">
                            <label>Para :</label>
                            <input class="form-control complete-email" autocomplete="off" id="enviar-email" type="text" name="enviar-email"/>
                        </div>
                        <div class="form-group">
                            <label>CC :</label>
                            <input class="form-control" autocomplete="off" id="enviar-email-cc" type="text" name="enviar-email-cc"/>
                        </div>
                        <div class="form-group">
                            <label>Assunto :</label>
                            <input class="form-control" type="text" name="enviar-assunto"/>
                        </div>

                        <div class="form-group">
                            <label>Mensagem :</label>
                            <textarea class="form-control" style="height: 100px" name="enviar-mensagem"></textarea>
                        </div>

                        <button class="btn btn-success" type="submit">Enviar</button>
                        <button class="btn btn-yellow" type="submit">Limpar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>