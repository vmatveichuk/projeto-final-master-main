<?php

?>
<html>
    <head>
        <title>Registrar Usuário</title>
        <meta charset='utf-8'>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/index.css"/>
    </head>
    <body id="body-login">
        <div id="divRegistrarExterno">
            <div id="divRegistrarInterno">
                <h3 class="text-center">Registrar-se</h3>
                <form>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" type="text" name="registrar-nome" />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="registrar-email" />
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <input class="form-control" type="password" name="registrar-senha" />
                    </div>

                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input class="form-control" type="password" name="registrar-confirsenha" />
                    </div>

                    <button class="btn btn-success">Cadastrar</button>
                    <a href="../index.php" class="btn btn-primary">Login</a>
                </form>
            </div>
        </div>
    </body>
</html>
