<?php
    $error='';
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "El nombre de usuario o la contraseña es inválida.";
        }
        else{
            $username=$_POST['username'];
            $password=$_POST['password'];
            include("config/db.php");
            include("config/conexion.php");
            // Para proteger de Inyecciones SQL 
            $username = mysqli_real_escape_string($con,(strip_tags($username,ENT_QUOTES)));
            $password =  sha1($password);
            
            $acampante = mysqli_query($con,"SELECT id, Correo, Nombres, Apellidos, Edad FROM cedadmision.Postulante WHERE Usuario = '" . $username . "' and Contrasena='".$password."';");
            $admin = mysqli_query($con,"SELECT id, rol, user, password FROM cedadmision.Director WHERE user = '" . $username . "' and password='".$password."';");
            if(mysqli_num_rows($acampante) > 0) {
                session_start();
                $_SESSION['postulante']="$username";
                header("location: postulante/index.php");
                exit();
            } else if(mysqli_num_rows($admin) > 0) {
                $row = mysqli_fetch_assoc($admin);
                $rol =$row["rol"];
                if($rol == 'Direccion'){
                    session_start();
                    $_SESSION['admin']="$username";
                    header("Location: direccion/index.php");
                    exit();
                } else if($rol == 'Vida'){
                    session_start();
                    $_SESSION['vida']="$username";
                    header("Location: vida/index.php");
                    exit();
                }
            } else {
                $error = "El nombre de usuario o la contraseña es inválida.";	
            }
        }
    }
?>