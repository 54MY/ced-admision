SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE cedadmision.Director (
  id int(11) NOT NULL,
  rol varchar(10) NOT NULL,
  user varchar(20) NOT NULL,
  password varchar(250) NOT NULL
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8;


INSERT INTO cedadmision.Director (id, rol, user, password) VALUES
(1, 'Direccion','direccion', 'f45baf7ba713fc7a933be0a5bfc65a521d3e1304'),
(2, 'Vida','vida', 'f45baf7ba713fc7a933be0a5bfc65a521d3e1304');

/*Create Table Acampante*/
CREATE TABLE cedadmision.Postulante (
	id INT auto_increment NOT NULL PRIMARY KEY,
	Cedula INT NOT NULL,
	Expedido varchar(10) NOT NULL,
	Nombres varchar(100) NOT NULL,
	Apellidos varchar(100) NOT NULL,
	Sexo varchar(10) NOT NULL,
	Lugar_Nacimiento varchar(10) NOT NULL,
	Fecha_Nacimiento Date NOT NULL,
	Estado_Civil varchar(100) NOT NULL,
	Edad INT NOT NULL,
	Datos_Conyugue varchar(100),
	Datos_Hijos varchar(100),
	Direccion_Departamento varchar(10) NOT NULL,
	Direccion_Domicilio varchar(100) NOT NULL,
	Celular INT NOT NULL,
	Correo varchar(100) NOT NULL,
	Nombre_Iglesia varchar(300) NOT NULL,
	Denominacion varchar(100) NOT NULL,
	Direccion_Iglesia varchar(10) NOT NULL,
	Domicilio_Iglesia varchar(200) NOT NULL,
	Miembro_Iglesia varchar(2) NOT NULL,
	Bautizado varchar(2) NOT NULL,
	Nombre_Pastor varchar(100) NOT NULL,
	Telefono_Pastor INT NOT NULL,
	Correo_Pastor varchar(100) NOT NULL,
	Testimonio varchar(500) NOT NULL,
	Foto_Perfil MEDIUMBLOB,
	Usuario varchar(100) NOT NULL,
	Contrasena varchar(250) NOT NULL,
	Fecha_Registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
