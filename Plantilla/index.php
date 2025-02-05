<?php 
    include("conectar.php");
    $datos= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '1'";
    $datos2= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '2'";
    $datos3= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '3'";
    $hosp= "SELECT Nombre FROM hospital";
    $inst= "SELECT H.Nombre, C.IdHospital, C.Internacion FROM hospital H, camillas C";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <?php include "functions.php";  ?>
        <title>Plataforma Virtual - Servicio de Salud</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container text-white">
                <p>Cochabamba, <?php echo fechaC(); ?></p>
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Red de Comunicacion</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Administracion Camillas</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">Buscar Hospital</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Envio Diagnostico</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="salir.php"><img class="close" src="assets/img/logout.png" width="40" height="40" alt="Salir del Sistema" title="Salir"></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Bienvenido</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Graphic Artist - Web Designer - Illustrator</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div>
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Administacion de Camillas</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div id="navigation">
                    <form>
                    <p><h3> Elige el Hospital: </h3> 
                        <select  name="Hospitales" class="selectpicker" data-width="150px">
                            <option value=" "></option>
                            <?php $res= mysqli_query($conection, $hosp);
                            while ($HOS=mysqli_fetch_array($res)) { ?>
                                <option><?php echo $HOS["Nombre"]?></option>
                            <?php  }  ?>   
                        </select>
                    </p>
                    </form>
                    <label> <h3> Ingrese su Contraseña: </h3></label>
                    <input type="password" name="Contraseña" placeholder="Ingese la contraseña de Usuario">
                    <br/>
                    <div class="form-group">
                        <button class="btn btn-secondary btn-sm" id="Comprobar" type="submit">
                            Comprobar 
                        </button>
                    </div>
                </div>
                <br>

                <div class="text-center text-align">
                    <form action="index.php" method="POST">
                        <input type="text" name="Id" placeholder="Introduzca el Id del Hospital">
                        <label><h4>Introduzca el numero de camillas de Internacion disponibles: </h4></label>
                        <br/>
                        <input type="text" name="NumeroCam" placeholder="# Camillas " width="150px">
                        <br/>
                        <br/>
                        <label><h4>Fecha:  </h4></label>
                        <input type="datetime" name="fecha" placeholder="DD/MM/YYYY" width="ml-auto">
                        <br/>
                        <label><h4>Hora:  </h4></label>
                        <input type="text" name="hora" placeholder="HH:MIN" width="auto">
                        <br/>
                        <button class="btn btn-primary btn-sm" value="Actual" name="btn_Actualizar" type="submit"> Actualizar </button>
                        <br/>
                        <br/>
                    </form>
                    <?php
                        if (isset($_POST['btn_Actualizar'])) 
                        {
                            $cama= $_POST['NumeroCam'];
                            $id= $_POST['Id'];

                            if($cama =="" || $id=="")
                            {
                                echo "Este Campo es Obligatorio Llenar";
                            }
                            else
                            {
                               $_UPDATE_SQL= "UPDATE camillas set Internacion = '$cama' WHERE IdHospital='$id' ";
                               mysqli_query($conection, $_UPDATE_SQL);
                            }
                        }

                    ?>
                </div>

                <div class="row">
                    <!-- Portfolio Item 1-->
                    <!-- Portfolio Item 2-->
                    <!-- Portfolio Item 3-->
                    <!-- Portfolio Item 4-->
                    
                    <!-- Portfolio Item 5-->
                    
                    <!-- Portfolio Item 6-->
                </div>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Lista de Hospitales</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div>
                    <div><h3>Hospitales de 1er Nivel</h3></div>
                    <div class="text-center align-items-center text-secondary text-align">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <td><h4>Nombre</h4></td>
                                    <td><h4>Telefono</h4></td>
                                    <td><h4> Camas Disponibles</h4></td>
                                    <td><h4>Fecha</h4></td>
                                    <td><h4>Hora</h4></td>
                                    <td><h4>Direccion</h4></td>
                                    <td><h4>MAPA</h4></td>
                                </tr>
                            </thead>
                            <?php $resultado1= mysqli_query($conection, $datos);

                            while ($row = mysqli_fetch_array($resultado1)) { ?>
                                <tr>
                                    <td><?php echo $row["Nombre"]; ?></td>
                                    <td><?php echo $row["Telefono"]; ?></td>
                                    <td><?php echo $row["Internacion"]; ?></td>
                                    <td><?php echo $row["Fecha"] ?></td>
                                    <td><?php echo $row["Hora"];  ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                    <td><button>VER MAPA</button></td>
                                </tr>

                            <?php    } ?>
                        </table>
                    </div>
                    <div><h3>Hospitales de 2do Nivel</h3></div>
                    <div class="text-center align-items-center text-secondary text-align">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <td><h4>Nombre</h4></td>
                                    <td><h4>Telefono</h4></td>
                                    <td><h4> Camas Disponibles</h4></td>
                                    <td><h4>Fecha</h4></td>
                                    <td><h4>Hora</h4></td>
                                    <td><h4>Direccion</h4></td>
                                    <td><h4>MAPA</h4></td>
                                </tr>
                            </thead>
                            <?php $resultado2= mysqli_query($conection, $datos2);

                            while ($row = mysqli_fetch_array($resultado2)) { ?>
                                <tr>
                                    <td><?php echo $row["Nombre"]  ?></td>
                                    <td><?php echo $row["Telefono"]  ?></td>
                                    <td><?php echo $row["Internacion"]; ?></td>
                                    <td><?php echo $row["Fecha"]  ?></td>
                                    <td><?php echo $row["Hora"];  ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                    <td>
                                        <?php
                                            echo "Distancia es: "

                                        ?>
                                        <button class="btn-sm">VER MAPA</button></td>
                                </tr>

                            <?php    } ?>
                        </table>
                        
                    </div>

                    <div><h3>Hospitales de 3er Nivel</h3></div>
                    <div class="text-center align-items-center text-secondary text-align">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <td><h4>Nombre</h4></td>
                                    <td><h4>Telefono</h4></td>
                                    <td><h4>Camas Disponibles</h4></td>
                                    <td><h4>Fecha</h4></td>
                                    <td><h4>Hora</h4></td>
                                    <td><h4>Direccion</h4></td>
                                    <td><h4>MAPA</h4></td>
                                </tr>
                            </thead>
                            <?php $resultado3= mysqli_query($conection, $datos3);

                            while ($row = mysqli_fetch_array($resultado3)) { ?>
                                <tr>
                                    <td><?php echo $row["Nombre"]  ?></td>
                                    <td><?php echo $row["Telefono"]  ?></td>
                                    <td><?php echo $row["Internacion"]; ?></td>
                                    <td><?php echo $row["Fecha"];  ?></td>
                                    <td><?php echo $row["Hora"]  ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                </tr>

                            <?php    } ?>
                        </table>
                        
                    </div>
                </div>

                <!-- About Section Button-->
            </div>
        </section>
        <!-- Contact Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Formulario del Paciente</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="control-group">
                                <div>
                                    <label for="Nombre">Nombre del Paciente:</label>
                                    <input class="form-control" id="nombre" type="text" placeholder="" required="required" data-validation-required-message="Porfavor ingrese el nombre del paciente" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div>
                                    <label for="Edad">Edad del Paciente: </label>
                                    <input class="form-control" id="edad" type="text" placeholder=" " required="required" data-validation-required-message="Porfavor ingrese la edad del paciente" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="presionart">Presion Arterial:</label>
                                    <input class="form-control" id="presionarterial" type="text" placeholder="Presion Arterial" required="required" data-validation-required-message="Porfavor ingrese la presion arterial del paciente" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div>
                                    <label for="diagnostico">Diagnostico</label>
                                    <textarea class="form-control" id="mensaje" rows="8" placeholder="Mensaje" required="required" data-validation-required-message="Porfavor introduzca un diagnostico previo del paciente"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div class="form-control">
                                <label><h3>Eliga el Hospital de destino</h3></label>
                                <select>
                                    <option value=" "></option>
                                    <?php $res= mysqli_query($conection, $hosp);
                                    while ($HOS=mysqli_fetch_array($res)) { ?>
                                    <option><?php echo $HOS["Nombre"]?></option>
                                    <?php  }  ?>
                                </select>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            2215 John Daniel Drive
                            <br />
                            Clark, MO 65243
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About Freelancer</h4>
                        <p class="lead mb-0">
                            Freelance is a free to use, MIT licensed Bootstrap theme created by
                            <a href="http://startbootstrap.com">Start Bootstrap</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright © Your Website 2020</small></div>
        </div>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
        <!-- Portfolio Modals-->
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Log Cabin</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal2Label">Tasty Cake</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cake.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal3Label">Circus Tent</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/circus.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal4Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal4Label">Controller</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/game.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal5Label">Locked Safe</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/safe.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-labelledby="portfolioModal6Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal6Label">Submarine</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="" />
                                    <!-- Portfolio Modal - Text-->
                                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                                    <button class="btn btn-primary" data-dismiss="modal">
                                        <i class="fas fa-times fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>