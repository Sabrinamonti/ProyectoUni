<?php 
include("conectar.php");

	if(isset($_POST['Registros']))
	{
		if(strlen($_POST['nombre']) >= 1 && 
		strlen($_POST['nivel']) >= 1 &&
		strlen($_POST['Telefono']) >= 1 &&
		strlen($_POST['direccion']) >= 1 &&
		strlen($_POST['Latitud']) >= 1 &&
		strlen($_POST['Longitud']) >= 1 &&
		strlen($_POST['Total']) >= 1 &&
		strlen($_POST['clave']) >= 1) 
		{
			$name = $_POST['nombre'];
			$lev= $_POST['nivel'];
			$Tel= $_POST['Telefono'];
			$dir= $_POST['direccion'];
			$lat= $_POST['Latitud'];
			$len= $_POST['Longitud'];
			$tot= $_POST['Total'];
			$contra= $_POST['clave'];

			$consulta= "INSERT INTO `hospital`(`Nombre`, `Nivel_de_Hospital`, `Telefono`, `Direccion`, `Latitud`, `Longitud`, `Total_Camillas_Internación`) VALUES ('$name','$lev','$Tel','$dir','$lat','$len','$tot')";
			$usu1= "INSERT INTO `usuario`(`Nombre`, `Clave`, `Rol`) VALUES ('$name','MD5($contra)','Hospital')";


			$resultado = mysqli_query($conection, $consulta);
			$usua1= mysqli_query($conection, $usu1);

			if($resultado){
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
	<form method="post" >
		<label><h1>Registro Hospital</h1></label>
		<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del Hospital"/>
		<input type="text" name="nivel" class="form-control" id="nivel" placeholder="Ingrese 1-2-3 para Nivel del Hospital"/>
		<input type="text" name="Telefono" class="form-control" id="Telefono" placeholder="Ingrese el Numero de Telefono"/>
		<input type="text" name="direccion" class="form-control" id="direccion" placeholder="Ingrese la direccion del Hospital"/>
		<input type="text" name="Latitud" class="form-control" id="Latitud" placeholder="Ingrese la Latitud"/>
		<input type="text" name="Longitud" class="form-control" id="Longitud" placeholder="Ingrese la Longitud"/>
		<input type="text" name="Total" class="form-control" id="Total" placeholder="Ingrese el Numero Total de Camillas en el Hospital"/>
		<input type="text" name="clave" id="clave" placeholder="Ingresar la contraseña para este usuario"/>
		<input type="submit" name="Registros">
		<br>
		<br>
		<button type="button" class="btn btn-primary">
        <a href="registroA2.php"><img src="imagenes/Volver.png" alt="VolverAtras" width="40" height="30"></a>
    	</button>
	</form>

</body>
</html>
