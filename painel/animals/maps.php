<?php

    session_start();

    if(isset($_SESSION['login'])){

        $dono = $_SESSION['login'];

        $id_animal = $_GET['id'];

        function parseToXML($htmlStr){ // Ela está transformando os dados do banco em XML
            
            $xmlStr=str_replace('<', '&lt;', $htmlStr);
            $xmlStr=str_replace('>', '&gt;', $xmlStr);
            $xmlStr=str_replace('"','&quot;',$xmlStr);
            $xmlStr=str_replace("'",'&#39;',$xmlStr);
            $xmlStr=str_replace("&",'&amp;',$xmlStr);
            return $xmlStr;
        }

        require_once '../../db/Conexao.php';

        $db = conectar();

        if($db != null){

            $sql = "select animal.id_animal, dono.id_dono, dono.nome as dono,
            animal.nome as animal, tracker.id_tracker, tracker.data_registro as data,
            tracker.hora_registro as hora, tracker.latitude, tracker.longitude, tracker.altitude
            from tracker
            inner join animal on animal.id_animal = tracker.animal_id
            inner join dono on dono.id_dono = animal.dono_id
            where animal_id = ? 
            order by tracker.id_tracker desc limit 35";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id_animal);
            $rs->execute();

            if($rs->rowCount() > 0){

                //Codigo disponivel no site do api do Google Maps

                header("Content-type: text/xml");

                //Start XML file, echo parent node

                echo '<markers>';

                while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                    $dataFormatada = "Data: ". $row['data'];
                    $dataFormatada .= " - Hora: ";
                    $dataFormatada .= $row['hora'];
                    echo '<marker ';
                    echo 'name="' . parseToXML($row['animal']) . '" ';
                    echo 'address="' . parseToXML($dataFormatada) . '" ';
                    echo 'lat="' . parseToXML($row['latitude']) . '" ';
                    echo 'lng="' . parseToXML($row['longitude']) . '" ';
                    echo 'type="' . parseToXML($row['altitude']). '" ';
                    echo '/>';
                }

                // End XML file
                echo '</markers>';
            }else {
                die('tracker vazio...');
            }
        }else{
            die("Banco desconectado...");
        }
    }else{
        header('location: ../../index.html');
        die('Usuário não está logado...');
    }
?>