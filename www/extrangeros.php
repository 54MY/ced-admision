<?php
    if(isset($_SESSION['acampante'])){
        header("location: postulante/profile.php");
    } else if(isset($_SESSION['admin'])){
        header("location: direccion/index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de postulantes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="#" />
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg=="
        crossorigin="anonymous">
    <!-- Bootstrap datetimepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js">
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style type="text/css">
    body {
        padding-top: 70px;
        padding-bottom: 70px;
    }
    </style>
</head>

<body>
    <?php
        include("config/db.php");
        include("config/conexion.php");
        include("config/alertas.php");

        if(isset($_POST['registrar'])){
            $cedula = addslashes($_POST['cedula']);
            if (empty($cedula)) {
                $mensaje = 'Numero de cedula requerido';
                popUpWarning($mensaje);
            }
            $expedido = addslashes($_POST['expedido']);
            if (empty($expedido)) {
                $mensaje = 'Campo expedido requerido';
                popUpWarning($mensaje);
            }
            $nombres = addslashes($_POST['nombres']);
            if (empty($nombres)) {
                $mensaje = 'Campo nombres requerido';
                popUpWarning($mensaje);
            }
            $apellidos = addslashes($_POST['apellidos']);
            if (empty($apellidos)) {
                $mensaje = 'Campo apellidos requerido';
                popUpWarning($mensaje);
            }
            $sexo = addslashes($_POST['sexo']);
            if (empty($sexo)) {
                $mensaje = 'Campo sexo requerido';
                popUpWarning($mensaje);
            }
            $pais = addslashes($_POST['pais']);
            if (empty($pais)) {
                $mensaje = 'Campo pais requerido';
                popUpWarning($mensaje);
            }
            $lugarnacimiento = addslashes($_POST['lugarnacimiento']);
            if (empty($lugarnacimiento)) {
                $mensaje = 'Debe ingresar su lugar de nacimiento';
                popUpWarning($mensaje);
            }
            $fechanacimiento = addslashes($_POST['fechanacimiento']);
            if (empty($fechanacimiento)) {
                $mensaje = 'Debe isertar su fecha de nacimiento';
                popUpWarning($mensaje);
            }
            $estadocivil = addslashes($_POST['estadocivil']);
            if (empty($estadocivil)) {
                $mensaje = 'Su estado civil es requerido';
                popUpWarning($mensaje);
            } else if ($estadocivil != 'Soltero') {
                $conyugenombre = addslashes ($_POST['conyugenombre']);
                $conyugeapellido = addslashes ($_POST['conyugeapellido']);
                $datosconyuge = $conyugenombre . ' ' . $conyugeapellido;
                if (empty($conyugenombre) && empty($conyugeapellido)){
                    $mensaje='Datos del conyuge requerido';
                    popUpWarning($mensaje);
                }
            }
            $hijos = addslashes ($_POST['hijos']);
            $edad = addslashes($_POST['edad']);
            if (empty($edad)) {
                $mensaje = 'Debe elegir su edad';
                popUpWarning($mensaje);
            } else if ($edad <= 18 && $edad >= 70) {
                $mensaje = 'Rango edad no permitido';
                popUpWarning($mensaje);
            }
            $direcciondep = addslashes($_POST['direcciondep']);
            if (empty($direcciondep)) {
                $mensaje = 'Seleccione el depertamente donde vive';
                popUpWarning($mensaje);
            }
            $domicilio = addslashes($_POST['domicilio']);
            if (empty($domicilio)) {
                $mensaje = 'Ingrese el domicilio donde vive';
                popUpWarning($mensaje);
            }
            $celular = addslashes($_POST['celular']);
            if (empty($celular)) {
                $celular = 0;
            }
            $correo = addslashes($_POST['correo']);
            if (empty($correo)) {
                $mensaje = 'Ingrese su correo';
                popUpWarning($mensaje);
            }
            $ocupacion = addslashes($_POST['ocupacion']);
            $nombreiglesia = addslashes($_POST['nombreiglesia']);
            if (empty($nombreiglesia)) {
                $mensaje = 'Ingrese el nombre de la iglesia';
                popUpWarning($mensaje);
            }
            $denominacion = addslashes($_POST['denominacion']);
            if (empty($denominacion)) {
                $mensaje = 'Ingrese la denominacion';
                popUpWarning($mensaje);
            }
            $direccioniglesia = addslashes($_POST['direccioniglesia']);
            if (empty($direccioniglesia)) {
                $mensaje = 'Ingrese la direccion de la iglesia';
                popUpWarning($mensaje);
            }
            $domicilioiglesia = addslashes($_POST['domicilioiglesia']);
            if (empty($domicilioiglesia)) {
                $mensaje = 'Ingrese el domicilio de la iglesia';
                popUpWarning($mensaje);
            }
            $miembro = addslashes($_POST['miembro']);
            if (empty($miembro)) {
                $mensaje = 'Seleccione si es miembro de la iglesia';
                popUpWarning($mensaje);
            }
            $bautizado = addslashes($_POST['bautizado']);
            if (empty($bautizado)) {
                $mensaje = 'Seleccione si es bautizado de la iglesia';
                popUpWarning($mensaje);
            }
            $pastor = addslashes($_POST['pastor']);
            if (empty($pastor)) {
                $mensaje = 'Ingrese el nombre del pastor';
                popUpWarning($mensaje);
            }
            $telefonopastor = addslashes($_POST['telefonopastor']);
            if (empty($telefonopastor)) {
                $mensaje = 'Ingrese el telefono del pastor';
                popUpWarning($mensaje);
            }
            $correpastor = addslashes($_POST['correpastor']);
            if (empty($correpastor)) {
                $mensaje = 'Ingrese el correo del pastor';
                popUpWarning($mensaje);
            }
            $testimonio = addslashes($_POST['testimonio']);
            if (empty($testimonio)) {
                $mensaje = 'Ingrese su testimonio';
                popUpWarning($mensaje);
            }
            $postulacion = addslashes($_POST['postulacion']);
            if (empty($postulacion)) {
                $mensaje = 'Debe elegir el año de postulación';
                popUpWarning($mensaje);
            }
            $usuario = addslashes($_POST['usuario']);
            if (empty($usuario)) {
                $mensaje = 'Ingrese su usuario';
                popUpWarning($mensaje);
            }
            $contrasena = addslashes($_POST['contrasena']);
            if (empty($contrasena)){
                $mensaje='Campo contraseña requerido';
                popUpWarning($mensaje);
            }
            $contrasena =  sha1($contrasena);

            $sql = "INSERT INTO cedadmision.Postulante (Cedula, Expedido, Nombres, Apellidos, Sexo, Pais, Lugar_Nacimiento, Fecha_Nacimiento, Estado_Civil, Edad, Datos_Conyugue, Datos_Hijos, Direccion_Departamento, Direccion_Domicilio, Celular, Correo, Ocupacion, Nombre_Iglesia, Denominacion, Direccion_Iglesia, Domicilio_Iglesia, Miembro_Iglesia, Bautizado, Nombre_Pastor, Telefono_Pastor, Correo_Pastor, Testimonio, Postulacion, Usuario, Contrasena)
                    VALUES($cedula, '$expedido', '$nombres', '$apellidos', '$sexo', '$pais', '$lugarnacimiento', '$fechanacimiento', '$estadocivil', $edad, '$datosconyuge', '$hijos', '$direcciondep', '$domicilio', $celular, '$correo', '$ocupacion','$nombreiglesia', '$denominacion', '$direccioniglesia', '$domicilioiglesia', '$miembro', '$bautizado', '$pastor', $telefonopastor, '$correpastor', '$testimonio', '$postulacion', '$usuario', '$contrasena')";

            $retval = mysqli_query($con,$sql);
            if($retval) {
                $mensaje = 'Te registraste con exito. \n\n\n En unos días nos comunicaremos contigo';
                popUpSuccess('Registrado con exito', $mensaje);
            } else if(! $retval ) {
                $mensaje = 'Nose pudo registrar';
                popUpEnd('Error en Servidor',$mensaje);
                die('Could not enter data: ' . mysqli_error());
            }

            //popUpEnd('Inscripciones cerradas','El proceso de inscripcion a terminado');
        }
    ?>

    <div class="container">
        <div class="row">
            <h2>Formulario para postulantes extrajeros</h2>
            <div class="col-md-10 ">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <legend>Datos personales</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cedula">Número de Cédula de Identidad
                                (C.I.)</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="number" class="form-control" id="cedula" name="cedula"
                                        placeholder="Cédula de Identidad">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="expedido" name="expedido"
                                    placeholder="expedido">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombres">Nombres y Apellidos</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        placeholder="Nombres">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="sexo">Sexo</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="sexo" id="sexo"
                                        value="Masculino">
                                    <label class="col-sm-2 form-check-label" for="sexo">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="sexo" id="sexo"
                                        value="Femenino">
                                    <label class="col-sm-2 form-check-label" for="sexo">Femenino</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="pais">Pais</label>
                            <div class="col-sm-4">
                                <div class="input-group othertop">
                                    <div class="input-group-addon">
                                        <em class="fa fa-globe"></em>
                                    </div>
                                    <select require="true" class="form-control" id="pais" name="pais"
                                        onclick="selectCountry()">
                                        <option value="" selected>Selecciona una pais</option>
                                        <option value="ARGENTINA">Argentina</option>
                                        <option value="CHILE">Chile</option>
                                        <option value="COLOMBIA">Colombia</option>
                                        <option value="PERU">Peru</option>
                                        <option value="MEXICO">Mexico</option>
                                        <option value="PARAGUAY">Paraguay</option>
                                        <option value="ECUADOR">Ecuador</option>
                                        <option value="URUGUAY">Uruguay</option>
                                        <option value="PANAMA">Panama</option>
                                        <option value="VENEZUELA">Venezuela</option>
                                        <option value="OTROS">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group date" id="calendario" name="calendario">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento"
                                        placeholder="Año/Mes/Dia" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="lugarextrangero">
                            <label class="col-sm-4 control-label" for="ciudadOtro">Escriba su lugar de
                                nacimiento</label>
                            <div class="col-sm-8">
                                <div class="input-group othertop">
                                    <div class="input-group-addon">
                                        <em class="fa fa-globe"></em>
                                    </div>
                                    <input class="form-control" id="lugarnacimiento" type="text"
                                        name="lugarnacimiento" placeholder="Escriba el nombre de su ciudad" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="estadocivil">Estado civil</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <select class="form-control" id="estadocivil" name="estadocivil">
                                        <option value="" selected>Estado civil</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Padre/Madre Soltero(a)">Padre/Madre Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Concubino(a)">Concubino(a)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-birthday-cake"></em>
                                    </div>
                                    <select require="true" class="form-control" id="edad" name="edad">
                                        <option value="" selected>Que edad tienes?</option>
                                        <?php
                                            for ($i = 18; $i <= 70; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="conyugueform" style="display:none">
                            <label class="col-md-4 control-label" for="conyugue">Datos Conyugue</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="conyugenombre" name="conyugenombre"
                                        placeholder="Nombres">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="conyugeapellido" name="conyugeapellido"
                                    placeholder="Apellidos">
                            </div>
                        </div>
                        <div class="form-group" id="hijosform" style="display:none">
                            <label class="col-md-4 control-label">Datos de los hijos</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <textarea class="form-control" id="hijos" name="hijos"
                                        placeholder="Nombre completo y edades" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="direcciondep">Dirección actual</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="direcciondep" name="direcciondep"
                                        placeholder="Direccion actual">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="domicilio" name="domicilio"
                                    placeholder="Provincia, nro de vivienda y calles">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="celular">Teléfonos y correo</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="number" class="form-control" id="celular" name="celular"
                                        placeholder="Teléfono fijo o celular">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="correo" name="correo"
                                    placeholder="Correo electrónico">
                            </div>
                        </div>
                        <legend>Datos Iglesia y pastor</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre Iglesia</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="nombreiglesia" name="nombreiglesia"
                                        placeholder="Nombre de la Iglesia">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <select class="form-control" id="denominacion" name="denominacion">
                                        <option value="" selected>Denominacion:</option>
                                        <option value="LIBRES">LIBRES</option>
                                        <option value="UCE">UCE</option>
                                        <option value="OEN">OEN</option>
                                        <option value="BAUTISTA">BAUTISTA</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Dirección</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="direccioniglesia"
                                        name="direccioniglesia" placeholder="Direccion iglesia">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="domicilioiglesia" name="domicilioiglesia"
                                    placeholder="Provincia, nro de vivienda y calles">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">¿Asiste a esta Iglesia?</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="miembro" id="miembro"
                                        value="si">
                                    <label class="col-sm-2 form-check-label" for="miembro">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="miembro" id="miembro"
                                        value="no">
                                    <label class="col-sm-2 form-check-label" for="miembro">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">¿Eres bautizado?</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="bautizado"
                                        id="bautizado" value="si">
                                    <label class="col-sm-2 form-check-label" for="bautizado">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="bautizado"
                                        id="bautizado" value="no">
                                    <label class="col-sm-2 form-check-label" for="bautizado">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Datos Pastor</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="pastor" name="pastor"
                                    placeholder="Nombre completo">
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" id="telefonopastor" name="telefonopastor"
                                    placeholder="Celular">
                            </div>
                            <div class="col-md-3">
                                <input type="email" class="form-control" id="correpastor" name="correpastor"
                                    placeholder="Correo electrónico">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Escribe tu testimonio de salvación</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <textarea class="form-control" id="testimonio" name="testimonio"
                                        placeholder="Breve descripción" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                        <legend>Adjuntar los archivos de forma obligatoria</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Año al que postula</label>
                            <div class="col-md-4">
                                <select class="form-control" id="postulacion" name="postulacion">
                                    <option value="" selected>Seleccione un año</option>
                                    <option value="PRIMERO">Primer año</option>
                                    <option value="SEGUNDO">Segundo año</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotografia 4X4</label>
                            <div class="col-md-5">
                                <input type="file" name="fotografia" id="fotografia"
                                    accept="image/png, .jpeg, .jpg, image/gif" />
                            </div>
                            <div class="col-md-3">
                                <img id="imgSalida" width="50%" height="50%" src="" alt="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotocopia de carnet</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" id="fotocopiacarnet" lang="es">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Carta de referencia de la Iglesia</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" id="cartareferencia" lang="es">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotocopia certificado bachiller</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" id="certificadobachiller" lang="es">
                            </div>
                        </div>
                        <legend>Definir usuario</legend>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="usuario">usuario</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input class="form-control input-md" id="usuario" require="true" type="text"
                                        placeholder="Nombre de usuario" name="usuario" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="contrasena">contraseña</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-lock"></em>
                                    </div>
                                    <input class="form-control" type="password" id="contrasena" require="true"
                                        placeholder="Contraseña" name="contrasena" minlength="8" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="registrar" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <br />
                <br />
                <hr>
            </div>
        </div>
    </div>
</body>

</html>

<script>
$('#pais').on('change', function() {
    var lugarextrangero = document.getElementById("lugarextrangero");
    var lugarlocal = document.getElementById("lugarlocal");
    var selectedValue = this.value;
    if (selectedValue == "BOLIVIA") {
        lugarlocal.style.display = "block";
        lugarextrangero.style.display = "none";
    } else if (selectedValue != "BOLIVIA" && selectedValue != "") {
        lugarextrangero.style.display = "block";
        lugarlocal.style.display = "none";
    } else {
        lugarlocal.style.display = "none";
        lugarextrangero.style.display = "none";
    }
});
</script>

<script>
$('#estadocivil').on('change', function() {
    var conyugueform = document.getElementById("conyugueform");
    var hijosform = document.getElementById("hijosform");
    var selectedValue = this.value;
    if (selectedValue != "Soltero" && selectedValue != "") {
        conyugueform.style.display = "block";
        hijosform.style.display = "block";
    } else {
        conyugueform.style.display = "none";
        hijosform.style.display = "none";
    }
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#fechanacimiento').datetimepicker({
        defaultDate: "01/01/1985",
        viewMode: 'years',
        format: 'YYYY/MM/DD'
    });
});
</script>

<script type="text/javascript">
$(function() {
    $('#fotografia').change(function(e) {
        addImage(e);
    });

    function addImage(e) {
        var file = e.target.files[0],
            imageType = /image.*/;

        if (!file.type.match(imageType))
            return;

        var reader = new FileReader();

        reader.onload = function(e) {
            var result = e.target.result;
            $('#imgSalida').attr("src", result);
        }

        reader.readAsDataURL(file);
    }
});
</script>