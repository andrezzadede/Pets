<?php

    session_start();

    if(isset($_SESSION['login'])){
        session_destroy();
        header('location: ../index.html');

    }else{

        header('location: logout-error.php');
    }
    
?>