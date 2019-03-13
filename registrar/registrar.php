<?php

    $nome = addslashes(trim($_POST['nome'])); // Para proteção do site, tirar caracteres especiais do PHP.
    $email = addslashes(trim($_POST['email']));
    $senha = addslashes(trim($_POST['senha']));


    // Função responsável por verificar se os campos não estão vazios 
    if(!empty($nome) && !empty($senha) && !empty($senha)) {
        
        require "../db/Conexao.php";
        
        $msg =(emailDuplicado($email) == true)? "Sinto muito, mas esse e-mail já existe em nossa base de dado": "";

        $db = conectar();
        session_start();
        if($db != null && $msg== ""){
            $senhaMD5 = md5($senha);
            $sql = "INSERT INTO animaldb.dono(nome, email, senha) VALUES (?, ?,?)";
            $rs = $db->prepare($sql);
            $rs->bindValue(1, $nome);
            $rs->bindValue(2, $email);
            $rs->bindValue(3, $senhaMD5);
            $rs->execute();

            if($rs){
                $msg = "Cadastrado com sucesso, faça seu login!";
                
                $_SESSION['message'] = $msg;
                header("location:../message.php");
            
            }else {
                echo "Erro! <br>";
            } 

        }else{
            if($msg != ""){
                $_SESSION['message'] = $msg;
                header("location:../message.php");
            }
        }
      
    } else {

         echo "Variaveis vazias...";

    }

    function emailDuplicado($email){

        $db = conectar();

        if($db != null){

            $sql = "SELECT email from animaldb.dono WHERE email = ?";
            $rs = $db->prepare($sql);
            $rs->bindValue(1, $email);
            $rs->execute();

            if($rs->rowCount() > 0){
                return true;
            }

        }

        return false;
    }


?>