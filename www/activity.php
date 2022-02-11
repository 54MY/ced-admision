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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CED Palabra de Vida Bolivia</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

</head>

<body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">Admision Centro de Evangelismo y Discipulado</span>
        <span class="site-heading-lower">C.E.D.</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Admision C.E.D.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="index.php">Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="about.php">Quienes somos</a>
                    </li>
                    <li class="nav-item active px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="activity.php">Experiencias</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="contact.php">Contacto</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" href="requirements.php">Requisitos</a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" role="button" aria-pressed="true"
                            data-toggle="modal" data-target="#ingresar" href="#">Iniciar sesion</a>
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

    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex ml-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Experciencia con</span>
                            <span class="section-heading-lower">La Palabra de Dios</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0"
                    src="images/products-02.jpeg" alt="">
                <div class="product-item-description d-flex mr-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">Una experiencia totalmente centrada en la Palabra de Dios, que te permitirá
                            disfrutar de la enseñanza de profesores que te acompañarán en el desarrollo de un estudio
                            Bíblico personal.
                        </p>
                        </br>
                        <p class="mb-0">
                            Preparándote con una base sólida para la vida.
                        </p>
                        </br>
                        <li class="nav-item px-lg-4">
                            <a><b>Primer año:</b> Curso básico, con enfasis en evangelismo y discipulado (16
                                materias)</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a><b>Segundo año:</b> Curso teológico (16 materias)</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex mr-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Expriencia con</span>
                            <span class="section-heading-lower">El diario vivir</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0"
                    src="images/products-01.jpeg" alt="">
                <div class="product-item-description d-flex ml-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">Te permite aplicar el conocimiento adquirido en al aula a tu diario vivir.
                            Cultivando un compañerismo en el aula, cuartos, deporte, etc.
                        </p>
                        </br>
                        Tendrás la oportunidad de recibir un acompañamiento espiritual por parte de los misioneros de
                        Palabra de Vida Bolivia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex ml-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Experiencia con</span>
                            <span class="section-heading-lower">La obra de Dios</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0"
                    src="images/products-03.jpeg" alt="">
                <div class="product-item-description d-flex mr-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">Nuestro deseo es equipar al estudiante con experiencias ministeriales que le
                            lleven a marcar una diferencia en su Iglesia local.
                        </p>
                        </br>
                        <p class="mb-0">
                            Debido al riesgo significativo que atravesamos por la pandemia, los alumnos no podrán salir
                            de minsiterio a las Iglesias locales, pero mientras esperamos la oportunidad de un servicio
                            presencial, ofreceremos talleres extracurriculares y recursos virtuales que te servirán en
                            tu
                            futuro minsterio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; www.admisionced.com 2022</p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>