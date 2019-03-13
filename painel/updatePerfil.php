<?php

    session_start();

    if(!isset($_SESSION['login'])){

        header("location: ../index.html");

    }else {
    
        require_once "../db/ownerdb.php";   
     
        $dono = $_SESSION['login'];

        $nome = addslashes(trim($_POST['nome']));
        $cel = addslashes(trim($_POST['celular']));
        $cidade = addslashes(trim( isset($_POST['cidade'])? $_POST['cidade'] : $dono['cidade_id']));
        $senha = addslashes(trim($_POST['senha']));

        if($senha==""){
            $senhaMD5 = $dono['senha'];
        }else{
            $senhaMD5=md5($senha);
        }
        
        /*      echo "Id do dono:".$idDono['id_dono']."<br>";
        echo "Seu nome: ". $nome . "<br>";
        echo "Seu celular: ". $cel . "<br>";
        echo "Sua cidade: ". $cidade . "<br>";
        echo "Sua senha: ". $senha . "<br>";
         */

        require_once "../db/Conexao.php";

        $db = conectar();

        if($db!=null){
         
            $sql ="UPDATE animaldb.dono SET nome = ?, senha= ?, celular= ?, cidade_id= ? WHERE id_dono = ?";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $nome);
            $rs->bindValue(2, $senhaMD5);
            $rs->bindValue(3, $cel);
            $rs->bindValue(4, $cidade);
            $rs->bindValue(5, $dono['id_dono']);
            $rs->execute();

            if($rs){
                var_dump($dono);
                $dono= getDono($dono['id_dono']);
                $_SESSION['login'] = $dono;
                header("location: perfilDetails.php");
            }else {
                $_SESSION['message']="Erro ao atualizar";
                header("location: panelErr.php");
            }
        }
    }


?>