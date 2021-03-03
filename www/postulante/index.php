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
                            echo '<p>Ahora puede comunicarse y realizar los depositos</p>';
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
                        <li><a href="#2" data-toggle="tab">Familiar</a>
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
                                <label class="col-md-2 control-label" for="Correo electronico">Datos Padre</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <a href="data:image/pdf;charset=utf8;base64,<?php echo base64_encode($fotoCarnet); ?>"
                                            download="fotoCarnet.pdf">
                                            <img src="data:image/pdf;charset=utf8;base64,<?php echo base64_encode($fotoCarnet); ?>"
                                                alt="fotoCarnet">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <i>Apellidos</i>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Correo electronico">Direccion</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <i>Departamento</i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <i>Direccion</i>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <i>Telefono</i>
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