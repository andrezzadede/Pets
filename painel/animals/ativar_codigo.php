<?php

    session_start();
    if(isset($_SESSION['login'])){

        require_once '../../db/trackerdb.php';

        $id_animal = trim(addslashes($_POST['id_animal']));
        $codigo = trim(addslashes($_POST['codigo']));

        $lat = -22.6439502;
        $lng = -50.4231828;

        $trackerSim = gerarTrackerSimulator($id_animal, $lat, $lng);

        for($i = 0; $i < 30; $i++){

            $lat -= 0.01;
            $lng -= 0.01;

            $trackSim = gerarTrackerSimulator($id_animal, $lat, $lng);
        }


        header('location: animalDetails.php?id='. $id_animal);
    } else {

        header('location:/');
    }
?>