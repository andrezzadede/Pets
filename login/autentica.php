<?php

    $email = addslashes(trim($_POST['email']));
    $senha = addslashes(trim($_POST['senha']));

    if(!empty($email) && !empty($senha)){
       /*  echo "Seu email: ". $email ." <br>";
        echo "Sua senha: ". $senha ." <br>"; */
        
        require "../db/Conexao.php";

        $db = conectar();

        if($db != null){

            $senhaMD5 = md5($senha);
            $sql = "SELECT * FROM animaldb.dono WHERE email= ? AND senha = ?";
            $rs = $db->prepare($sql);
            $rs->bindValue(1, $email);
            $rs->bindValue(2, $senhaMD5);
            $rs->execute();
            session_start();
            if($rs->rowCount() > 0){
                $row = $rs->fetch(PDO::FETCH_ASSOC);

                $dono = array(
                    'id_dono'   => $row['id_dono'],
                    'nome'      => $row['nome'],
                    'email'     => $row['email'],
                    'senha'     => $row['senha'],
                    'cel'       => $row['celular'],
                    'cidade_id' => $row['cidade_id']                 
                );

                $_SESSION['login'] = $dono;
                header("location: ../painel/control.php");
            }else{
                $_SESSION['mensagem'] = "Verifique se seus dados estão corretos";
                header("location: ../message.php");
            }
        }
    }else {
        echo "variaveis vazias...";
    }
?>