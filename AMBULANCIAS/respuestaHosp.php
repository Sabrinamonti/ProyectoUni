<?php
include("conectar.php");
session_start();

    $amb= "SELECT * FROM ambulancia";
    $EnvioD= "SELECT * FROM `diagnostico` ORDER by `Iddiagnostico` DESC LIMIT 1";
    $EnvioN= "SELECT * FROM `notificaciones` ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe= "SELECT Fecha FROM notificaciones ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe1= "SELECT `Hora` FROM `diagnostico`ORDER BY `Iddiagnostico` DESC LIMIT 1";
    $Am= "SELECT A.Nombre FROM notificaciones N, ambulancia A, diagnostico D WHERE D.IdAmbulancia = A.IdAmbulancia ORDER BY D.Iddiagnostico DESC LIMIT 1";
    $NHosp= "SELECT H.Nombre, N.Fecha, N.NombreP FROM notificaciones N, diagnostico D, hospital H WHERE H.IdHospital= N.IdHospital ORDER BY N.IdNotificacion DESC LIMIT 1";
?>
<?php

$fec= mysqli_query($conection, $HoFe);
$fec2=mysqli_query($conection, $HoFe1);
$AM= mysqli_query($conection, $Am);
$EnvD= mysqli_query($conection, $EnvioD);
$EnvN= mysqli_query($conection, $EnvioN);
$NOMH = mysqli_query($conection, $NHosp);

$FECF= mysqli_fetch_array($fec);
$FECF2= mysqli_fetch_array($fec2);
$AMBU= mysqli_fetch_array($AM);
$ENVN= mysqli_fetch_array($EnvN);
$NOMHOS= mysqli_fetch_array($NOMH);

if(isset($_POST['confirmar']))
{
  while ($ENVD= mysqli_fetch_array($EnvD)) {

    if($_SESSION['nombre']== $AMBU['Nombre'])
    {

      if($ENVD['HosDes'] == $NOMHOS['Nombre'])
      {
        $Cons= "UPDATE notificaciones SET Estado = 'Visto' WHERE Estado = 'Enviado' ORDER BY IdNotificacion DESC LIMIT 1";
        $Elimina = mysqli_query($conection, $Cons);
        echo "Visto";
      }
    }
  }
}
header('location: index.php');
        
?>
<!DOCTYPE html>
<html>
<head>
  <title>Esperar respuestas</title>
</head>
<body>

</body>
</html>