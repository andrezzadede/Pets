<?php
    session_start();
    if(!isset($_SESSION['login']) ) {
        header("location: ../../index.html");
    }else {

        $id = addslashes(trim($_GET['id']));

        require_once '../../db/animaldb.php';

        $animal = find($id);

        require_once "../../db/tipos.php";
        require_once "../../db/racas.php";
        require_once "../../db/portes.php";

        $tipos = getTipos();
        $racas = getRacas();
        $portes = getPortes();
    }
       
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <link rel="icon" type="image/png" href="../img/icon.png"/>
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
                    <a class="p-2 text-dark" href="myAnimals.php"> Voltar </a>
                </nav>

                    
            </div>
            <!-- Fim do Menu Secundario -->
            
            <form class="row" method="POST" action="update.php">
                <div class="col-sm-6">
                    <input type="hidden"  id="id" name="id"  value="<?php echo $animal['animal'];?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"  value="<?php echo $animal['nome'];?>">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" name="sexo">
                            <?php

                                if($animal['sexo']=='F'){
                                    echo ' <option value="F" selected>Fêmea</option>';
                                    echo '<option value="F" >Fêmea</option>';
                                } else {
                                    echo '<option value="M" selected>Macho</option>';
                                    echo ' <option value="M">Macho</option>';
                                }
                            ?>
                        
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nascimento">Data de nascimento</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento" value="<?php echo $animal['nascimento'];?>">
                    </div>

                    <div class="form-group">
                        <label for="cor">Cor</label>
                        <input type="text" class="form-control" id="cor" name="cor"  value="<?php echo $animal['cor'] ?>">
                    </div>
            
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo">
                            <?php
                                $i = 0;
                                while ($i < count($tipos)){
                                    $tipo = $tipos[$i];
                                    $idTipo = $tipo['id_tipo'];
                                    $desc = $tipo['descricao'];

                                    if($animal['tipo']==$desc){
                                        echo "<option value='$idTipo' selected>";
                                        echo $desc;
                                        echo "</option>";
                                    }else{
                                        echo "<option value='$idTipo'>";
                                        echo $desc ;
                                        echo "</option>";
                                    }                                 
                                    $i++;
                                }
                            ?>
                        </select> <!-- fim do group tipo-->
                    </div> 

                    <div class="form-group">
                        <label>Raças</label>
                        <select class="form-control" name="raca">
                            <?php
                                $i = 0;
                                while($i < count($racas)) {
                                    $raca = $racas[$i];
                                    $idRaca = $raca['id_raca'];
                                    $desc = $raca['descricao'];

                                    if($animal['raca'] ==$desc){

                                        echo "<option value='$idRaca' selected>";
                                        echo $desc;
                                        echo "</option>";
                                    }else{
                                        echo "<option value='$idRaca'>";
                                        echo $desc;
                                        echo "</option>";
                                    }
                                    
                                    $i++;
                                }
                            ?>
                        </select>
                    </div> <!-- fim do form raças-->

                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="porte">
                            <?php
                                $i = 0;
                                while($i < count($portes)) {
                                    $porte = $portes[$i];
                                    $idPorte = $porte['id_porte'];
                                    $desc = $porte['descricao'];

                                    if($animal['porte']==$desc){
                                        echo "<option value='$idPorte' selected>";
                                        echo $desc;
                                        echo "</option>";
                                    }
                                        echo "<option value='$idPorte'>";
                                        echo $desc;
                                        echo "</option>";
                                        $i++;
                                }
                            ?>
                        </select>
                    </div>  <!-- fim do form tipos-->

                    <button class="btn  btn-outline-danger float-right" type="submit">
                        Atualizar <i class="far fa-save"></i>
                    </button>
            

                </div> <!-- fim do sm-6-->
                
            </form>

        </div> 
        <script src="../../bootstrap/js/jquery.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../bootstrap/js/fontawesome-all.min.js"></script>
    </body>
</html>
