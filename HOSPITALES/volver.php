<?php
include("conectar.php");
$result="";  
	if(isset($_POST['volver']))
	{
		$result= "Atras";
	}
	header('location: index.php');
?>