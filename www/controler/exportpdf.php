<?php
    if(isset($_POST['hojadevida'])){
        include("../config/db.php");
        include("../config/conexion.php");
        require('../vendor/fpdf/fpdf.php');
        $id_user = addslashes ($_POST['id']);

        $ses_sql=mysqli_query($con, "SELECT * FROM cedadmision.Postulante WHERE id = '$id_user'");
        $row = mysqli_fetch_assoc($ses_sql);

        $usuario =$row["Usuario"];
        $correo =$row["Correo"];
        $nombres =$row["Nombres"];
        $apellidos =$row["Apellidos"];
        $edad =$row["Edad"];
        $celular =$row["Celular"];
        $pais =$row["Pais"];
        $lugarNacimiento =$row["Lugar_Nacimiento"];
        $fechaNacimiento =$row["Fecha_Nacimiento"];
        $estadoCivil =$row["Estado_Civil"];
        $ciudad =$row["Direccion_Departamento"];
        $ocupacion =$row["Ocupacion"];
        $nombrePastor =$row["Nombre_Pastor"];
        $nombreIglesia =$row["Nombre_Iglesia"];
        $direccionIglesia =$row["Direccion_Iglesia"];
        $domicilioIglesia =$row["Domicilio_Iglesia"];
        $postulacion =$row["Postulacion"];
        $fotoPerfil ='data://text/plain;base64,'.base64_encode($row["Foto_Perfil"]);
        $fotoCarnet =$row["Foto_Carnet"];
        $testimonio =utf8_decode($row["Testimonio"]);
        $estadoVida =$row["Estado_Vida"];
        $estadoDireccion =$row["Estado_Direccion"];

        class PDF extends FPDF{

            function Header() {
                $this->Image('../images/logos/logo.jpg', 60, 8, 10);
                $this->SetFont('helvetica','B',10);
                $this->Cell(80);
                $this->Cell(30, 8, 'Centro de Evangelismo y Discipulado', 0, 2, 'C');
                $this->Cell(30, 8, 'Hojas de Vida', 0, 2, 'C');
                $this->Ln(5);
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('helvetica', 'I', 8);
                $this->Image('../images/logos/logo.jpg', 92, 267, 4);
                $this->Cell(0, 10, 'Pagina ' . $this->PageNo() .
                    '/{nb}', 0, 0, 'C');
            }
        }

        $pdf = new PDF('P', 'mm', 'Letter');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->Cell(151);
        $pdf->Cell(39,50,$pdf->image($fotoPerfil, 150, 30, 41, 41,'jpg'),0,0,'C');
        $pdf->SetFont("Arial","",10);

        $pdf->Ln(8);
        $pdf->Cell(40,10,$nombres);
        $pdf->Ln(8);
        $pdf->Cell(40,10,$celular);
        $pdf->Ln(8);
        $pdf->Cell(40,10,$correo);
        $pdf->Ln(8);

        $pdf->Cell(40,10,$postulacion);
        $pdf->Ln(20);

        $pdf->MultiCell(190,10,$testimonio);
        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(90,10,"Pastor:",0,0);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(90,10,$nombrePastor,0,1);

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(90,10,"Iglesia",0,0);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(90,10,$nombreIglesia,0,1);

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(90,10,"Direccion :",0,0);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(90,10,$direccionIglesia,0,1);
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(90,10,"Domicilio:",0,0);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(90,10,$domicilioIglesia,0,1);

        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",13);
        $pdf->Cell(40,10,'Datos Personales');
        $pdf->Ln(15);
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,'Pais:');
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(50,5,$pais);
        $pdf->Ln(10);

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,'Lugar de nacimiento');
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(50,5,$lugarNacimiento);
        $pdf->Ln(10);

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,'Feca de nacimiento:');
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(50,5,$fechaNacimiento);

        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,'Estado civil:');
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(50,5,$estadoCivil);
        $pdf->Ln(10);

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,utf8_decode('Ocupación:'));
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(50,5,$ocupacion);
        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,5,'Fecha.........');
        $pdf->Ln(8);
        $pdf->Cell(50,5,'Lugar..........');
        $pdf->Ln(8);
        $pdf->Cell(50,5,'Postula...........');
        $pdf->output('D',$row['id'] .'_'. $row['Nombres'] .'_'. $row['Apellidos'] . '_HOJA_DE_VIDA.pdf');
    }
?>