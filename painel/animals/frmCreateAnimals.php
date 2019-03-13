<!-- PHP responsável por iniciar a sessão e requerer os portes, tipos e raças no banco-->
<?php

    session_start();
    if(!isset($_SESSION['login']) ) {
        header("location: ../../index.html");
    } else {
        require "../../db/tipos.php";
        require "../../db/racas.php";
        require "../../db/portes.php";

        // Retorna uma lista de tipos, raças e portes
        $tipos = getTipos(); 
        $racas = getRacas();
        $portes = getPortes(); 
    }  
?>
<!-- Fim do PHP-->

<!-- Começo do HTML-->
<!DOCTYPE html>
<html lang="pt-br">

    <!-- Começo do HEAD-->
    <head>

        <link rel="icon" type="image/png" href="../img/icon.png"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>Pandora Trackers</title>

        <!-- CSS responsável por deixar a página com uma aparencia melhor-->
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/fa-svg-with-js.css" />
        <link rel="stylesheet" type="text/css" href="../../bootstrap/css/style.css" />
        
    </head>
    <!-- Fim do HEAD-->

    <!-- Começo do BODY -->
    <body>
        <!-- Começo da DIV PRINCIPAL -->
        <div class="container">

            <!-- Começo da 1° DIV do MENU PRINCIPAL-->
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #dc3545;">Pandora Trackers</h5>
                    <nav class="my-2 my-md-0 mr-md-3">
                        <a class="p-2 text-white" href="#">Tracker</a>
                        <a class="p-2 text-white" href="../../login/logout.php">Sair</a>
                    </nav>
            </div>
            <!-- Fim da 1° DIV do MENU PRINCIPAL -->

            <!-- Começo da DIV do 2° MENU PRINCIPAL -->
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">
                    <i class="fas fa-chess-queen"></i>
                </h5>
                
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="../control.php"> Voltar </a>
                </nav>
            </div>
            <!-- Fim da DIV do 2° MENU PRINCIPAL -->

            <!-- Começo do FORM -->    
            <form class="row" method="POST" action="CreateAnimal.php">

                <!-- Começo da DIV responsável pela 1° tabela-->
                <div class="col-sm-6">
                        
                    <!-- Começo da DIV responsável pelo input de campo NOME-->
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"  placeholder="Informe o nome" required>
                    </div>
                    <!-- Fim da DIV responsável pelo campo NOME -->

                    <!-- Começo da DIV responsável pelo select campo SEXO -->
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                            <select class="form-control" name="sexo">
                                <option value="F" selected>Fêmea</option>
                                <option value="M">Macho</option>
                            </select>
                    </div>
                    <!-- Fim da DIV responsável pelo campo SEXO -->

                    <!-- Começo da DIV responsável pelo input campo NASCIMENTO-->
                    <div class="form-group">
                        <label for="nascimento">Data de nascimento</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento">
                    </div>
                    <!-- Fim da DIV responsável pelo campo NASCIMENTO -->
                    
                    <!-- Começo da DIV responsável pelo campo COR -->
                    <div class="form-group">
                        <label for="cor">Cor</label>
                        <input type="text" class="form-control" id="cor" name="cor"  placeholder="Informe a coloração do seu animal">
                    </div>
                    <!-- Fim da DIV responsável pelo campo COR -->
        
                    

                </div>
                <!-- Fim da DIV responsável pela 1° tabela -->

                <!-- Começo da DIV responsável pela 2° tabela -->
                <div class="col-sm-6">

                    <!-- Começo da DIV responsável pelo campo TIPO -->
                    <div class="form-group">
                        <label>Tipo</label>
                            <select class="form-control" name="tipo">
                                <?php
                                    $i = 0;
                                    while ($i < count($tipos)){
                                        $tipo = $tipos[$i];
                                        $idTipo = $tipo['id_tipo'];
                                        echo "<option value='$idTipo'>";
                                        echo $tipo['descricao'];
                                        echo "</option>";
                                        $i++;
                                    }
                                ?>
                            </select> 
                    </div> 
                    <!-- Fim da DIV responsável pelo campo TIPO -->

                    <!-- Começo da DIV responsável pelo campo RAÇAS -->
                    <div class="form-group">
                        <label>Raças</label>
                            <select class="form-control" name="raca">
                                <?php
                                    $i = 0;
                                    while($i < count($racas)) {
                                        $raca = $racas[$i];
                                        $idRaca = $raca['id_raca'];
                                        echo "<option value='$idRaca'>";
                                        echo $raca['descricao'];
                                        echo "</option>";
                                        $i++;
                                    }
                                ?>
                            </select>
                    </div> 
                    <!-- Fim da DIV responsável pelo campo RAÇAS -->

                    <!-- Começo da DIV responsável pelo campo TIPO -->               
                    <div class="form-group">
                        <label>Tipo</label>
                            <select class="form-control" name="porte">
                                <?php
                                    $i = 0;
                                    while($i < count($portes)) {
                                        $porte = $portes[$i];
                                        $idPorte = $porte['id_porte'];
                                        echo "<option value='$idPorte'>";
                                        echo $porte['descricao'];
                                        echo "</option>";
                                        $i++;
                                    }
                                ?>
                            </select>
                    </div>
                    <!-- Fim da DIV responsável pelo campo TIPO -->   

                    <button class="btn btn-outline-danger float-right" type="submit">Cadastrar</button>

                </div> 
                <!-- Fim da DIV responsável pela 2° tabela -->
                

            </form>
            <!-- Fim do FORM -->

        </div> 
        <!-- Fim da DIV PRINCIPAL -->

        <script src="../../bootstrap/js/jquery.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../bootstrap/js/fontawesome-all.min.js"></script>

    </body>
    <!-- Fim do BODY -->

</html>
<!-- Fim do HTML -->