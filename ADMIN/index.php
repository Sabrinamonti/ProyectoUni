<?php 
include("conectar.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Administracion Usuarios</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<label><h1>Administracion de Usuarios</h1></label>
	<form method="get" action="registroA.php">
		<input type="submit" name="Registrar Ambulancia" class="btn btn-warning" value="Registrar Ambulancia">
	</form>
	<form method="get" action="registroH.php">
		<input type="submit" name="Registrar Hospital" class="btn" value="Registrar Hospital">
	</form>
	<form method="get" action="EditHos.php">
		<input type="submit" name="Editar Hospital" class="btn" value="Editar Hospital">
	</form>
	<form method="get" action="EditAmb.php">
		<input type="submit" name="Editar Ambulancia" class="btn" value="Editar Ambulancia">
	</form>

	<form>
	<div>
		<button type="button" class="btn btn-default btn-sm">
            <a href="salir.php"><img src="imagenes/out.png" alt="LogOut" width="40" height="50"></a>
        </button>
	</div>
	</form>


</body>
</html>