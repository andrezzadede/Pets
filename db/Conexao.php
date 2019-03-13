<?php

    function conectar(){

        $URL = "mysql:host=localhost;dbname=animaldb";
        $USER = "root";
        $PASS = "";

        try {

            $pdo = new PDO ($URL, $USER, $PASS);
            $pdo->query("set names utf8");

           // echo "Banco conectado com sucesso!";

        } catch (PDOException $e) {

            echo "Erro: ". $e->getMessage();

        }
        return $pdo;
                
    }
?>