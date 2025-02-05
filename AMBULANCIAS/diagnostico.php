<?php 
include("conectar.php");
session_start();
  $EnvioD= "SELECT * FROM `diagnostico` ORDER by `Iddiagnostico` DESC LIMIT 1";
  $EnvioN= "SELECT * FROM `notificaciones` ORDER BY `IdNotificacion` DESC LIMIT 1";
  $HoFe= "SELECT Fecha FROM notificaciones ORDER BY `IdNotificacion` DESC LIMIT 1";
  $HoFe1= "SELECT `Hora` FROM `diagnostico`ORDER BY `Iddiagnostico` DESC LIMIT 1";
  $nom= "SELECT Nombre, IdAmbulancia FROM ambulancia";
 ?>
 <?php
  $resultado= "";    

  if(isset($_POST['btn_enviar']))
  {
    $NombrePac= $_POST['name'];
    $EdadPac= $_POST['edad'];
    $DiagnosPac= $_POST['diagnostico'];
    $HosDes= $_POST['hospita'];

    $Nom= mysqli_query($conection, $nom);

    while($NOM= mysqli_fetch_array($Nom))
    {
      if($_SESSION['nombre'] == $NOM['Nombre'])
      {

        $Env= "INSERT INTO diagnostico (NombrePac, EdadPac, Diag, HosDes, Hora, IdAmbulancia, Confirma) VALUES ('$NombrePac', '$EdadPac', '$DiagnosPac', '$HosDes', CURRENT_TIME(), '{$NOM['IdAmbulancia']}', 'En_Camino');";
        $obt= mysqli_query($conection, $Env);
        if ($obt){
          $resultado = "Envio Exitoso";
        } else {
          $resultado = "Error al enviar";
        }
      }
    }

  }
  header('Location: index.php?resultado='.$resultado);
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <label><h1>Esperando la Respuesta...</h1></label>
  <br>
</body>
</html>