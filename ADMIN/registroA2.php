<?php
include("conectar.php");
$result="";  
	if(isset($_POST['volver']))
	{
		$result= "Atras";
	}
	header('Location: index.php?resultado='.$result);
?>