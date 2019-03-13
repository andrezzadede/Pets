<?php

  require "../db/ownerdb.php";

  session_start();
  if(isset($_SESSION['login'])){
    $id = $_SESSION['login'];
    if(deletarConta($id['id_dono'])){
      header('location: ../login/logout.php');
    }
  }

?>