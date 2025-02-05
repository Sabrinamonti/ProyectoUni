
<?php
include("conectar.php");
$datos= "SELECT * FROM hospital";  

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div align="text-center">
	<form method="post" action="editarH.php">
	<table class="table">
		<thead>
			<label><h1>Lista Hospitales</h1></label>
		</thead>
	  	<thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Nivel de Hospital</th>
	      <th scope="col">Telefono</th>
	      <th scope="col">Direccion</th>
	      <th scope="col">Latitud</th>
	      <th scope="col">Longitud</th>
	      <th scope="col">Total Camillas</th>
	      <th scope="col">Accion </th>
	    </tr>
	  	</thead>
	  	<?php $resultado1= mysqli_query($conection, $datos);

	    while ($row = mysqli_fetch_array($resultado1)) { ?>

		  <tbody>
		    <tr>
		      <td><?php echo $row['IdHospital']?></td>
		      <td><?php echo $row['Nombre']?></td>
		      <td><?php echo $row['Nivel_de_Hospital']?></td>
		      <td><?php echo $row['Telefono']?></td>
		      <td><?php echo $row['Direccion']?></td>
		      <td><?php echo $row['Latitud']?></td>
		      <td><?php echo $row['Longitud']?></td>
		      <td><?php echo $row['Total_Camillas_Internación']?></td>
		      <td>
		      	<a href="editarH.php?id=<?php echo $row['IdHospital']?>">Editar</a>
		      </td>
		    </tr>
		  </tbody>
		  <?php 
		  } 

		  ?>
	</table>
<br>
<br>
<button type="button" class="btn btn-primary">
<a href="registroA2.php"><img src="imagenes/Volver.png" alt="VolverAtras" width="40" height="30"></a>
</form>
</div>

</body>
</html>