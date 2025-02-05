<?php 
include("conectar.php");
$result="";
session_start();
$NomH= $_POST['NomH'];

$conf= "SELECT D.NombrePac, D.EdadPac, D.Diag, D.HosDes, A.Placa, D.IdAmbulancia, D.Confirma FROM diagnostico D, ambulancia A WHERE A.IdAmbulancia= D.IdAmbulancia ORDER BY Iddiagnostico DESC";

 $mos2= mysqli_query($conection, $conf);



    while ($FILA= mysqli_fetch_array($mos2)) {

        if($_SESSION['nombre'] == $FILA['HosDes'])
        {
            if($FILA['Confirma'] == 'Aceptado')
            {
                if($NomH == $FILA['NombrePac'])
                {
                    $Consult= "UPDATE diagnostico SET Confirma = 'LLegado' WHERE NombrePac = '{$FILA['NombrePac']}'";
                    $resultado = mysqli_query($conection, $Consult);
                    
                    if($resultado)
                    {
                        $result="Exitoso";
                    }
                    else
                    {
                        $result="Error";
                    }
                }
            }
        }

    }



	
header('Location: index.php?resultado='.$result);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>