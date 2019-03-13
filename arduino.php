<?php

    /*
    http://localhost/myApp/arduino.php?animal_id=1&latitude=2312312&longitude=13123&altitude=1231231
    */

    require __DIR__ . '/db/trackerdb.php';

    $params = [ // Vetor com as informações 
        'animal_id',
        'latitude',
        'longitude',
        'altitude'
    ];

    foreach($params as $param) // Condiçao que roda todo o vetor sem precisar de um contador
        if(!in_array($param, array_keys($_REQUEST)))
            exit("Parâmetro {$param} não informado");
            $hora = new DateTime();
            $fuso = new DateTimeZone('America/Sao_Paulo');
            $hora->setTimezone($fuso);

    $tracker = (object)[
        'animal_id' => $_REQUEST['animal_id'],
        'data_registro' => date('Y-m-d'),
        'hora_registro' => $hora->format("h:i:s"),
        'latitude' => $_REQUEST['latitude'],
        'longitude' => $_REQUEST['longitude'],
        'altitude' => $_REQUEST['altitude']
    ];

    if(!insert($tracker))
        exit("Falha ao inserir dados!!!");

    exit("Dados inseridos com sucesso!!!");
?>
