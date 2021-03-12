<?php
    include("../config/db.php");
    include("../config/conexion.php");
    
    session_start();
    $user_check=$_SESSION['postulante'];
    $ses_sql=mysqli_query($con, "SELECT Cedula, Expedido, Nombres, Apellidos, Sexo, Lugar_Nacimiento, Fecha_Nacimiento, Estado_Civil,
        Edad, Direccion_Departamento, Direccion_Domicilio, Celular, Correo, Foto_Perfil, Foto_Carnet, Estado_Vida, Estado_Direccion, Usuario FROM cedadmision.Postulante WHERE Usuario = '$user_check'");
    $row = mysqli_fetch_assoc($ses_sql);

    $usuario =$row["Usuario"];
    $correo =$row["Correo"];
    $nombres =$row["Nombres"];
    $apellidos =$row["Apellidos"];
    $edad =$row["Edad"];
    $celular =$row["Celular"];
    $ciudad =$row["Direccion_Departamento"];
    $fotoPerfil =$row["Foto_Perfil"];
    $fotoCarnet =$row["Foto_Carnet"];
    $estadoVida =$row["Estado_Vida"];
    $estadoDireccion =$row["Estado_Direccion"];

    if (!isset($_SESSION['postulante'])) {
        header("location: ../index.php"); 
    }
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Postulante</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="#" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
        crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg=="
        crossorigin="anonymous">

    <style>
    body {
        background-color: #f5f5f5;
    }

    .blink {
        position: relative;
        animation-name: example;
        animation-duration: 3s;
        animation-iteration-count: infinite;
        text-align: center;
    }

    @keyframes example {
        0% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }

        75% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
    </style>
</head>

<body>
    </br>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="text-center">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fotoPerfil); ?>" alt=""
                        style="border-radius: 100%;" width="150" height="150">
                    </br>
                    </br>
                    <?php 
                        if (empty($estadoVida) && empty($estadoDireccion)) {
                            echo '<div class="blink" style="color: red;">';
                            echo '<p>Pendinete a revision en vida</p>';
                            echo '</div>';
                        } else if (!empty($estadoVida) && empty($estadoDireccion)) {
                            echo '<div class="blink" style="color: orange;">';
                            echo '<p>Ahora puede ir al apartado de Información y realizar los depositos</p>';
                            echo '</div>';
                        } else if (!empty($estadoVida) && !empty($estadoDireccion)) {
                            echo '<div class="blink" style="color: green;">';
                            echo '<p>Felicidades!!! ya esres un alumno!!!</p>';
                            echo '</div>';
                        }
                    ?>
                    <a href="../controler/logout.php" class="btn btn-info btn-sm" role="button"
                        aria-pressed="true">Cerrar sesión</a>
                </div>
            </div>
            <div class="col-md-8">
                <div>
                    <h2>Perfil de postulante</h2>
                </div>
                <div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#1" data-toggle="tab">Datos personales</a>
                        </li>
                        <li><a href="#2" data-toggle="tab">Información</a>
                        </li>
                        <li><a href="#3" data-toggle="tab">Cuenta</a>
                        </li>
                    </ul>
                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Nombres</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <i><?php echo $nombres; ?></i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Apellidos</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <i><?php echo $apellidos; ?></i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Edad</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <i><?php echo $edad; ?></i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Celular</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <i><?php echo $celular; ?></i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Ciudad</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <i><?php echo $ciudad; ?></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            </br>
                            </br>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <?php
                                            if (empty($estadoVida) && empty($estadoDireccion)) {
                                        ?>
                                        <i><b>AGUARDE:</b>
                                            el equipo de Vida se comunicará con su persona mediante los numeros
                                            telefónicos proporcionados</i>
                                        <?php
                                            } else if (!empty($estadoVida) && empty($estadoDireccion)) {
                                        ?>
                                        <i><b>PAGO CED 2021:</b>
                                            Una vez completado los requisitos y haber seguido todos los pasos de
                                            Admisión, debes realizar el Pago Correspondiente a CED 2021.
                                            Los Pasos a seguir, son los siguientes:</i>
                                        </br>
                                        </br>
                                        <p class="mb-0">
                                        <ul style="list-style : none;">
                                            <li>
                                                <ul>
                                                    <li>
                                                        Realizar el depósito de Bs.2700 (Este monto NO cubre
                                                        el año entero, es
                                                        sólo el pago de Matrícula + 2 cuotas) a la cuenta Bancaria:
                                                        <ul>
                                                            <li>
                                                                BANCO FASSIL
                                                            </li>
                                                            <li>
                                                                Nombre: Paola Vanessa
                                                            </li>
                                                            <li>
                                                                Jiménez Vargas
                                                            </li>
                                                            <li>
                                                                C.I.: 6362598 SC
                                                            </li>
                                                            <li>
                                                                Número: 4396101
                                                            </li>
                                                            <li>
                                                                Detalle: CUOTA CED 2021
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li>
                                                        Mandar una foto del comprobante de depósito que sea visible (es
                                                        decir
                                                        que la foto no esté borrosa) al WhatsApp: 71785498
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li>
                                                        Incluir en el mensaje con la foto del comprobante:
                                                        <ul>
                                                            <li>
                                                                Nombre Completo del Esrudiante
                                                            </li>
                                                            <li>
                                                                Ciudad
                                                            </li>
                                                            <li>
                                                                Celular del Estudiante
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        </p>
                                        </br>
                                        <p><b>Bendiciones!!!</b></p>
                                        <?php
                                            } else if (!empty($estadoVida) && !empty($estadoDireccion)) {
                                                echo '<div class="blink" style="color: green;">';
                                                echo '<p>Felicidades!!! ya esres un alumno!!!</p>';
                                                echo '</div>';
                                                echo '<a href="../vendor/declaracion.pdf" download="DECLARACIÓN DE CONSENTIMEINTO">Descargar archivo de consentimiento</a>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3">
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Usuario</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <i><?php echo $usuario; ?></i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Correo</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <i><?php echo $correo; ?></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    </hr>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>