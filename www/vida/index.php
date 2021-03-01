<?php
    session_start();
    if (!isset($_SESSION['vida'])) {
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
    </style>

</head>

<body>
    <?php
        include("../config/db.php");
        include("../config/conexion.php");
        include("../config/alertas.php");
        if(isset($_POST['cambiar'])){
            $contrasena = addslashes ($_POST['userPassword']);
            if (empty($contrasena)){
                $mensaje='Campo contraseña requerido';
                popUpWarning($mensaje);
            }
            $contrasena =  sha1($contrasena);
            $id_user = addslashes ($_POST['id_user']);
            if (empty($id_user)){
                $mensaje='Usuario incorrecto';
                popUpWarning($mensaje);
            }
            $sql = "UPDATE cedadmision.Postulante SET Contrasena='$contrasena' WHERE id=" .$id_user;
            $retval = mysqli_query($con,$sql);
            if($retval) {
                $mensaje = 'Cambio de contraseña exitoso';
                popUpSuccess('Contraseña actualizada', $mensaje);
            } else if(! $retval ) {
                $mensaje = 'Nose pudo registrar';
                popUpWarning($mensaje);
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
                    <h2>Perfil de Vida</h2>
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
                        <div class="table-responsive">
                            <?php
                                include("../config/db.php");
                                include("../config/conexion.php");
                                $query = "SELECT id, Nombres, Apellidos, Edad, Celular, Lugar_Nacimiento FROM Postulante";
                                $result = mysqli_query($con,$query); 
                                echo '<table class="table table-striped">';
                                echo '<thead>
                                        <tr>
                                            <th></th>
                                            <th>id</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Ciudad</th>
                                            <th>Contraseña</th>
                                        </tr>
                                    </thead>';
                                while($row = $result->fetch_assoc()){
                                    echo '<tr>';
                                        echo '<td><a><span class="fa fa-search" data-toggle="modal" data-target="#detallesCuenta"></span></a></td>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['Nombres'] . '</td>';
                                        echo '<td>' . $row['Apellidos'] . '</td>';
                                        echo '<td>' . $row['Edad'] . '</td>';
                                        echo '<td>' . $row['Celular'] . '</td>';
                                        echo '<td>' . $row['Lugar_Nacimiento'] . '</td>';
                                        echo '<td><button type="button" class="cambiar-contrasena btn btn-default btn-sm" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#cambiarContrasena">Cambiar</button><td>';
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

        <!-- Modal Acampante -->
        <div class="modal fade" id="detallesCuenta" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel">Detalles Usuario</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Nombres</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Apellidos</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Edad</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Celular</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Pais</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Ciudad</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Usuario</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Correo electronico">Correo</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <i>Ejemplo ....</i>
                                </div>
                            </div>
                        </div>
                        </br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Link Taller -->
        <div class="modal fade" id="linkTaller" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel">Insertar Link de la sala</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <input name="link_sala" type="text" id="link_sala" class="form-control input-sm chat-input"
                                placeholder="link de sala" />
                            <input style="display:none" name="id_taller" id="id_taller"
                                class="form-control input-sm chat-input" type="text" />
                            </br>
                            <div class="wrapper">
                                <span class="group-btn">
                                    <button type="submit" name="insert_link" class="btn btn-info">Crear</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Crear Taller -->
        <div class="modal fade" id="crearTaller" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title center" id="exampleModalLabel">Detalles Taller</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="Nombre taller">Nombre taller</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <em class="fa fa-university"></em>
                                        </div>
                                        <input require="true" id="nombreTaller" name="nombreTaller" type="text"
                                            placeholder="Nombre taller" class="form-control input-md">
                                    </div>
                                </div>
                                </br>
                                </br>
                                <label class="col-md-3 control-label" for="Taller">Taller para</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <em class="fa fa-users"></em>
                                        </div>
                                        <select require="true" class="form-control" id="edades" name="edades">
                                            <option value="" selected>Selecciona la categoria</option>
                                            <option value="MAYORES">Mayores</option>
                                            <option value="MENORES">Menores</option>
                                        </select>
                                    </div>
                                </div>
                                </br>
                                </br>
                                <button type="submit" name="taler" class="btn btn-info">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
    $(document).on("click", ".link-taller", function() {
        var myBookId = $(this).data('id');
        $(".modal-body #id_taller").val(myBookId);
    });
    </script>

    <script type="text/javascript">
    $(document).on("click", ".cambiar-contrasena", function() {
        var myBookId = $(this).data('id');
        $(".modal-body #id_user").val(myBookId);
    });
    </script>

</body>

</html>