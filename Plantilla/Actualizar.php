<?php
	include_once("conectar.php"); 

	$camas= $_POST['NumeroCam'];

	$insertar= "INSERT into camillas values ('$camas')";
	$result= mysqli_query($conection, $insertar)
		alert("Datos fueron actualizados");
		//mysqli_close($conection);  

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>