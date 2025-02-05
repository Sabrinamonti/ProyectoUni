<?php
include("conectar.php"); 
session_start();
$confi= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC";
$Presi= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'PA' ORDER BY `IdSensor` DESC LIMIT 1 ";
$Freci= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'FC' ORDER BY `IdSensor` DESC LIMIT 1 ";
$Oxi= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'SP' ORDER BY `IdSensor` DESC  LIMIT 1"; 

$idam= $_GET['id'];

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div align="text-center">
        <form>
            <table class="table table-bordered">
                <thead>
                    <tr><h1 align="text-center">Datos Paciente</h1></tr>
                </thead>
                           
                <?php 

                $Mos2= mysqli_query($conection, $confi);
                $sens1= mysqli_query($conection, $Presi);
                $sens2= mysqli_query($conection, $Freci);
                $sens3= mysqli_query($conection, $Oxi);


                while ($Fila= mysqli_fetch_array($Mos2))
                {
                    $PA = mysqli_fetch_array($sens1);
                    $FR = mysqli_fetch_array($sens2);
                    $SP = mysqli_fetch_array($sens3);

                    if($Fila['HosDes']== $_SESSION['nombre'])
                    {
                        if($Fila['Confirma'] == 'Aceptado')
                        {
                            if($Fila['IdAmbulancia'] == $idam)
                            {
                            ?>
                                <tr>
                                    <td><h4>Nombre</h4></td>
                                    <td><?php echo $Fila['NombrePac']; ?></td>
                                </tr>
                                <tr>
                                    <td><h4>Edad</h4></td>
                                    <td><?php echo $Fila['EdadPac'] ?></td>
                                </tr>
                                <tr>
                                    <td><h4>Diagnostico</h4></td>
                                    <td><?php echo $Fila['Diag']; ?></td>
                                </tr>
                                <tr>
                                    <td><h4>Placa</h4></td>
                                    <td><?php echo $Fila['Placa'] ?></td>
                                </tr>
                                <?php  
                                if($Fila['IdAmbulancia'] == $PA['IdAmbulancia'])
                                {
                                ?>
                                    <tr>
                                        <td><h4>Presion Arterial</h4></td>
                                        <td><?php echo $PA['ValorFC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Frecuencia Cardiaca</h4></td>
                                        <td><?php echo $FR['ValorFC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Saturacion de Oxigeno</h4></td>
                                        <td><?php echo $SP['ValorFC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Fecha - Hora</h4></td>
                                        <td><?php echo $SP['Fecha'] ?></td>
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

</body>
</html>