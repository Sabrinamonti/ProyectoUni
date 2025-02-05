<?php 
    include("conectar.php");
    $hosp= "SELECT Nombre FROM hospital";
    $inst= "SELECT H.Nombre, C.IdHospital, C.Internacion FROM hospital H, camillas C";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualiazcion Camillas</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">ACTUALIZAR CAMILLAS</h2>
                        <div class="form-group">
                            <p><h3>Eliga el Hospital al que pertenece: </h3>
                            <select  name="Hospitales" class="selectpicker" data-width="500px">
                                <option value=" "></option>
                                <?php $res= mysqli_query($conection, $hosp);
                                while ($HOS=mysqli_fetch_array($res)) { ?>
                                    <option><?php echo $HOS["Nombre"]?></option>
                                <?php  }  ?>   
                            </select>
                            </p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Comprobar"/>
                        </div>
                    </form>
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label><h4>Introducir el numero de Camillas de Sala de Internacion</h4></label>
                            <input type="text" class="form-input" name="NumCam" id="NumCam" placeholder="#Camas Disponibles">
                        </div>
                        <div class="form-group">
                            <input type="text" name="id" class="form-input" id="id" placeholder="#id del Hospital">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn_actualizar" id="btn_actualizar" class="form-submit"> ACTUALIZAR </button>   
                        </div>
                    </form>
                    <?php
                        $fecha= date('Y-m-d');
                        $hora= date('H:i:s');

                        if (isset($_POST['btn_actualizar'])) 
                        {
                            $cama= $_POST['NumCam'];
                            $id= $_POST['id'];

                            if($cama =="" || $id=="")
                            {
                                echo "Este Campo es Obligatorio Llenar";
                            }
                            else
                            {
                               $_UPDATE_SQL= "UPDATE camillas set Internacion = '$cama', Fecha= '$fecha', Hora = '$hora' WHERE IdHospital='$id' ";
                               mysqli_query($conection, $_UPDATE_SQL);
                            }
                        }

                    ?>
                    <div>
                        <button type="button" class="btn btn-default btn-sm">
                            <a href="salir.php"><img src="colorlib-regform-8/form/images/logout.jpg" alt="LogOut"></a>
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