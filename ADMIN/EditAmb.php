<?php
include("conectar.php");
$datos= "SELECT * FROM ambulancia";  

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
	<table class="colapsado">
    <thead>
      <label><h1>Lista de Ambulancias</h1></label>
    </thead>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col"> # de Placa</th>
        <th scope="col">Accion </th>
      </tr>
    </thead>
    <?php $resultado1= mysqli_query($conection, $datos);

      while ($row = mysqli_fetch_array($resultado1)) { ?>

    <tbody>
      <tr>
        <td><?php echo $row['IdAmbulancia']?></td>
        <td><?php echo $row['Nombre']?></td>
        <td><?php echo $row['Placa']?></td>
        <td>
      	 <a href="editarA.php?id=<?php echo $row['IdAmbulancia']?>">Editar</a>
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