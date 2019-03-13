<?php

    require_once "Conexao.php";

    function insert($tracker){ // Responsavel por dar update nos animais

        $db = conectar();

        $sql = "INSERT INTO animaldb.tracker          
            (
                animal_id,
                data_registro,
                hora_registro,
                latitude,
                longitude,
                altitude       
            ) values (
                ?,
                ?,
                ?,
                ?,
                ?,
                ? 
            )";

        $rs = $db->prepare($sql);
        $rs->bindValue(1, $tracker->animal_id);
        $rs->bindValue(2, $tracker->data_registro);
        $rs->bindValue(3, $tracker->hora_registro);
        $rs->bindValue(4, $tracker->latitude);
        $rs->bindValue(5, $tracker->longitude);
        $rs->bindValue(6, $tracker->altitude);
        $success = $rs->execute();
            
        if($success){
            return true;
        }
            return false;
}

    function gerarTrackerSimulator($id_animal, $lat, $lng){

        $db = conectar();

        if($db!=null){

            $sql = "Insert into animaldb.tracker
                    (animal_id,
                    data_registro, 
                    hora_registro, 
                    latitude, 
                    longitude,
                    altitude) values (
                        ?,
                        current_date(),
                        current_time(),
                        ?,
                        ?,
                        ?)";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id_animal);
            $rs->bindValue(2, $lat);
            $rs->bindValue(3, $lng);
            $rs->bindValue(4, 0);
            $success = $rs->execute();

            if($success){
                return true;
            }
        }
        return false;
    }

    function verificaCodigo($id_animal){
        
        $db = conectar();

        if($db != null){

            $sql = "Select * from tracker where animal_id = ?";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id_animal);
            $rs->execute();

            if($rs->rowCount()>0){
                return true;
            }
        }
        return false;
    }
?>