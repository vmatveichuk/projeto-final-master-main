<?php
require 'main.php';

if (empty($_SESSION['user']['nome'])) {
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>iTranning</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /*
        .d-none {
                display: block!important;
        }
        */
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }

            .d-md-block {
                display: block !important;
            }

        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">iTranning</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Procurar" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="login.php">Sair</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">

                    <div class="alert alert-secondary" role="alert">
                        Olá, <?= $_SESSION['user']['nome'] ?>
                    </div>


                    <?php
                    if ($_SESSION['user']['idtipo'] == 1) :
                        ?>
                        <div>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Aluno</span>
                            </h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">
                                        <span data-feather="home"></span>
                                        Inicio <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="consultar_treinos.php">
                                        <span data-feather="search"></span>
                                        Consultar Treino
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="realizar_treino.php">
                                        <span data-feather="zap"></span>
                                        Realizar Exercicios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="chat_aluno.php">
                                        <span data-feather="users"></span>
                                        Chat com Professor
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php
                endif;
                ?>
                    <?php
                    if ($_SESSION['user']['idtipo'] == 2) :
                        ?>
                        <div>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Professor</span>
                            </h6>

                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="adm_exercicios.php">
                                        <span data-feather="activity"></span>
                                        Exercicios
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="chat_professor.php">
                                        <span data-feather="users"></span>
                                        Chat com Alunos
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php
                endif;
                ?>

                    <?php
                    if ($_SESSION['user']['idtipo'] == 3) :
                        ?>
                        <div>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Avaliador Físico</span>
                            </h6>

                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="estado_fiscio_atleta.php">
                                        <span data-feather="activity"></span>
                                        Estado Físico Atleta
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php
                endif;
                ?>

                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">