<?php 
include("conectar.php");
session_start();
header("Refresh: 10");
error_reporting(0);

$base= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC"; 
$presion= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'PA' ORDER BY `IdSensor` DESC LIMIT 1 ";
$frecuencia= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'FC' ORDER BY `IdSensor` DESC LIMIT 1";
$saturacion= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'SP' ORDER BY `IdSensor` DESC LIMIT 1"; 
//$idUser= $_GET('id');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signos vitales</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script>
    $(document).ready(function(){
        setInterval(
            function(){
                $('#signos').load('SIGNOSV.php');
                refresh();
            }, 10000
        );
    });
    </script>
</head>
<body>
	<script>
		$(document).ready(function(){
			setTimeout(refrescar, 10000);
		});
		function refrescar(){
			location.reload();
		}
	</script>
	<div class="container" id="signos">
		<div class="signup-content">
		<form class="signup-form">
		<?php

		$Base= mysqli_query($conection, $base);
		$Pre= mysqli_query($conection, $presion);
		$Frec= mysqli_query($conection, $frecuencia);
		$Sat= mysqli_query($conection, $saturacion);  

		?>
		<table class="table table-bordered" align="text-center">
			<thead align="text-center">
				<tr><h1> Datos de Pacientes</h1></tr>
			</thead>
			<?php
			$iduser= $_GET['id'];
			 $PreA= mysqli_fetch_array($Pre);
			 $FREC= mysqli_fetch_array($Frec);
			 $SAT= mysqli_fetch_array($Sat);

			 while($BASE= mysqli_fetch_array($Base))
			 {
			 	if($_SESSION['nombre'] == $BASE['HosDes'])
			 	{
			 		if($BASE['Confirma'] == 'Aceptado')
			 		{
			 			if($BASE['IdAmbulancia'] == $iduser)
			 			{
			 				?>
			 				<tr>
			 					<td><h4>Nombre</h4></td>
			 					<td><h4>Edad</h4></td>
			 					<td><h4>Diagnostico</h4></td>
			 					<td><h4>#Placa</h4></td>
			 					<td><h4>Presion Aterial</h4></td>
			 					<td><h4>Frecuencia Cardiaca</h4></td>
			 					<td><h4>Saturacion de Oxigeno</h4></td>
			 				</tr>
			 				<tr>
			 					<td><?php echo $BASE['NombrePac'] ?></td>
			 					<td><?php echo $BASE['EdadPac'] ?></td>
			 					<td><?php echo $BASE['Diag'] ?></td>
			 					<td><?php echo $BASE['Placa'] ?></td>
			 					<?php 
				 				if($BASE['IdAmbulancia'] == $PreA['IdAmbulancia'])
				 				{
				 					?>
				 					<td><?php echo $PreA['ValorFC'] ?></td>
				 					<td><?php echo $FREC['ValorFC'] ?></td>
				 					<td><?php echo $SAT['ValorFC'] ?></td>
			 				</tr>
			 				
			 					<?php
			 				}
			 			} 
			 		}
			 	}

			 } 

			?>
			
		</table>
		</form>
		</div>
		<button type="button" class="btn btn-primary">
        <a href="volver.php"><img src="images/Volver.png" alt="VolverAtras" width="40" height="30"></a>
        </button>
	</div>

</body>
</html>