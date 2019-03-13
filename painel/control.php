<?php
  
  session_start();
  if(!isset($_SESSION['login'])){
    header("location:../index.html");
  }else {
    require "../db/animaldb.php";
    $dono = $_SESSION ['login'];
    // echo $dono['id_dono'];
    $myAnimals = getMyAnimals($dono['id_dono']);  
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <link rel="icon" type="image/png" href="../img/crown.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      
    <title>Pandora Trackers</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/fa-svg-with-js.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css" />
    
    <style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
        height: 65%;
        width: 80%;
        left: 10%;

      }
      
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
        
      @media(max-width: 480px){
        #map {
          height:100%;
          width: 100%;
          left: 0;
        }
      }
    </style>

  </head>

  <body>
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom box-shadow">
        
        <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #dc3545;">Pandora Trackers</h5>
          <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-white" href="#">Tracker</a>
            <a class="p-2 text-white" href="../login/logout.php">Sair</a>
          </nav>  

      </div>
      <!-- Fim do Menu principal -->

      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">
          <i class="fas fa-chess-queen"></i>
        </h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="animals/myAnimals.php">Meus animais</a>
          <a class="p-2 text-dark" href="perfilDetails.php">Perfil <i class="fas fa-address-card"></i></a>
        </nav>
      </div>
      <!-- Fim do Menu Secundario -->
      
      <div class="row">
        <div class="col-sm-12">
          <p>
            <?php  
                                        
              if(isset($_SESSION['login'])) {

                $login = $_SESSION['login'];

                echo "Bem vindo, ". $login['nome'] ."!";

              }else {
                echo "ERRO!";
              }
                  
            ?>
          </p>
        </div>
      </div> <!-- fim row login -->              
  
    </div> 

    <div id="map"></div>
      
    <script>
        var customLabel = {
          restaurant: {
            label: 'R'
          },
          bar: {
            label: 'B'
          }
      };

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
                  center: new google.maps.LatLng(-22.644315,-50.421688),
                  zoom: 1
            });

        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('../db/dbmaps.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}

    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2M0HeLHC6vf_ORAmGY0iCrBIrH00ISNg&callback=initMap">
    </script>
  
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/fontawesome-all.min.js"></script>
    <p class="mt-5 mb-3 text-muted" style="text-align: center;">Todos os direitos reservados &copy; 2018</p>
  </body>
</html>
