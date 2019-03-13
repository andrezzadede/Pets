<?php
    session_start();
    if(!isset($_SESSION['login']) ) {
        header("location: ../../index.html");
    }else {
        $animal= (object) $_POST;
        require_once '../../db/animaldb.php';
        if(update($animal)){
             header("location:myAnimals.php");
        }
    }
?>