<?php

    session_start();
    if(!isset($_SESSION['login']) ) {
        header("location: ../../index.html");
    }else {
        $id = addslashes(trim($_GET['id']));
        require_once '../../db/animaldb.php';

        require_once '../../db/trackerdb.php';

        $animal = find($id);

        $trackerAtivo = verificaCodigo($id);
    }
       
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <link rel="icon" type="image/png" href="../img/icon.png"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pandora Trackers</title>

        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/fa-svg-with-js.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/style.css" />

        <style>
            .table .td-1 {
                font-weight: bold;
            }

            #map {
            min-height: 400px;
            max-height: 400px;
            background-size: border-box;
        }

        @media(max-width: 480px) {
                #map {
                min-height: 200px;
                max-height: 250px;
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
                    <a class="p-2 text-white" href="../../login/logout.php">Sair</a>
                </nav>
            </div>
            <!-- Fim do Menu principal -->

            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">
                    <i class="fas fa-chess-queen"></i>
                </h5>
                <nav class="my-2 my-md-0 mr-md-3">

                    <?php
                        if(!$trackerAtivo){
                            echo"<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal'>";
                            echo"Tracker Code";
                            echo"</button>";
                        }
                    ?>


                    <a class="p-2 text-dark" href="myAnimals.php"> Voltar </a>
                </nav>    
            </div> 

                <!-- Fim do Menu Secundario -->

                <div class="row">
                    <div class="col-sm-6">
                        <h2><?php echo $animal['nome']?></h2>
                        <table class="table table-striped">             
                            
                            <tr>
                                <td class="td-1">Sexo</td>
                                <td> <?php 
                                
                                $sexo = ($animal['sexo'] == 'F')? "Fêmea" : "Macho";
                                echo $sexo;
                                ?></td>
                            
                            </tr>

                            <tr>
                                <td class="td-1">Nascimento</td>
                                <td> <?php 

                                $nasc = new DateTime($animal['nascimento']);
                                echo $nasc->format("d M Y");
                                
                                ?>
                                
                                </td>
                            
                            </tr>

                            <tr>
                                <td class="td-1">Cor</td>
                                <td> <?php echo $animal['cor']; ?></td>
                            
                            </tr>

                            <tr>
                                <td class="td-1">Porte</td>
                                <td> <?php echo $animal['porte']; ?></td>
                            
                            </tr>

                            <tr>
                                <td class="td-1">Raça</td>
                                <td> <?php echo $animal['raca']; ?></td>
                            
                            </tr>

                            <tr>
                                <td class="td-1">Tipo</td>
                                <td><?php echo $animal['tipo']; ?></td>
                            
                            </tr>
                        
                        
                        </table>

                        
                        </div>

                        
                        <div class="col-sm-6">

                            <div id="map"> </div>

                            
                        
                        </div>

                    
                    
                    </div> <!--Fim tabela detalhes -->
                
                  <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
            '           <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tracker Simulador</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="ativar_codigo.php" method="post">

                                <input type="hidden" name="id_animal" value="<?=$animal['animal']?>">

                                <div class="form-group">
                                
                                    <label for="codigo">Codigo de ativação</label>
                                    <input type="text" id="codigo" name="codigo" class="form-control"
                                        placeholder="Informe o código do rastreador" required>
                                
                                </div>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-danger">Ativar</button>

                                </div>
                            
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                        </div>
                    </div>
                </div>
            </div> <!-- end janela de ativação de código -->

        </div> 

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
            downloadUrl('maps.php?id=<?php echo $animal['animal'] ?>', function(data) {
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

            <script src="../../bootstrap/js/jquery.js"></script>
            <script src="../../bootstrap/js/bootstrap.min.js"></script>
            <script src="../../bootstrap/js/fontawesome-all.min.js"></script>
    </body>
</html>
