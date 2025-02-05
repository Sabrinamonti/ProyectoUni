<?php
include("conectar.php");
$valores= "SELECT * FROM ambulancia";

$result="";

	if(isset($_POST['Regi']))
	{
		if(strlen($_POST['nombre']) >= 1 && strlen($_POST['placa']) >= 1)
		{
			$id= $_POST['IdAmbulancia'];
			$nom = $_POST['nombre'];
			$pla= $_POST['placa'];

			$edit= "SELECT * FROM ambulancia WHERE IdAmbulancia = $id";
            $Edit= mysqli_query($conection, $edit);

            while($EDIT= mysqli_fetch_array($Edit))
            {
                if($EDIT['IdAmbulancia'] == $id)
                {

                    $consulta= "UPDATE ambulancia SET Placa = '$pla', Nombre = '$nom' WHERE IdAmbulancia = $id";
                    $resultado = mysqli_query($conection, $consulta);
                    if($resultado){
                        ?>
                        <h3 class="ok">Se registro correctamente</h3>
                        <?php
                    } else {
                        ?>
                        <h3 class="bad"> Ocurrio un error al introducir los datos</h3>
                        <?php
                    }
                }
            }
			

		} else {
			?>
			<h3 class="bad">Porfavor ingresar todos los campos </h3>
			<?php
		}
	}

	$iduser = $_GET['id'];

    $sql= mysqli_query($conection, $valores);

    
        while($data= mysqli_fetch_array($sql))
        {
            if($data['IdAmbulancia'] == $iduser)
            {
                $iduser = $data['IdAmbulancia'];
                $Nombre = $data['Nombre'];
                $Placa = $data['Placa'];
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
		<label><h3>Nombre de Ambulancia</h3></label>
		<input type="hidden" name="IdAmbulancia" value="<?php echo $iduser ?>">
		<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de Usuario de la Ambulancia" value="<?php echo $Nombre ?>" />
		<label><h3>Numero de Placa de la Ambulancia</h3></label>
		<input type="text" name="placa" class="form-control" id="placa" placeholder="Ingrese el numero de placa de la ambulancia" value="<?php echo $Placa ?>" />
		<input type="submit" name="Regi">
		<br>
		<br>
		<button type="button" class="btn btn-primary">
        <a href="registroA2.php"><img src="imagenes/Volver.png" alt="VolverAtras" width="40" height="30"></a>
    </button>
	</form>
</body>
</html>