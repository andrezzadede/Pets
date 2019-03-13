<?php


    require_once "Conexao.php";

    function getTipos() {

        $db = conectar();

        $sql = "SELECT * FROM animaldb.tipo";

        $rs = $db->prepare($sql);
        $rs->execute();

        $tipos = array();
        $count=0;

        if($rs->rowCount()>0){
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
                $tipos[$count] = $row;
                $count++;
            }
            return $tipos;
        }else{
            return null;
        }
    }

   

?>