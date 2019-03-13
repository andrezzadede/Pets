<?php

    session_start();
    
    if(isset($_SESSION['login'])){
        $dono = $_SESSION['login'];
    }else{
        die("Não está logado");
    }

    /*
    *  Função parseToXML disponivel no site da Api do google maps
    *  link: https://developers.google.com/maps/documentation/javascript/mysql-to-maps?hl=pt-br
    */
    
    function parseToXML($htmlStr){

        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }      

    require "animaldb.php";

    // variavel animais recebe todos os aniamis do dono que esta logado
    $animais = getMyAnimals($dono["id_dono"]);

    // define a variavel como um vetor
    $positions = array();

    foreach($animais as $animal) {

        $aux = getLastPosition($animal['animal']);

        // esta variavel e um array associativo criado para definir os dados importantes que será passado para o vetor de posiçoes
        $position = [
            "nome" => $animal['nome'],
            "data" => $aux['data_registro'],
            "hora" => $aux['hora_registro'],
            "latitude" => $aux['latitude'],
            "longitude" => $aux['longitude'],
            "altitude" => $aux['altitude']
        ];
        
        // Adiciona no vetor de posições em forma de objetos ;)
        array_push($positions, (object) $position);
    }

    /* Codigo disponivel no site da API do Google Maps */
    header("Content-type: text/xml");

    // Start XML file, echo parent node
    echo '<markers>';

    // cada posição ele converte pra xml e manda pro mapa
    foreach($positions as $position) {

        $dataFormatada = "Data: ". $position->data;
        $dataFormatada .= " - Hora: ";
        $dataFormatada .= $position->hora;
        echo '<marker ';
        echo 'name="' . parseToXML($position->nome) . '" ';
        echo 'address="' . parseToXML($dataFormatada) . '" ';
        echo 'lat="' . parseToXML($position->latitude) . '" ';
        echo 'lng="' . parseToXML($position->longitude) . '" ';
        echo 'type="' . parseToXML($position->altitude). '" ';
        echo '/>';                  
    }
                
    // End XML file
    echo '</markers>';

?>