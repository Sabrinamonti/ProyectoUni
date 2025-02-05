<?php
include("conectar.php");
$result="";  
	if(isset($_POST['Regi']))
	{
		if(strlen($_POST['nombre']) >= 1 && strlen($_POST['placa']) >= 1 && strlen($_POST['clave']) >= 1)
		{
			$nom = $_POST['nombre'];
			$pla= $_POST['placa'];
			$cont= $_POST['clave'];
			$consul= "INSERT INTO `ambulancia`(`Placa`, `Nombre`) VALUES ('$pla','$nom')";
			$usu2= "INSERT INTO `usuario`(`Nombre`, `Clave`, `Rol`) VALUES ('$nom','MD5($cont)','Ambulancia')";

			$resultado2 = mysqli_query($conection, $consul);
			$usua= mysqli_query($conection, $usu2);

			if($resultado2){
				?>
				<h3 class="ok">Se registro correctamente</h3>
				<?php
			} else {
				?>
				<h3 class="bad"> Ocurrio un error al introducir los datos</h3>
				<?php
			}

		} else {
			?>
			<h3 class="bad">Porfavor ingresar todos los campos </h3>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
		<label><h1>Registro Ambulancia</h1></label>
		<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de Usuario de la Ambulancia"/>
		<input type="text" name="placa" class="form-control" id="placa" placeholder="Ingrese el numero de placa de la ambulancia"/>
		<input type="text" name="clave" placeholder="Ingrese la contraseña de usario que se usara">
		<input type="submit" name="Regi">
		<br>
		<br>
		<button type="button" class="btn btn-primary">
        <a href="registroA2.php"><img src="imagenes/Volver.png" alt="VolverAtras" width="40" height="30"></a>
    </button>
	</form>
</body>
</html>