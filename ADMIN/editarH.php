<?php 
include("conectar.php");

$valores= "SELECT * FROM hospital";

    if(isset($_POST['Registros']))
    {
        if(strlen($_POST['nombre']) >= 1 && 
        strlen($_POST['nivel']) >= 1 &&
        strlen($_POST['Telefono']) >= 1 &&
        strlen($_POST['direccion']) >= 1 &&
        strlen($_POST['Latitud']) >= 1 &&
        strlen($_POST['Longitud']) >= 1 &&
        strlen($_POST['Total']) >= 1) 
        {
            $id= $_POST['IdHospital'];
            $name = $_POST['nombre'];
            $lev= $_POST['nivel'];
            $Tel= $_POST['Telefono'];
            $dir= $_POST['direccion'];
            $lat= $_POST['Latitud'];
            $len= $_POST['Longitud'];
            $tot= $_POST['Total'];
            //$contra= $_POST['clave'];

            $edit= "SELECT * FROM hospital WHERE IdHospital = $id";
            $Edit= mysqli_query($conection, $edit);

            while($EDIT= mysqli_fetch_array($Edit))
            {
                if($EDIT['IdHospital'] == $id)
                {

                    $consulta= "UPDATE hospital SET Nombre= '$name', Nivel_de_Hospital= '$lev', Telefono = '$Tel', Direccion = '$dir', Latitud = '$lat', Longitud = '$len', Total_Camillas_Internación= '$tot' WHERE IdHospital = $id";
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
            //$usu1= "INSERT INTO `usuario`(`Nombre`, `Clave`, `Rol`) VALUES ('$name','MD5($contra)','Hospital')";

            //$usua1= mysqli_query($conection, $usu1);

        } else {
            ?>
            <h3 class="bad">Porfavor ingresar todos los campos </h3>
            <?php
        }
    }

    //Mostrar Datos

    /*if(empty($_GET['IdHospital']))
    {
        header('Location: EditHos.php');
    }*/
    $iduser = $_GET['id'];

    $sql= mysqli_query($conection, $valores);

    
        while($data= mysqli_fetch_array($sql))
        {
            if($data['IdHospital'] == $iduser)
            {
                $iduser = $data['IdHospital'];
                $Nombre = $data['Nombre'];
                $Nivel = $data['Nivel_de_Hospital'];
                $Telefono = $data['Telefono'];
                $Direccion = $data['Direccion'];
                $Latitud = $data['Latitud'];
                $Longitud = $data['Longitud'];
                $Camas = $data['Total_Camillas_Internación'];
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
        <label><h1>Actualizar Datos Hospital</h1></label>
        <label><h3>Nombre del Hospital</h3></label>
        <input type="hidden" name="IdHospital" value="<?php echo $iduser ?>">
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del Hospital" value="<?php echo $Nombre ?>" />
        <label><h3>Nivel del Hospital</h3></label>
        <input type="text" name="nivel" class="form-control" id="nivel" placeholder="Ingrese 1-2-3 para Nivel del Hospital" value="<?php echo $Nivel ?>" />
        <label><h3>Telefono</h3></label>
        <input type="text" name="Telefono" class="form-control" id="Telefono" placeholder="Ingrese el Numero de Telefono" value="<?php echo $Telefono ?>" />
        <label><h3>Direccion</h3></label>
        <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Ingrese la direccion del Hospital" value="<?php echo $Direccion ?>" />
        <label><h3>Latitud</h3></label>
        <input type="text" name="Latitud" class="form-control" id="Latitud" placeholder="Ingrese la Latitud" value="<?php echo $Latitud ?>" />
        <label><h3>Longitud</h3></label>
        <input type="text" name="Longitud" class="form-control" id="Longitud" placeholder="Ingrese la Longitud" value="<?php echo $Longitud ?>" />
        <label><h3>Numero Total de Camillas</h3></label>
        <input type="text" name="Total" class="form-control" id="Total" placeholder="Ingrese el Numero Total de Camillas en el Hospital" value="<?php echo $Camas ?>" />
        <input type="submit" name="Registros" value="Actualizar">
        <br>
        <br>
        <button type="button" class="btn btn-primary">
        <a href="registroA2.php"><img src="imagenes/Volver.png" alt="VolverAtras" width="40" height="30"></a>
        </button>
    </form>

</body>
</html>
