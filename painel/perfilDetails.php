<?php
    session_start();
    if(!isset($_SESSION['login']) ) {
        header("location: ../../index.html");
    }else {
        $dono = $_SESSION['login'];

        require "../db/estados.php";    
        
        $meuEstado=null;

        if($dono['cidade_id'] != null) {
            $meuEstado = find($dono['cidade_id']);
        }     
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

        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/fa-svg-with-js.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css" />

        <style>
            .table .td-1 {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #dc3545;">Pandora Trackers</h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-white" href="#">Tracker</a>
                    <a class="p-2 text-white" href="../login/logout.php">Sair</a>
                </nav>             
            </div>
            <!-- Fim do Menu principal -->

            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">
                <i class="fas fa-chess-queen"></i>
                </h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="control.php"> Voltar </a>
                </nav>             
            </div>
            <!-- Fim do Menu Secundario -->

            <div class="row">
                <div class="col-sm-6">
                    <h2><?php echo $dono['nome']?></h2>
                    <table class="table table-striped">     
                        <tr>
                            <td class="td-1">E-mail</td>
                            <td> 
                                <?php 
                                    $email = ($dono['email']);
                                    echo $email;
                                ?>
                            </td>
                        </tr>     
                        
                        <tr>
                            <td class="td-1">Celular</td>
                            <td> 
                                <?php 
                                    $cel = ($dono['cel']);
                                    if( $cel == null ){
                                        echo "Não informado";
                                    }else {
                                        echo $cel;
                                    }
                                ?>
                            </td>
                        </tr>
                    
                        <tr>
                            <td class="td-1">Cidade</td>
                            <td> 
                                <?php 
                                    if($meuEstado!=null){
                                        echo $meuEstado['cidade'];
                                    }else {
                                        echo "Cidade não informada";
                                    }
                                ?>
                            </td>
                        </tr>     

                        <tr>
                            <td class="td-1">Estado</td>
                            <td> 
                                <?php 
                                    if($meuEstado!=null){
                                        echo $meuEstado['estado'];
                                    }else {
                                        echo "Estado não informada";
                                    }   
                                ?>
                            </td>
                        </tr>     
                    </table>

                    <a href="frmPerfil.php" class="btn btn-outline-danger">Atualizar</a>
                            
                </div> <!--Fim tabela detalhes -->
                
                <div class="col-sm-6">       
                    <!-- <img src="../img/user/ian.jpg" alt="foto do perfil" id="avatar"> -->
                </div>  
            </div> 

            <p class="mt-5 mb-3 text-muted" style="text-align: center; padding-top:80px 0px; ">Todos os direitos reservados &copy; 2018</p>

        </div> 

        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/fontawesome-all.min.js"></script>
        
    </body>
</html>
