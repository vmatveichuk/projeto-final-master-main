<?php
    require '../autoload.php';
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
                    <p>Arquivo Morto</p>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>De</th>
                        <th>Assunto</th>
                        <th>Mensagem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan='3'>Arquivo Morto vazio</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
