<?php

    require "Conexao.php";

    function getListCity(){
        
        $db = conectar();

        if($db !=null){
            $sql = "SELECT ESTADO.id_estado, estado.sigla, ESTADO.descricao, CIDADE.id_cidade, CIDADE.nome
            FROM CIDADE INNER JOIN ESTADO ON ESTADO.id_estado = CIDADE.estado_id ORDER BY cidade.id_cidade";

            $rs = $db->prepare($sql);
            $rs->execute();

            if($rs->rowCount()>0){
                $cidades = array();
                $count=0;
                while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                    $cidades[$count]=$row;
                    $count ++;
                }
                return $cidades;

            }
            return null;
        }

    
    }

    function getStates(){
        $db = conectar();
        
        if($db != null){

            $sql = "SELECT * FROM estado";
            $rs = $db->prepare($sql);
            $rs->execute();

            $estados = array();
            $i =0;
            
            if ($rs->rowCount() > 0){
                while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                    $estados[$i] = $row;
                    $i++;
                }   
            }
        }

        return $estados;  
    }

    function find($id_cidade) {
        
        $db = conectar();

        $sql = "select estado.id_estado, estado.descricao as estado, estado.sigla, 
        cidade.nome as cidade from cidade 
        inner join estado on estado.id_estado = cidade.estado_id
        where cidade.id_cidade = ?";

        $rs = $db->prepare($sql);
        $rs->bindValue(1, $id_cidade);
        $rs->execute();

        if($rs->rowCount() > 0) {
            $find = $rs->fetch(PDO::FETCH_ASSOC);
        }
        return $find;
    }


?>