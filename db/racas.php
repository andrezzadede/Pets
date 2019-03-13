<?php
         
    function getRacas() {

        $db = conectar();

        $sql = "SELECT * FROM animaldb.raca";

        $rs = $db->prepare($sql);
        $rs->execute();

        $racas = array();
        $count=0;

        if($rs->rowCount()>0){
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
                $racas[$count] = $row;
                $count++;
            }
            return $racas;
        }else{
            return null;
        }
    }


?>