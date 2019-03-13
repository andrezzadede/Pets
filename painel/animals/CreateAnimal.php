<?php

    session_start();
    if(isset($_SESSION['login'])){

        $nome   = addslashes(trim($_POST['nome']));
        $sexo   = addslashes(trim($_POST['sexo']));
        $nasc   = addslashes(trim($_POST['nascimento']));
        $nasc   = ($nasc == "")? date("Y-m-d") : $nasc;
        $cor    = addslashes(trim($_POST['cor']));
        $tipo   = addslashes(trim($_POST['tipo']));
        $raca   = addslashes(trim($_POST['raca']));
        $porte  = addslashes(trim($_POST['porte']));
        $dono = $_SESSION['login'];
        
        /*   echo "Nome do animal:". $nome . "<br>";
        echo "Id do dono:". $dono['id_dono'] . "<br>";
        echo "Nascimento:". $nasc . "<br>";
        echo "Cor:". $cor . "<br>";
        echo "Tipo:". $tipo . "<br>";
        echo "Raca:". $raca . "<br>";
        echo "Porte:". $porte . "<br>"; */

        require "../../db/Conexao.php";

        $db = conectar ();

        if($db != null){
           
            $sql = "INSERT INTO animaldb.animal (dono_id, nome, sexo, nascimento, cor, porte_id, raca_id, tipo_id) Values (?, ?, ?, ?, ?, ?, ?, ?)";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $dono['id_dono']);
            $rs->bindValue(2, $nome);
            $rs->bindValue(3, $sexo);
            $rs->bindValue(4, $nasc);
            $rs->bindValue(5, $cor);
            $rs->bindValue(6, $porte);
            $rs->bindValue(7, $raca);
            $rs->bindValue(8, $tipo);
            $rs ->execute();

            if($rs) {
                
                header("location: myAnimals.php");
            }else {
                echo "Erro!";
            }
        }
    }else {
        echo 'erro';
    }

?>