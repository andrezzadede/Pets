<?php

    require_once "Conexao.php";

    // função para deletar o dono

    function deletarConta($id){

        $db = conectar();

        if($db !=null){

            $sql = "DELETE FROM dono WHERE id_dono = ? ";

            $rs = $db->prepare($sql);
            $rs->bindValue(1, $id);
            $success = $rs->execute();

            if($success){
                return true;
            }

        }
    }

    function getDono($id){ // Nessa função ele está procurando o usúario da conta para poder atualizar seus dados
        
        $db = conectar(); // Nesta parte ele se conecta com o banco 

        if($db !=null){  // Aqui ele verifica se ocorreu a conexão
            
            $sql= "Select id_dono, nome, email, senha, celular as cel, cidade_id 
                    from dono where id_dono = ?"; // Aqui ele procura no banco o dono 

            $rs = $db->prepare($sql); // Ele prepara a query (comando de sql) para ser executada
            $rs->bindValue(1, $id);   // Nesta parte ele envia o id para query 
            $rs->execute();           // Aqui ele executa a query 

            if($rs->rowCount()>0){ // Aqui ele verifica se o rs tem alguma coisa, se ele recebeu o id
                $user = $rs->fetch(PDO::FETCH_ASSOC); // Ele passa para o user a linha encontrada
            }

            return $user; // Retorna nulo se não encontrar usuarios
        }
    }   
        
?>