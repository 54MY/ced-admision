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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

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

    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }

    input.error,
    textarea.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
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
            } else {$nombres = strtoupper($nombres);}
            $apellidos = addslashes($_POST['apellidos']);
            if (empty($apellidos)) {
                $mensaje = 'Campo apellidos requerido';
                popUpWarning($mensaje);
            } else {$apellidos = strtoupper($apellidos);}
            $sexo = addslashes($_POST['sexo']);
            if (empty($sexo)) {
                $mensaje = 'Campo sexo requerido';
                popUpWarning($mensaje);
            } else {$sexo = strtoupper($sexo);}
            $pais = 'BOLIVIA';
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
                } else {$datosconyuge = strtoupper($datosconyuge);}
            }
            $hijos = addslashes ($_POST['hijos']);
            $hijos = strtoupper($hijos);
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
            } else {$domicilio = strtoupper($domicilio);}
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
            $ocupacion = strtoupper($ocupacion);
            $nombreiglesia = addslashes($_POST['nombreiglesia']);
            if (empty($nombreiglesia)) {
                $mensaje = 'Ingrese el nombre de la iglesia';
                popUpWarning($mensaje);
            } else {$nombreiglesia = strtoupper($nombreiglesia);}
            $denominacion = addslashes($_POST['denominacion']);
            if (empty($denominacion)) {
                $mensaje = 'Ingrese la denominacion';
                popUpWarning($mensaje);
            }
            $direccioniglesia = addslashes($_POST['direccioniglesia']);
            if (empty($direccioniglesia)) {
                $mensaje = 'Ingrese la direccion de la iglesia';
                popUpWarning($mensaje);
            } else {$direccioniglesia = strtoupper($direccioniglesia);}
            $domicilioiglesia = addslashes($_POST['domicilioiglesia']);
            if (empty($domicilioiglesia)) {
                $mensaje = 'Ingrese el domicilio de la iglesia';
                popUpWarning($mensaje);
            } else {$domicilioiglesia = strtoupper($domicilioiglesia);}
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
            } else {$pastor = strtoupper($pastor);}
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
            $fotografia = addslashes($_FILES['fotografia']['name']);
            if(!empty($fotografia)) {

                $fileName = basename($_FILES['fotografia']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                $allowTypes = array('jpg','png','jpeg');
                if(in_array($fileType, $allowTypes)){
                    $fotografia = $_FILES['fotografia']['tmp_name'];
                    $fotoPerfil = addslashes(file_get_contents($fotografia));
                }else{
                    $mensaje = 'Lo siento, solo se admiten los formatos JPG, JPEG y PNG para poder subir.';
                    popUpWarning($mensaje);
                }
            }else{
                $mensaje = 'Debe seleccionar una fotografia personal valida.';
                popUpWarning($mensaje);
            }
            $fotocopiacarnet = addslashes($_FILES['fotocopiacarnet']['name']);
            if(!empty($fotocopiacarnet)) {

                $fileName = basename($_FILES['fotocopiacarnet']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                $allowTypes = array('pdf');
                if(in_array($fileType, $allowTypes)){
                    $fotocopiacarnet = $_FILES['fotocopiacarnet']['tmp_name'];
                    $fotoCarnet = addslashes(file_get_contents($fotocopiacarnet));
                }else{
                    $mensaje = 'Lo siento, el formato para fotocopia carnet debe ser PDF para poder subir.';
                    popUpWarning($mensaje);
                }
            }else{
                $mensaje = 'Debe seleccionar una fotocopia de carnet valida.';
                popUpWarning($mensaje);
            }
            $cartareferencia = addslashes($_FILES['cartareferencia']['name']);
            if(!empty($cartareferencia)) {

                $fileName = basename($_FILES['cartareferencia']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                $allowTypes = array('pdf');
                if(in_array($fileType, $allowTypes)){
                    $cartareferencia = $_FILES['cartareferencia']['tmp_name'];
                    $fotoReferencia = addslashes(file_get_contents($cartareferencia));
                }else{
                    $mensaje = 'Lo siento, el formatos para la carte de referencia debe ser PDF para poder subir.';
                    popUpWarning($mensaje);
                }
            }else{
                $mensaje = 'Debe seleccionar una carta de referencia valida.';
                popUpWarning($mensaje);
            }
            $certificadobachiller = addslashes($_FILES['certificadobachiller']['name']);
            if(!empty($certificadobachiller)) {

                $fileName = basename($_FILES['certificadobachiller']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                $allowTypes = array('pdf');
                if(in_array($fileType, $allowTypes)){
                    $certificadobachiller = $_FILES['certificadobachiller']['tmp_name'];
                    $fotoCertificado = addslashes(file_get_contents($certificadobachiller));
                }else{
                    $mensaje = 'Lo siento, el formatos para el certificado de bachiller o libreta escolar debe ser PDF para poder subir.';
                    popUpWarning($mensaje);
                }
            }else{
                $mensaje = 'Debe seleccionar un certificado de bachiller valido.';
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

            $sql = "INSERT INTO cedadmision.Postulante (Cedula, Expedido, Nombres, Apellidos, Sexo, Pais, Lugar_Nacimiento, Fecha_Nacimiento, Estado_Civil, Edad, Datos_Conyugue, Datos_Hijos, Direccion_Departamento, Direccion_Domicilio, Celular, Correo, Ocupacion, Nombre_Iglesia, Denominacion, Direccion_Iglesia, Domicilio_Iglesia, Miembro_Iglesia, Bautizado, Nombre_Pastor, Telefono_Pastor, Correo_Pastor, Testimonio, Postulacion, Foto_Perfil, Foto_Carnet, Carta_Referencia, Foto_Bachiler, Usuario, Contrasena)
                    VALUES('$cedula', '$expedido', '$nombres', '$apellidos', '$sexo', '$pais', '$lugarnacimiento', '$fechanacimiento', '$estadocivil', $edad, '$datosconyuge', '$hijos', '$direcciondep', '$domicilio', $celular, '$correo', '$ocupacion','$nombreiglesia', '$denominacion', '$direccioniglesia', '$domicilioiglesia', '$miembro', '$bautizado', '$pastor', $telefonopastor, '$correpastor', '$testimonio', '$postulacion', '$fotoPerfil', '$fotoCarnet', '$fotoReferencia', '$fotoCertificado', '$usuario', '$contrasena')";

            $retval = mysqli_query($con,$sql);
            if($retval) {
                $mensaje = 'Te registraste con exito. \n\n En unos días nos comunicaremos contigo';
                popUpSuccess('Felicidades', $mensaje);
            } else if(! $retval ) {
                $mensaje = 'Nose pudo registrar, contacte al administrador';
                popUpEnd('Error en Servidor',$mensaje);
                die('Could not enter data: ' . mysqli_error());
            }

            //popUpEnd('Inscripciones cerradas','El proceso de inscripcion a terminado');
        }
    ?>

    <div class="container">
        <div class="row">
            <h2>Formulario para postulantes Nacionales</h2>
            <div class="col-md-10 ">
                <form class="form-horizontal" action="" method="post" id="nacional-form" enctype="multipart/form-data">
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
                                    <input class="form-control" id="cedula" name="cedula"
                                        placeholder="Cédula de Identidad" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="expedido" name="expedido" required>
                                    <option value="" selected>Expedido en</option>
                                    <option value="COCHABAMBA">Cochabamba</option>
                                    <option value="SANTA CRUZ">Santa Cruz</option>
                                    <option value="LA PAZ">La Paz</option>
                                    <option value="ORURO">Oruro</option>
                                    <option value="CHUQUISACA">Chuquisaca</option>
                                    <option value="POTOSI">Potosi</option>
                                    <option value="PANDO">Pando</option>
                                    <option value="BENI">Beni</option>
                                    <option value="TARIJA">Tarija</option>
                                </select>
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
                                        placeholder="Nombres" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    placeholder="Apellidos" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="sexo">Sexo</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="sexo" id="sexo"
                                        value="Masculino" required>
                                    <label class="col-sm-2 form-check-label" for="sexo">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="sexo" id="sexo"
                                        value="Femenino" required>
                                    <label class="col-sm-2 form-check-label" for="sexo">Femenino</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Lugar de nacimiento">Lugar y fecha de
                                Nacimiento</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <select class="form-control" id="lugarnacimiento" name="lugarnacimiento" required>
                                        <option value="" selected>Departamento</option>
                                        <option value="COCHABAMBA">Cochabamba</option>
                                        <option value="SANTA CRUZ">Santa Cruz</option>
                                        <option value="LA PAZ">La Paz</option>
                                        <option value="ORURO">Oruro</option>
                                        <option value="CHUQUISACA">Chuquisaca</option>
                                        <option value="POTOSI">Potosi</option>
                                        <option value="PANDO">Pando</option>
                                        <option value="BENI">Beni</option>
                                        <option value="TARIJA">Tarija</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group date" id="calendario" name="calendario">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento"
                                        placeholder="Año/Mes/Dia" required />
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
                                    <select class="form-control" id="estadocivil" name="estadocivil" required>
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
                                    <select require="true" class="form-control" id="edad" name="edad" required>
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
                                    <select class="form-control" id="direcciondep" name="direcciondep" required>
                                        <option value="" selected>Departamento</option>
                                        <option value="COCHABAMBA">Cochabamba</option>
                                        <option value="SANTA CRUZ">Santa Cruz</option>
                                        <option value="LA PAZ">La Paz</option>
                                        <option value="ORURO">Oruro</option>
                                        <option value="CHUQUISACA">Chuquisaca</option>
                                        <option value="POTOSI">Potosi</option>
                                        <option value="PANDO">Pando</option>
                                        <option value="BENI">Beni</option>
                                        <option value="TARIJA">Tarija</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="domicilio" name="domicilio"
                                    placeholder="Provincia, nro de vivienda y calles" required>
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
                                        placeholder="Teléfono fijo o celular" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="correo" name="correo"
                                    placeholder="Correo electrónico" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ocupacion">Ocupación o profesión</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="ocupacion" name="ocupacion"
                                        placeholder="Ocupacion o profesión">
                                </div>
                            </div>
                        </div>
                        <legend>Datos Iglesia y Pastor</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre Iglesia</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="nombreiglesia" name="nombreiglesia"
                                        placeholder="Nombre de la Iglesia" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <select class="form-control" id="denominacion" name="denominacion" required>
                                        <option value="" selected>Denominación:</option>
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
                                    <select class="form-control" id="direccioniglesia" name="direccioniglesia" required>
                                        <option value="" selected>Departamento</option>
                                        <option value="COCHABAMBA">Cochabamba</option>
                                        <option value="SANTA CRUZ">Santa Cruz</option>
                                        <option value="LA PAZ">La Paz</option>
                                        <option value="ORURO">Oruro</option>
                                        <option value="CHUQUISACA">Chuquisaca</option>
                                        <option value="POTOSI">Potosi</option>
                                        <option value="PANDO">Pando</option>
                                        <option value="BENI">Beni</option>
                                        <option value="TARIJA">Tarija</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="domicilioiglesia" name="domicilioiglesia"
                                    placeholder="Provincia, nro de vivienda y calles" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">¿Asiste a esta Iglesia?</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="miembro" id="miembro"
                                        value="si" required>
                                    <label class="col-sm-2 form-check-label" for="miembro">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="miembro" id="miembro"
                                        value="no" required>
                                    <label class="col-sm-2 form-check-label" for="miembro">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">¿Eres bautizado?</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="bautizado"
                                        id="bautizado" value="si" required>
                                    <label class="col-sm-2 form-check-label" for="bautizado">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="col-sm-1 form-check-input" type="radio" name="bautizado"
                                        id="bautizado" value="no" required>
                                    <label class="col-sm-2 form-check-label" for="bautizado">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Datos Pastor</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <em class="fa fa-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="pastor" name="pastor"
                                        placeholder="Nombre completo" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" id="telefonopastor" name="telefonopastor"
                                    placeholder="Celular" required>
                            </div>
                            <div class="col-md-3">
                                <input type="email" class="form-control" id="correpastor" name="correpastor"
                                    placeholder="Correo electrónico" required>
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
                                        placeholder="Breve descripción" rows="1" required></textarea>
                                </div>
                            </div>
                        </div>
                        <legend>Adjuntar los archivos de forma obligatoria</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Año al que postula</label>
                            <div class="col-md-4">
                                <select class="form-control" id="postulacion" name="postulacion" required>
                                    <option value="" selected>Seleccione un año</option>
                                    <option value="PRIMERO">Primer año</option>
                                    <option value="SEGUNDO">Segundo año</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotografia 4X4</label>
                            <div class="col-md-5">
                                <input type="file" class="custom-file-input" name="fotografia" id="fotografia"
                                    accept="image/png, .jpeg, .jpg" lang="es" required />
                            </div>
                            <div class="col-md-3">
                                <img id="imgSalida" width="50%" height="50%" src="" alt="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotocopia de carnet</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" name="fotocopiacarnet" id="fotocopiacarnet"
                                    accept="application/pdf" lang="es" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Carta de referencia de la Iglesia</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" name="cartareferencia" id="cartareferencia"
                                    accept="application/pdf" lang="es" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fotocopia certificado bachiller o libreta
                                escolar</label>
                            <div class="col-md-4">
                                <input type="file" class="custom-file-input" name="certificadobachiller"
                                    id="certificadobachiller" accept="application/pdf" lang="es" required />
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
                                    <input class="form-control input-md" id="usuario" type="text"
                                        placeholder="Nombre de usuario" name="usuario" required />
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
                                    <input class="form-control" type="password" id="contrasena" placeholder="Contraseña"
                                        name="contrasena" minlength="8" required />
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

<script type="text/javascript">
$(document).ready(function() {
    $("#nacional-form").validate({
        rules: {
            cedula: {
                minlength: 5
            },
            expedido: {
                maxlength: 30
            },
            nombres: {
                minlength: 3
            },
            apellidos: {
                minlength: 3
            },
            hijos: {
                maxlength: 100
            },
            domicilio: {
                maxlength: 100
            },
            ocupacion: {
                maxlength: 100
            },
            nombreiglesia: {
                maxlength: 300
            },
            domicilioiglesia: {
                maxlength: 200
            },
            testimonio: {
                maxlength: 500
            },
        },
        messages: {
            cedula: {
                required: "Ingrese una numero de C.I. valido",
                minlength: "EL numero ingresado no es valido"
            },
            expedido: {
                maxlength: "Ponga una descripcion mas corta"
            },
            nombres: {
                minlength: "Escriba un nombre correcto"
            },
            apellidos: {
                minlength: "Escriba un apellido correcto"
            },
            lugarnacimiento: {
                required: "Seleccione lugar de nacimiento"
            },
            hijos: {
                maxlength: "Datos de los hijos demasiado largo"
            },
            domicilio: {
                maxlength: "Datos del domicilio demasiado largo"
            },
            ocupacion: {
                maxlength: "Ponga una descripcion mas corta"
            },
            nombreiglesia: {
                maxlength: "Nombre de la iglesia demasiado larga"
            },
            domicilioiglesia: {
                maxlength: "Domicilio de la iglesia demasiado larga"
            },
            testimonio: {
                maxlength: "Testimonio demasiado largo"
            },
        }
    });
});
</script>