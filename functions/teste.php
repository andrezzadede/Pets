<?php

require '../db/animaldb.php';

$animais = getMyAnimals(5);

$positions = array();

foreach($animais as $animal) {


    $aux = getLastPosition($animal['animal']);

    $position = [
        "nome" => $animal['nome'],
        "data" => $aux['data_registro'],
        "hora" => $aux['hora_registro'],
        "latitude" => $aux['latitude'],
        "longitude" => $aux['longitude'],
        "altitude" => $aux['altitude']
    ];

    array_push($positions, (object) $position);

}

echo "<pre>";
 var_dump($positions);
 echo "</pre>";

 function parseToXML($htmlStr)
 {
     $xmlStr=str_replace('<','&lt;',$htmlStr);
     $xmlStr=str_replace('>','&gt;',$xmlStr);
     $xmlStr=str_replace('"','&quot;',$xmlStr);
     $xmlStr=str_replace("'",'&#39;',$xmlStr);
     $xmlStr=str_replace("&",'&amp;',$xmlStr);
     return $xmlStr;
 }

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

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