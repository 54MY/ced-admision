<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("location: ../index.php"); 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="#" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
        crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg=="
        crossorigin="anonymous">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
    body {
        background-color: #f5f5f5;
    }

    #buscar:focus {
        outline: none !important;
    }

    #buscar {
        background-image: url(../vendor/searchicon.png);
        background-position: 10px 7px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 13px;
        padding: 7px 17px 7px 38px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }
    </style>

</head>

<body>
    <?php
        include("../config/db.php");
        include("../config/conexion.php");
        include("../config/alertas.php");
        if(isset($_POST['aprobar'])){
            $id_user = addslashes ($_POST['id_user']);
            if (empty($id_user)){
                $mensaje='Usuario incorrecto';
                popUpWarning($mensaje);
            }
            $sql = "UPDATE cedadmision.Postulante SET Estado_Direccion='apto', Usuario_Direccion='".$_SESSION['admin']."' WHERE id=" .$id_user;
            $retval = mysqli_query($con,$sql);
            if($retval) {
                $mensaje = 'El postulante ahora pasará a ser alumno oficial del C.E.D.';
                popUpSuccess('Postulante autorizado', $mensaje);
            } else if(! $retval ) {
                $mensaje = 'Nose pudo registrar, contacte al administrador';
                popUpEnd('Error en Servidor',$mensaje);
               die('Could not enter data: ' . mysqli_error());
            }
        }
    ?>
    </br>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-md-2 ">
                <div class="text-center">
                    <img src="../images/logos/pv_blanco.png" alt="" style="border-radius: 100%;" width="150"
                        height="150">
                    </br>
                    </br>
                    <a href="../controler/logout.php" class="btn btn-info btn-sm" role="button"
                        aria-pressed="true">Cerrar
                        sesión</a>
                    </br>
                    </br>
                </div>
            </div>
            <div class="col-md-10">
                <div>
                    <h2>Perfil de Dirección - <?php echo $_SESSION['admin']; ?></h2>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#1" data-toggle="tab">Postulantes</a>
                    </li>
                    <li><a href="#2" data-toggle="tab">Cuenta</a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active" id="1">
                        </br>
                        <div class="col-md-4 col-md-offset-10">
                            <a href="../controler/export.php" class="btn btn-info btn-sm" role="button"
                                aria-pressed="true">Imprimir excel</a>
                        </div>
                        </br>
                        </br>
                        <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por Nombres"
                            title="Buscar por Nombres">
                        <div class="table-responsive">
                            <?php
                                include("../config/db.php");
                                include("../config/conexion.php");
                                require('../libraries/simplehtmldom_1_9_1/simple_html_dom.php');
                                $query = "SELECT id, Nombres, Apellidos, Edad, Sexo, Celular, Lugar_Nacimiento, Pais, Correo, Foto_Perfil, Foto_Carnet, Carta_Referencia, Foto_Bachiler, Estado_Vida, Estado_Direccion, Usuario, Vacuna, Fecha_Nacimiento, Cedula FROM Postulante WHERE Estado_Vida='apto'";
                                $result = mysqli_query($con,$query); 
                                echo '<table id="postulante-tabla" class="table table-striped">';
                                echo '<thead>
                                        <tr>
                                            <th></th>
                                            <th>id</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>';
                                while($row = $result->fetch_assoc()){
                                    if ($row['Estado_Direccion']=='apto'){
                                        echo '<tr class="success">';
                                    } else {
                                        echo '<tr class="warning">';
                                    }
                                        echo '<td><a><span class="detalles-cuenta fa fa-search" 
                                                data-foto-perfil="' . base64_encode($row['Foto_Perfil']) . '"
                                                data-nombre="' . $row['Nombres'] . '"
                                                data-apellido="' . $row['Apellidos'] . '"
                                                data-edad="' . $row['Edad'] . '"
                                                data-sexo="' . $row['Sexo'] . '"
                                                data-celular="' . $row['Celular'] . '"
                                                data-ciudad="' . $row['Lugar_Nacimiento'] . '"
                                                data-pais="' . $row['Pais'] . '"
                                                data-usuario="' . $row['Usuario'] . '"
                                                data-correo="' . $row['Correo'] . '"
                                                data-toggle="modal" data-target="#detallesCuenta"></span></a></td>';
                                        if ($row['Vacuna']=='si'){
                                            $arrContextOptions=array(
                                                "ssl"=>array(
                                                    "verify_peer"=>false,
                                                    "verify_peer_name"=>false,
                                                ),
                                            );
                                            $ruta = "https://sus.minsalud.gob.bo/buscar_vacuna_pagina?tipodocumento_vacuna=1&nrodocumento_vacuna=". $row['Cedula'] ."&fechanacimiento_vacuna=". $row['Fecha_Nacimiento'] ."";
                                            $html = file_get_html($ruta, false, stream_context_create($arrContextOptions));
                                            foreach($html->find('a') as $a) {
                                                if($a->href) {
                                                    echo '<td><a type="button" class="btn btn-success" href="https://sus.minsalud.gob.bo'. $a->href . '">' . $row['id'] . '</a></td>';
                                                }
                                            }
                                        } else {
                                            echo '<td align="center">' . $row['id'] . '</td>';
                                        }
                                        echo '<td>' . $row['Nombres'] . '</td>';
                                        echo '<td>' . $row['Apellidos'] . '</td>';
                                        echo '<td align="center">' . $row['Edad'] . '</td>';
                                        echo '<td>' . $row['Celular'] . '</td>';
                                        if ($row['Estado_Direccion']=='apto'){
                                            echo '<td><button type="button" class="autorizar-postulante btn btn-success btn-sm">Autorizado</button></td>';
                                        } else {
                                            echo '<td><button type="button" class="autorizar-postulante btn btn-warning btn-sm" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#autorizarPostulante">Aprobar</button></td>';
                                        }
                                    echo '</tr>';
                                }
                                echo '</table>';
                                $result->close();
                                mysqli_close($con);
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="2">
                        </br>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Usuario</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <i>nada por ahora<?php echo $usuario; ?></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Acampante -->
        <div class="modal fade" id="cambiarContrasena" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel">Nueva contraseña</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <input name="userPassword" type="text" id="userPassword"
                                class="form-control input-sm chat-input" placeholder="contraseña" minlength="8" />
                            <input style="display:none" name="id_user" id="id_user"
                                class="form-control input-sm chat-input" type="text" />
                            </br>
                            <div class="wrapper">
                                <span class="group-btn">
                                    <button type="submit" name="cambiar" class="btn btn-info">Guardar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aprobar Postulante -->
        <div class="modal fade" id="autorizarPostulante" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel"><strong>Aprobar postulante</strong></h5>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <p>Al darle aceptar, esta confirmando que el postulante es apto para poder participar del
                                C.E.D. 2022. El cual pasará a su validacion en Administración</p>
                            <input style="display:none" name="id_user" id="id_user"
                                class="form-control input-sm chat-input" type="text" />
                            </br>
                            <div class="wrapper">
                                <span class="group-btn">
                                    <button type="submit" name="aprobar" class="btn btn-info">Aprobar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Postulante -->
        <div class="modal fade" id="detallesCuenta" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel"><strong>Detalles Usuario</strong></h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fotoPerfil); ?>"
                                    id="foto-perfil" alt="" class="img-thumbnail mx-auto d-block"
                                    style="display: block;margin-left: auto;margin-right: auto;" width="150" height="150">
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nombres</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="nombre" id="nombre"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Apellidos</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="apellido" id="apellido"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Edad</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="edad" id="edad"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Sexo</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="sexo" id="sexo"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Celular</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="celular" id="celular"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Pais</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="pais" id="pais"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Ciudad</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="ciudad" id="ciudad"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Usuario</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="usuario" id="usuario"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Correo</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <i><span name="correo" id="correo"></span></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
    $(document).on("click", ".cambiar-contrasena", function() {
        var myBookId = $(this).data('id');
        $(".modal-body #id_user").val(myBookId);
    });
    </script>

    <script type="text/javascript">
    $(document).on("click", ".autorizar-postulante", function() {
        var myBookId = $(this).data('id');
        $(".modal-body #id_user").val(myBookId);
    });
    </script>

    <script type="text/javascript">
    $(document).on("click", ".detalles-cuenta", function() {
        var foto_perfil = $(this).data('foto-perfil');
        $(".modal-body #foto-perfil").attr('src', 'data:image/png;charset=utf8;base64,' + foto_perfil);
        var nombre = $(this).data('nombre');
        $(".modal-body #nombre").text(nombre);
        var apellido = $(this).data('apellido');
        $(".modal-body #apellido").text(apellido);
        var edad = $(this).data('edad');
        $(".modal-body #edad").text(edad);
        var sexo = $(this).data('sexo');
        $(".modal-body #sexo").text(sexo);
        var celular = $(this).data('celular');
        $(".modal-body #celular").text(celular);
        var pais = $(this).data('pais');
        $(".modal-body #pais").text(pais);
        var ciudad = $(this).data('ciudad');
        $(".modal-body #ciudad").text(ciudad);
        var usuario = $(this).data('usuario');
        $(".modal-body #usuario").text(usuario);
        var correo = $(this).data('correo');
        $(".modal-body #correo").text(correo);
    });
    </script>

    <script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("buscar");
        filter = input.value.toUpperCase();
        table = document.getElementById("postulante-tabla");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>

</body>

</html>