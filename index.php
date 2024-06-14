<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.html");
    exit();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Panel de Bienvenida</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

        <nav
            class="navbar navbar-expand-lg navbar-light bg-light"
        >
            <div class="container">
                <a class="navbar-brand" href="#">Panel Administrador</a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="https://dpw1-u2-ea-seaa.000webhostapp.com/">Pagina Resevaciones turisticas 000WebHost</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="http://www.youtube.com/@sergioalanis8741">Youtube Serge</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cerrar.php">Cerrar</a><br>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
        
<br/>

<div class="container">
<div class="row justify-content-center align-items-center">
    <div class="col">
        <h2>Inicio de la  aplicación Bienvenid@ <?php echo  $_SESSION['usuario_nombre']; ?></h2>
        <p>Estes es el inicio de la aplicación</p></div>
</div>

</div>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Practica pagina Login</div>
            <div class="card-body">
                <h4 class="card-title">Aqui va el subtitulo</h4>
                <img src="landingPage.jpg" class="card-img" alt="landing page">

                <p class="card-text">Descripcion breve acerca del sitio</p>
                <a href="https://dpw1-u2-ea-seaa.000webhostapp.com/" class="btn btn-success">Acceder a la pagina de reservaciones turisticas</a>

            </div>
        </div>
        
    </div>
</div>



        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>



