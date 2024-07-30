<?php
    function VisitorTopbar(){
?>
    <header>
        <nav class="navbar navbar-expand-md navbar-ligth fixed-top bg-ligth" style="opacity:0.95;">
            <div class="container">
            <a class="navbar-brand" href="#">
                <button type="button" class="btn btn-link navbar-brand" onclick="window.location.href='/'">
                <h6>Grade</h6>
                </button>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo "Nome do usuario"; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button type="button" class="dropdown-item" onclick="window.location.href='/sx/perfil'">Perfil</button>
                            <button type="button" class="dropdown-item" onclick="window.location.href='/sx/logout'">Sair</button>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
<?php } ?>
