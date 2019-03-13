<?php

    require "Conexao.php";

    // Essa função é responsável por puxar todos os animais da tabela. 
    function getMyAnimals($id){ 
    
        // Conecta no banco atraves da função conectar que está no arquivo conexao.php
        $db = conectar(); 

        // Se o banco de dados estiver disponivel a sql faz um select no banco pegando as informações dos animais.
        if($db !=null){
            $sql = "select dono.nome as dono, animal.id_animal as animal, animal.nome,
                    animal.sexo, animal.nascimento, animal.cor,
                    porte.descricao as porte, raca.descricao as raca, tipo.descricao as tipo
                    from animal
                    inner join dono on dono.id_dono = animal.dono_id
                    inner join porte on porte.id_porte = animal.porte_id
                    inner join raca on raca.id_raca = animal.raca_id
                    inner join tipo on tipo.id_tipo = animal.tipo_id
                    where dono_id = ? order by animal.id_animal;";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id);
            $rs->execute();

            $myAnimals = array();
            $count = 0;
            
            if($rs->rowCount()>0){
                while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                    $myAnimals[$count] = $row;
                    $count++;
                } 
                return $myAnimals;
            }
        } 
            return 0;
    }

    // Função responsavel por deletar os animais
    function deleteAnimal($id){
        
        $db = conectar(); // Conecta no banco 
        
        if($db !=null){ // Se o banco estiver conectado ele faz o delete no banco atraves do id do animal.
        
            $sql = "DELETE FROM tracker WHERE animal_id =?";
        
            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id);
            $success = $rs->execute();   
            
            if($success){
                
                $sql = "DELETE FROM animal WHERE id_animal =?";
                $rs = $db->prepare($sql);
                $rs->bindValue(1, $id);
                $sucess = $rs->execute();
                return true;
            } 

        }else{
                echo "<p class ='alert alert-info'> Erro! </p>";
            }
    }

    function find($id){ // Responsavel por retornar o animal que o cliente quer editar
        
        $db = conectar();

        if($db !=null){
            $sql = "select dono.nome as dono, animal.id_animal as animal, animal.nome,
                    animal.sexo, animal.nascimento, animal.cor,
                    porte.descricao as porte, raca.descricao as raca, tipo.descricao as tipo
                    from animal
                    inner join dono on dono.id_dono = animal.dono_id
                    inner join porte on porte.id_porte = animal.porte_id
                    inner join raca on raca.id_raca = animal.raca_id
                    inner join tipo on tipo.id_tipo = animal.tipo_id
                    where animal.id_animal = ?";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id);
            $rs->execute();

            if($rs){
                $animal=$rs->fetch(PDO::FETCH_ASSOC);
            }
            return $animal;
        }
    }

    function update($animal){ // Responsavel por dar update nos animais

        $db = conectar();

        $sql = "UPDATE animaldb.animal SET         
                nome = ?,
                sexo = ?,
                nascimento = ?,
                cor = ?,
                porte_id = ?,
                raca_id = ?,
                tipo_id = ? 
                WHERE id_animal =?";

        $rs = $db->prepare($sql);
        $rs->bindValue(1, $animal->nome);
        $rs->bindValue(2, $animal->sexo);
        $rs->bindValue(3, $animal->nascimento);
        $rs->bindValue(4, $animal->cor);
        $rs->bindValue(5, $animal->porte);
        $rs->bindValue(6, $animal->raca);
        $rs->bindValue(7, $animal->tipo);
        $rs->bindValue(8, $animal->id);
        $success = $rs->execute();

        if($success){
            return true;
        }
            return false;
    }

    // Essa função é responsavel por pegar a ultima localização do animal para ser mostrar na tela inicia do site. 
    function getLastPosition($idAnimal) { 

        $db = conectar();

        if($db != null) {
                
            $sql = "SELECT * FROM tracker WHERE animal_id = ? ORDER BY tracker.id_tracker DESC LIMIT 1";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $idAnimal);
            $rs->execute();

            if($rs->rowCount() > 0) {
                return $rs->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return null;
    }


?>