<?php 
    include("conectar.php");
    session_start();
    $hosp= "SELECT H.Nombre, H.IdHospital, H.Total_Camillas_Internación FROM hospital H";
    $Hvied= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Hospital Viedma'";
    $HLA= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Clinica Los Angeles'";
    $HSL= "SELECT `Total_Camillas_Internación` FROM `hospital` WHERE `Nombre` = 'Clinica San Lopez'";
    $inst= "SELECT H.Nombre, C.IdHospital, C.Internacion FROM hospital H, camillas C";
    $Paci= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa FROM diagnostico D, ambulancia A ORDER BY Iddiagnostico DESC LIMIT 1";
    $Pres= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'PA' ORDER BY `IdSensor` DESC ";
    $Frec= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'FC' ORDER BY `IdSensor` DESC ";
    $Ox= "SELECT `ValorFC`,`Fecha`,`IdAmbulancia` FROM `sensor` WHERE `Topic`= 'SP' ORDER BY `IdSensor` DESC ";
    $HoFe= "SELECT Fecha FROM notificaciones ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe1= "SELECT `Hora` FROM `diagnostico`ORDER BY `Iddiagnostico` DESC LIMIT 1";
    $idAm= "SELECT IdAmbulancia FROM diagnostico ORDER BY Iddiagnostico DESC LIMIT 1";
    $idHos= "SELECT H.IdHospital, D.HosDes, D.NombrePac, D.IdAmbulancia FROM hospital H, diagnostico D WHERE D.HosDes = H.Nombre && Confirma= 'En_Camino' ORDER BY D.Iddiagnostico ASC";
    $info= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma, D.Iddiagnostico FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC";
    $conf= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC";
    $ambu= "SELECT IdAmbulancia, NombrePac FROM diagnostico WHERE Confirma = 'En_Camino' ORDER BY Iddiagnostico ASC LIMIT 1";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
      setTimeout("document.location==document.location", 2000);
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualiazcion Camillas</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script>
    $(document).ready(function(){
        setInterval(
            function(){
                $('#seccionRecarga').load('tablapaciente.php');
                refresh();
            }, 5000
        );
    });
    </script>

</head>
<body>
    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Bienvenido <?php echo $_SESSION['nombre'];  ?></h2>
                        <h3 class="form-title text-center">ACTUALIZAR CAMILLAS</h3>
                    </form>
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label><h4>Introducir el numero de Camillas de Sala de Internacion</h4></label>
                            <input type="text" class="form-input" name="NumCam" id="NumCam" placeholder="#Camas Disponibles">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn_actualizar" id="btn_actualizar" class="form-submit"> ACTUALIZAR </button>   
                        </div>
                    </form>
                    <?php
                        $fecha= date('Y-m-d');
                        $hora= date('H:i:s');

                            if(isset($_POST['btn_actualizar']))
                            {
                            $cama= $_POST['NumCam'];
                            $HP1= mysqli_query($conection, $Hvied);
                            $HP2= mysqli_query($conection, $HLA);
                            $HP3= mysqli_query($conection, $HSL);
                            $Hfinal= mysqli_query($conection, $hosp);


                            if($cama =="" )
                            {
                                echo "Este Campo es Obligatorio Llenar";
                            }

                            
                            while ($HFIN= mysqli_fetch_array($Hfinal)) 
                            {
                                if($_SESSION['nombre'] == $HFIN['Nombre'])
                                {
                                    //$hp1 = mysqli_fetch_array($HP1);
                                    if($cama > $HFIN['Total_Camillas_Internación'])
                                    {
                                        echo "Numero Invalido";
                                    }
                                    else
                                    {
                                        $_UPDATE_SQL= "UPDATE camillas set Internacion = '$cama', Fecha= '$fecha', Hora = '$hora' WHERE IdHospital= '{$HFIN['IdHospital']}'";
                                        mysqli_query($conection, $_UPDATE_SQL);
                                    }
                                }
                                
                            }
                        }

                    ?>
                    
                    <div class="text-secondary text-center">
                        <div id="seccionRecarga">
                        </div>    
                    </div>
                    <div class="container-fluid" align="text-center">
                                <form method="post">
                                    <div class="text-center"><button type="submit" name="Aceptar" class="btn btn-primary">ACEPTAR</button></div>
                                    <br>
                                    <div class="text-center"><button type="submit" name="Rechazar" class="btn btn-danger">RECHAZAR</button></div>
                                </form>
                    </div>
                    <?php
                        $tr1= mysqli_query($conection, $conf);

                        $IDhos= mysqli_query($conection, $idHos);
                        $AM= mysqli_query($conection, $ambu);

                        $AMBU= mysqli_fetch_array($AM);

                        //$Nom= $_POST['NombreH'];

                        if (isset($_POST['Rechazar'])) {

                            while ($TR1= mysqli_fetch_array($IDhos)) {

                                if($_SESSION['nombre'] == $TR1['HosDes'])
                                {
                                    if($AMBU['IdAmbulancia'] == $TR1['IdAmbulancia'])
                                    {
                                        if($AMBU['NombrePac'] == $TR1['NombrePac'])
                                        {
                                            $Cons= "UPDATE diagnostico SET Confirma = 'Rechazado' WHERE Confirma= 'En_Camino' ORDER BY Iddiagnostico ASC LIMIT 1";
                                            $Elimina = mysqli_query($conection, $Cons);
                                            $consulta= "INSERT INTO notificaciones (IdNotificacion, Mensaje, Fecha, IdHospital, NombreP, Estado) VALUES (NULL, 'Rechazado', CURRENT_TIME(), '{$TR1['IdHospital']}', '{$TR1['NombrePac']}', 'Enviado')";
                                            $resultado = mysqli_query($conection, $consulta);
                                        }
                                    }
                                }

                            }

                        }

                        else if(isset($_POST['Aceptar'])) {

                            while($TR1= mysqli_fetch_array($IDhos))
                            {
                                if($_SESSION['nombre'] == $TR1['HosDes'])
                                {
                                    if($AMBU['IdAmbulancia'] == $TR1['IdAmbulancia'])
                                    {
                                        if($AMBU['NombrePac'] == $TR1['NombrePac'])
                                        {
                                            $consulta= "INSERT INTO notificaciones (IdNotificacion, Mensaje, Fecha, IdHospital, NombreP, Estado) VALUES (NULL, 'Aceptado', CURRENT_TIME(), '{$TR1['IdHospital']}', '{$TR1['NombrePac']}', 'Enviado')";

                                            $resultado = mysqli_query($conection, $consulta);
                                            $consu= "UPDATE diagnostico SET Confirma = 'Aceptado' WHERE Confirma = 'En_Camino' ORDER BY Iddiagnostico ASC LIMIT 1";
                                            $RES= mysqli_query($conection, $consu);
                                        }
                                    }
                                }

                            } 
                        }
                    ?>
                    <div align="text-center">
                        <br>
                        <table class="table table-bordered">
                    <thead>
                        <tr><h4>Pacientes Aceptados</h4></tr>
                    </thead>
                           
                            <?php  
                                $mos2= mysqli_query($conection, $conf);
                                $sen1= mysqli_query($conection, $Pres);
                                $sen2= mysqli_query($conection, $Frec);
                                $sen3= mysqli_query($conection, $Ox);

                                while ($fila= mysqli_fetch_array($mos2))
                                {
                                    $PA = mysqli_fetch_array($sen1);
                                    $FR = mysqli_fetch_array($sen2);
                                    $SP = mysqli_fetch_array($sen3);

                                    if($fila['HosDes']== $_SESSION['nombre'])
                                    {
                                        if($fila['Confirma'] == 'Aceptado')
                                        {
                                            ?>
                                            <form method="post" action="confirmado.php">
                                            <tr>
                                                <td><h4>Nombre</h4></td>
                                                <td><?php echo $fila['NombrePac']; ?></td>
                                                <input type="hidden" name="NomH" value="<?php echo $fila["NombrePac"]; ?>">
                                            </tr>
                                            <tr>
                                                <td><h4>Edad</h4></td>
                                                <td><?php echo $fila['EdadPac'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><h4>Diagnostico</h4></td>
                                                <td><?php echo $fila['Diag']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><h4>Placa</h4></td>
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
                                                ?>
                                            <tr>
                                                <td>
                                                    <a href="SIGNOSV.php?id=<?php echo $fila['IdAmbulancia']?>">Ver Signos Vitales</a>
                                                </td>
                                                <td>
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Confirmar">
                                                </td>
                                            </tr> 
                                            </form>
                                            <?php     
                                        }
                                    }
                                }
                            ?>
                            </table>
                        </div>

                    <br>
                    <div>
                        <button type="button" class="btn btn-default btn-sm">
                            <a href="salir.php"><img src="images/out.png" alt="LogOut" width="40" height="30"></a>
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>