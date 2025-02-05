<?php 
error_reporting(0);
$alert= '';
session_start();

if(!empty($_SESSION['active']))
{
	header('location: index.php');
} else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) ||  empty($_POST['clave']))
		{
			$alert= 'Ingrese el usuario y su clave';
		}else{
			
			require_once "conexion.php";

			$user= mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass= md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query= mysqli_query($conection, "SELECT * FROM usuario WHERE Nombre= '$user' AND Clave= '$pass'");
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active']= true;
				$_SESSION['iduser']= $data['IdUsuario'];
				$_SESSION['nombre']= $data['Nombre'];
				$_SESSION['rol']= $data['Rol'];

				if($_SESSION['rol']== 'Hospital')
				{
					header('location: HOSPITALES/');
				}
				if ($_SESSION['rol'] == 'Ambulancia')
				{
					header('location: AMBULANCIAS/');
				}
				if ($_SESSION['rol'] == 'Admin')
				{
					header('location: ADMIN/');
				}

			} else{
				$alert= 'El usuario o la clave son incorrectos';
				session_destroy();
			}

		}
	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login | Plataforma Hospitales</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id="container">
		
		<form action="" method="post">
			
			<h3> Iniciar Sesion</h3>
			
			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class= "alert"><?php echo isset($alert) ? $alert : ''; ?> </div>
			<input type="submit" value="INGRESAR">

		</form>
	</section>

</body>
</html>