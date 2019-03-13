<?php

session_start();
if(!isset($_SESSION['login'])){
    
    header("location: ../../index.html");

   

} else {

    $dono = $_SESSION['login'];

    $id = $_POST['id_estado'];

    require_once '../../db/Conexao.php';

    $db = conectar();

    if($db != null) {

        $sql = "SELECT * FROM cidade WHERE cidade.estado_id = ?";

        $rs = $db->prepare($sql);
        $rs->bindValue(1, $id);
        $rs->execute();
    
        if($rs->rowCount() > 0) {

            echo "<label for='cidade'>Cidade</label>";
            echo "<select name='cidade' class='form-control' required>";
            while($row = $rs->fetch(PDO::FETCH_ASSOC)) {

                $id_cidade = $row['id_cidade'];

                if ($id_cidade == $dono['cidade_id']) {

                    echo "<option value='$id_cidade' selected>";
                    echo $row['nome'];
                    echo "</option>";

                } else {
                    echo "<option value='$id_cidade' >";
                    echo $row['nome'];
                    echo "</option>";
                }



            }
            echo "</select>";

        } else {

            echo "<span> nenhuma cidade encontrada. </span>";

        }

    } else {
        echo "<span> banco desconectado... </span>";
    }
 

}

?>

