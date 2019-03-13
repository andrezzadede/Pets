<?php
          
    function getPortes() {

        $db = conectar();

        if ($db != null){
            $sql = "SELECT * FROM animaldb.porte";

            $rs = $db->prepare($sql);
            $rs->execute();

            
            $portes = array();
            $count=0;    

            if($rs->rowCount()>0){
                while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
                    $portes[$count] = $row;
                    $count++;
                }
                return $portes;
            }
           
        }
        return null;
    
    }

?>