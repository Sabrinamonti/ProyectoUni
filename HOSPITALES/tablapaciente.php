<?php 
    include("conectar.php");
    session_start();
    $hosp= "SELECT Nombre, Total_Camillas_Internacion FROM hospital";
    $Hvied= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Hospital Viedma'";
    $HLA= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Clinica Los Angeles'";
    $HSL= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Clinica San Lopez'";
    $inst= "SELECT H.Nombre, C.IdHospital, C.Internacion FROM hospital H, camillas C";
    $Paci= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A ORDER BY Iddiagnostico DESC LIMIT 1";
    $Pres= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'PA' ORDER BY `IdSensor` DESC";
    $Frec= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'FC' ORDER BY `IdSensor` DESC";
    $Ox= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'SP' ORDER BY `IdSensor` DESC";
    $HoFe= "SELECT Fecha FROM notificaciones ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe1= "SELECT `Hora` FROM `diagnostico`ORDER BY `Iddiagnostico` DESC LIMIT 1";
    $conf= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
                        <?php
                        $hos= mysqli_query($conection, $Paci);
                        $fec= mysqli_query($conection, $HoFe);
                        $fec2=mysqli_query($conection, $HoFe1);

                        $HOSF= mysqli_fetch_array($hos);
                        $FECF= mysqli_fetch_array($fec);
                        $FECF2= mysqli_fetch_array($fec2);

                        if($_SESSION['nombre']== $HOSF['HosDes'])
                        {
                            if($FECF2['Hora'] > $FECF['Fecha'])
                            {
                                ?>
                                <script src="js/alert.js"></script>
                                <?php
                            }
                            else
                            {
                                echo " Se envio el formulario";
                            }
                        }

                        ?>
	<table class="table table-bordered">
                            <thead>
                                <tr><h3>Datos de Pacientes en Camino</h3></tr>
                            </thead>
                            <?php  
                                    $mos2= mysqli_query($conection, $conf);
                                    $sen1= mysqli_query($conection, $Pres);
                                    $sen2= mysqli_query($conection, $Frec);
                                    $sen3= mysqli_query($conection, $Ox); 

                                    while ($fila= mysqli_fetch_array($mos2)) { 

                                        $PA = mysqli_fetch_array($sen1);
                                        $FR = mysqli_fetch_array($sen2);
                                        $SP = mysqli_fetch_array($sen3);

                                        
                                        if($fila['HosDes']== $_SESSION['nombre']) 
                                        {
                                            if($fila['Confirma'] == 'En_Camino')
                                            {
                                                ?>
                                                <form method="post" action="index.php">
                                                <tr>
                                                    <td><h4>Nombre</h4></td>
                                                    <td><?php echo $fila['NombrePac']; ?>
                                                        <input type="hidden" name="NombreH" value="<?php echo $fila["NombrePac"] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h4>Edad</h4></td>
                                                    <td><?php echo $fila['EdadPac']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><h4>Diagnostico</h4></td>
                                                    <td><?php echo $fila['Diag']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><h4>#Placa Ambulancia</h4></td>
                                                    <td><?php echo $fila['Placa'] ?></td>
                                                </tr>
                                                <?php  
                                                if($fila['IdAmbulancia'] == $PA['IdAmbulancia'])
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
                             
                            ?>
                        </table> 



</body>
</html>