<?php   
    include("conectar.php");
    include "functions.php";
    session_start();
    header("Refresh: 60");
    $datos= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha, H.Latitud, H.Longitud FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '1'";
    $datos2= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha, H.Latitud, H.Longitud FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '2'";
    $datos3= "SELECT H.Nombre, C.Internacion, C.Hora, H.Direccion, H.Telefono, C.Fecha, H.Latitud, H.Longitud FROM hospital H, camillas C WHERE H.IdHospital = C.IdHospital AND C.Internacion > '0' AND H.Nivel_de_Hospital = '3'";
    $hosp= "SELECT Nombre FROM hospital";
    $inst= "SELECT H.Nombre, C.IdHospital, C.Internacion FROM hospital H, camillas C";
    $amb= "SELECT * FROM ambulancia";
    $EnvioD= "SELECT * FROM `diagnostico` ORDER by `Iddiagnostico` DESC LIMIT 1";
    $EnvioN= "SELECT * FROM `notificaciones` ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe= "SELECT Fecha FROM notificaciones ORDER BY `IdNotificacion` DESC LIMIT 1";
    $HoFe1= "SELECT `Hora` FROM `diagnostico`ORDER BY `Iddiagnostico` DESC LIMIT 1";
    $Am= "SELECT A.Nombre FROM notificaciones N, ambulancia A, diagnostico D WHERE D.IdAmbulancia = A.IdAmbulancia ORDER BY D.Iddiagnostico DESC LIMIT 1";
    $NHosp= "SELECT H.Nombre, N.Fecha, N.NombreP FROM notificaciones N, diagnostico D, hospital H WHERE H.IdHospital= N.IdHospital ORDER BY N.IdNotificacion DESC LIMIT 1";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Red de Comunicaciones - Ambulancias</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Laura - v2.1.0
  * Template URL: https://bootstrapmade.com/laura-free-creative-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAbPcvthtv1DfSKI0cmwf_P1SHgzPfPQ4&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

    <style type="text/css">

      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #map {
        height: 20%;
        width: 10%;
      }

      #output {
        font-size: 17px;
      }
    </style>
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script>
      function initMap(lt,ln) {
        if(!! navigator.geolocation){

        navigator.geolocation.getCurrentPosition(function(position){

          var geolocate= new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        const bounds = new google.maps.LatLngBounds();
        const markersArray = [];
        const origin1 = { lat: lt , lng: ln};
        //const destinationB = { lat: 35.963091, lng: -78.824184 };
        const destinationIcon =
          "https://chart.googleapis.com/chart?" +
          "chst=d_map_pin_letter&chld=D|FF0000|000000";
        const originIcon =
          "https://chart.googleapis.com/chart?" +
          "chst=d_map_pin_letter&chld=O|FFFF00|000000";
        const map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 55.53, lng: 9.4 },
          zoom: 10,
        });
        const geocoder = new google.maps.Geocoder();
        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
          {
            origins: [origin1],
            destinations: [geolocate],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false,
          },
          (response, status) => {
            if (status !== "OK") {
              alert("Error was: " + status);
            } else {
              const originList = response.originAddresses;
              const destinationList = response.destinationAddresses;
              const outputDiv = document.getElementById("output");
              outputDiv.innerHTML = "";
              deleteMarkers(markersArray);

              const showGeocodedAddressOnMap = function (asDestination) {
                const icon = asDestination ? destinationIcon : originIcon;

                return function (results, status) {
                  if (status === "OK") {
                    map.fitBounds(bounds.extend(results[0].geometry.location));
                    markersArray.push(
                      new google.maps.Marker({
                        map,
                        position: results[0].geometry.location,
                        icon: icon,
                      })
                    );
                  } else {
                    alert("Geocode was not successful due to: " + status);
                  }
                };
              };

              for (let i = 0; i < originList.length; i++) {
                const results = response.rows[i].elements;
                geocoder.geocode(
                  { address: originList[i] },
                  showGeocodedAddressOnMap(false)
                );

                for (let j = 0; j < results.length; j++) {
                  geocoder.geocode(
                    { address: destinationList[j] },
                    showGeocodedAddressOnMap(true)
                  );
                  //$a = results[j].duration.text;
                  //return a;
                  outputDiv.innerHTML +=
                  originList[i] +
                    " to " +
                    destinationList[j] +
                    ": " +
                    "<br> La Distancia es: " +
                    results[j].distance.text +
                    " <br> El tiempo que tarda es: " +
                    results[j].duration.text +
                    "<br>";
                }
              }
            }
          }
        ); 
        });
      }
      }

      function deleteMarkers(markersArray) {
        for (let i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }
    </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  d-flex justify-content-center align-items-center header-transparent">

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <div class="text-white text-left"><p>Cochabamba, <?php echo fechaCos(); ?></p> </div>
        <li class="active"><a href="index.php">Inicio</a></li>
        <li><a href="#about">Lista de Hospitales</a></li>
        <li><a href="#contact">Envio Diagnostico</a></li>
        <li><a href="salir.php"><img src="assets/img/out.png" width="40" height="30" title="Salir"></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
  	<style type="text/css">
  		
  	</style>
    <div class="hero-container">
      <h1>Bienvenidos</h1>
      <h2>Plataforma Virtual para la Comunicacion entre la Salud</h2>
      <a href="#about" class="btn-scroll scrollto" title="Scroll Down"><i class="bx bx-chevron-down"></i></a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Me Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <span>Lista de Hospitales</span>
          <h2>Lista de Hospitales</h2>
          <p>A continuacion se podra ver una tabla con los Hospitales que contengan camas disponibles: </p>
        </div>

        <div class="panel panel-default">
                    <div class="panel-heading"><h3>Hospitales de 1er Nivel</h3></div>
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
                                    <td><h4>Mapa</h4></td>
                                    
                                </tr>
                            </thead>
                            <?php $resultado1= mysqli_query($conection, $datos);

                            while ($row = mysqli_fetch_array($resultado1)) { ?>
                              
                              <form method="post" action="MAPA.php">
                                <tr>
                                    <td><?php echo $var =$row['Nombre'] ?>
                                        <input type="hidden" name="NomH" value="<?php echo $row["Nombre"] ?>">
                                    </td>
                                    <td><?php echo $row["Telefono"]; ?></td>
                                    <td><?php echo $row["Internacion"]; ?></td>
                                    <td><?php echo $row["Fecha"] ?></td>
                                    <td><?php echo $row["Hora"];  ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                    <td>
                                      <input type="submit" class="btn btn-primary btn-sm" value="Ver Mapa">
                                    </td>
                                </tr>
                              </form>

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
                                    <td><h4>Mapa</h4></td>
                                </tr>
                            </thead>
                            <?php $resultado2= mysqli_query($conection, $datos2);

                            while ($row = mysqli_fetch_array($resultado2)) {
                              $LAT = $row['Latitud'];
                              $LEN = $row['Longitud'];

                              ?>
                              <form action="MAPA.php" method="POST">
                                <tr>
                                    <td><?php echo $row["Nombre"]  ?>
                                        <input type="hidden" name="NomH" value="<?php echo $row["Nombre"] ?>">
                                    </td>
                                    <td><?php echo $row["Telefono"]  ?></td>
                                    <td><?php echo $row["Internacion"]; ?></td>
                                    <td><?php echo $row["Fecha"]  ?></td>
                                    <td><?php echo $row["Hora"];  ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                    <td>
                                      <input type="submit" class="btn btn-primary btn-sm" value="Ver Mapa">
                                    </td>
                                </tr>
                              </form>

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
                                    <td><h4>Mapa</h4></td>
                                    
                                </tr>
                            </thead>
                            <?php $resultado3= mysqli_query($conection, $datos3);

                            while ($row2 = mysqli_fetch_array($resultado3)) { 
                              $LAT2 = $row2['Latitud'];
                              $LEN2 = $row2['Longitud'];
                              ?>
                              <form method="post" action="MAPA.php">
                                <tr>
                                    <td><?php echo $row2["Nombre"]  ?>
                                        <input type="hidden" name="NomH" value="<?php echo $row2["Nombre"] ?>">
                                    </td>
                                    <td><?php echo $row2["Telefono"]  ?></td>
                                    <td><?php echo $row2["Internacion"]; ?></td>
                                    <td><?php echo $row2["Fecha"];  ?></td>
                                    <td><?php echo $row2["Hora"]  ?></td>
                                    <td><?php echo $row2["Direccion"]; ?></td>
                                    <td>
                                      <input type="submit" class="btn btn-primary btn-sm" value="Ver Mapa">
                                    </td>
                                </tr>
                              </form>

                            <?php    } ?>
                        </table>
                        
                    </div>
                </div>
      </div>
    </section><!-- End About Me Section -->

    <!-- ======= My Resume Section ======= -->
    <!-- End My Resume Section -->

    <!-- ======= My Services Section ======= -->
    <!-- End My Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- End Testimonials Section -->

    <!-- ======= My Portfolio Section ======= -->
    <!-- End My Portfolio Section -->

    <!-- ======= Pricing Section ======= -->
    <!-- End Pricing Section -->

    <!-- ======= Contact Me Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Envio Diagnostico</span>
          <h2>Envio Diagnostico</h2>
        </div>

        <div class="row align-items-center" >

          <div class="col-lg-6 align-items-center">
            <form action="diagnostico.php" method="POST" class="align-items-center">
              <div class="form-row align-items-center">
                <div class="col-md-6 form-group align-items-center">
                	<label><h5>Introducir los Datos del Paciente: </h5></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre Completo del Paciente" data-rule="minlen:4" data-msg="Porfavor introducir el nombre del paciente" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="edad" id="edad" placeholder="Edad del Paciente" data-rule="minlen:4" data-msg="Porfavor Introducir la Edad del Paciente" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="diagnostico" rows="15" data-rule="required" data-msg="Porfavor Introducir un Diagnostico previo" placeholder="Diagnsotico"></textarea>
                <div class="validate"></div>
              </div>
              <div class="form-group">
              	<label><h6>Elegir el Hospital de Destino: </h6></label>
              	<select name="hospita">
              		<option value=" "></option>
                    <?php $res= mysqli_query($conection, $hosp);
                    while ($HOS=mysqli_fetch_array($res)) { ?>
                    	<option><?php echo $HOS["Nombre"]?></option>
                    <?php  }  ?>
              	</select>
              </div>
              
              <div class="text-center"><button type="submit" name="btn_enviar">Enviar Diagnostico</button></div>
            </form>
            <script type="text/javascript" src="../assets/js/Evitar.js"></script>
            
          </div>
            
        </div>
        <br>
        <div id="respuestaH">
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

          if($_SESSION['nombre']== $AMBU['Nombre'])
          {
            while ($ENVD= mysqli_fetch_array($EnvD)) {

              if($ENVD['HosDes'] == $NOMHOS['Nombre'])
              {
                if($FECF2['Hora'] < $FECF['Fecha'] && $ENVN['Estado'] == 'Enviado')
                {
                  ?>
                    <script src="assets/js/notif.js"></script>
                  <?php
                  echo "El Paciente " .$NOMHOS['NombreP']. " fue " .$ENVN['Mensaje']. " en " .$ENVD['HosDes']. " a las " .$ENVN['Fecha'];
                  ?>
                  <form method="post" action="respuestaHosp.php">
                    <button type="submit" name="confirmar" class="btn btn-primary">Confirmar</button>
                  </form>
                  <?php
                }
                else
                {
                  echo " ";
                }
              }
            }
          }
        ?>
          
        </div>

      </div>
    </section><!-- End Contact Me Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Laura Thomson</h3>
      <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Laura</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/laura-free-creative-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>