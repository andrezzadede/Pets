<?php

    session_start();

    if(isset($_SESSION['login'])){

        $id =$_POST['id'];
        require_once "../../db/animaldb.php";

        if(deleteAnimal($id)) {

        }else{
            echo "<p class ='alert alert-info'> Erro! </p>";
        }   
    
    }else {
        echo "<p class='alert alert-info'> Indisponível </p>";
    }

?>