<?php
    session_start();
    if (isset($_SESSION['admin'])) {
        header("location: direccion/index.php"); 
    }
    if (isset($_SESSION['postulante'])) {
        header("location: postulante/index.php"); 
    }
    include('controler/login.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admision CED</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">Centro de Evangelismo y Discipulado</span>
        <span class="site-heading-lower">C.E.D.</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="index.php">Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="about.php">Acerca</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="products.php">Actividades</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="store.php">Historia</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" role="button" aria-pressed="true"
                            data-toggle="modal" data-target="#ingresar" href="#">Iniciar session</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <form class="form-signin" action="#" method="post">
        <div class="modal fade" id="ingresar" tabindex="-1" role="dialog" aria-labelledby="ingresarLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title center" id="ingresarLabel">Iniciar sesion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="username" type="user" id="userName" class="form-control input-sm chat-input"
                            placeholder="Nombres de usuario" />
                        </br>
                        <input name="password" type="password" id="userPassword"
                            class="form-control input-sm chat-input" placeholder="contraseña" />
                        </br>
                        <a class="example-popover" data-toggle="popover" title="Habla con nosotros"
                            data-content="WhatsApp +591 77777777">Olvidaste tu contraseña?</a>
                        </br>
                        </br>
                        <div class="wrapper">
                            <span class="group-btn">
                                <input name="submit" class="btn btn-primary btn-md" type="submit" value="Ingresar">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpeg" alt="">
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Centro de Evangelismo y Discipulado</span>
                        <span class="section-heading-lower">C.E.D.</span>
                    </h2>
                    <p class="mb-3">El C.D.E. tiene como ibjetivo principal el incentivar, entrenar y equipar al alumno
                        en el área
                        de Evangelismo y Discipulado, inculcando Valores y Principios Bíblicos para su Vida Cristiana
                    </p>
                    <div class="intro-button mx-auto">
                        <a class="btn btn-primary btn-xl" href="registro.php">Postulate ya!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Centro de Evangelismo y Discipulado</span>
                            <span class="section-heading-lower">C.E.D.</span>
                        </h2>
                        <p class="mb-0">El C.D.E. tiene como ibjetivo principal el incentivar, entrenar y equipar al
                            alumno
                            en el área
                            de Evangelismo y Discipulado, inculcando Valores y Principios Bíblicos para su Vida
                            Cristiana</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; Your Website 2020</p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php
        if (!empty($error)) {
            include("config/alertas.php");
            popUpWarning($error);
        }
    ?>
    <script>
    $(function() {
        $('.example-popover').popover({
            container: 'body'
        })
    })
    </script>

</body>

</html>