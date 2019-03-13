<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("location:../../index.html");
    }else {
        require "../../db/animaldb.php";
        $dono = $_SESSION ['login'];
        // echo $dono['id_dono'];
        $myAnimals = getMyAnimals($dono['id_dono']); 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="icon" type="image/png" href="../../img/crown.png"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Pandora Trackers</title>

        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/fa-svg-with-js.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/style.css" />
    </head>

    <body>
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #dc3545;">Pandora Trackers</h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-white" href="#">Tracker</a>
                    <a class="p-2 text-white" href="../../login/logout.php">Sair</a>
                </nav>
            </div>
            <!-- Fim do Menu principal -->

            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">
                    <i class="fas fa-chess-queen"></i>
                </h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="frmCreateAnimals.php">Cadastrar Animal</a>
                    <a class="p-2 text-dark" href="../control.php">Voltar </a>
                    </a>
                </nav>
  
            </div>
            <!-- Fim do Menu Secundario -->
            
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        <?php  
                            if(isset($_SESSION['login'])) {

                                $login = $_SESSION['login'];
                                //echo "Bem vindo, ". $login['nome'] ."!";

                            }else {
                                echo "ERRO!";
                            }
                        ?>
                    </p>
                </div>

            </div> <!-- fim row login -->
                        
            <div class="row">
                <div class="col-sm-6" id="mensagem" >
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">           
                    <?php
                        if($myAnimals != 0){
                            echo "<table class='table table-borderedd table-sm'>";
                                $i=0;
                                echo "<thead class='bg-dark'>";
                                    echo "<th class='text-danger' >Meus animais</th>";
                                    echo "<th></th>";
                                    echo "<th></th>";
                                    echo "<th></th>"; 
                                echo "</thead>";                       
                                    
                                while($i < count($myAnimals)){
                                    $animal = $myAnimals[$i];
                                    $id = $animal["animal"];
                                    echo "<tr>";
                                        echo "<td>" . $animal['nome'] . "</td>";
                                        echo "<td><a href='animalDetails.php?id=$id' class='text-dark'><i class='fas fa-glasses'></i></a></td>";
                                        echo "<td><a href='frmEditAnimal.php?id=$id' class='text-dark'><i class='fas fa-edit'></i></a></td>";
                                        echo "<td><a style='cursor: pointer;' onclick='remover($id)' class='text-danger'><i class='fas fa-heartbeat'></i></a></td>";
                                    echo "</tr>";                               
                                    $i++;
                                }

                            echo "</table>";
                        }else{        
                            echo "<p class='alert alert-danger'> <a href='#' 
                                    class='btn btn-link text-danger'> Cadastre 
                                    seu primeiro animal de estimação! </a>";
                        }

                    ?>
                </div>
            </div>
        
        </div> 
            
        <script src="../../bootstrap/js/jquery.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../bootstrap/js/fontawesome-all.min.js"></script>
        <script>

            function remover (id) {
                var ok = confirm("Clique em OK se deseja mesmo remover seu animal");
                console.log(ok);
                
                if(ok) {   
                    var page = "delete.php";
                    $.ajax
                    ({
                            type: 'POST',
                            dataType: 'html',
                            url: page, 
                            beforeSend: function (){
                                $("#mensagem").html("Carregando...");
                            },
                            data: { id: id},
                            success: function(msg){
                                //$("#mensagem").html(msg);
                                parent.window.document.location.href = 'http://localhost/myApp/painel/animals/myAnimals.php';
                            }
                    });
                }
            }       
        </script>
    </body>
</html>
