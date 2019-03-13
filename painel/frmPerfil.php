<?php
    session_start();
    if(!isset($_SESSION['login'])){
       
        header("location:../index.html");

    } else {

        require "../db/estados.php";

        $dono = $_SESSION['login'];
        

        $cidades = getListCity();
        
        $estados = getStates();

        if($dono['cidade_id'] != null) {
            $meuEstado = find($dono['cidade_id']);
        }   
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <link rel="icon" type="image/png" href="../img/crown.png"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pandora Trackers</title>

        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/fa-svg-with-js.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css" />
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
                <h5 class="my-0 mr-md-auto font-weight-normal" style="color: #000;">Perfil do usuário</h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="perfilDetails.php"> Voltar</a>
                </nav>
            </div>
            <!-- Fim do Menu Secundario -->
            
            <div class="row">
                <div class="col-sm-12">
                    <form method="POST" action="updatePerfil.php">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome"  placeholder="Modificar nome" value="<?php echo $dono['nome'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" min="12" max="16" id="celular" name="celular"  placeholder="Informe o celular" 
                            value="<?php echo $dono['cel'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="estado">Selecione o estado</label>
                            <select name="estado" id="estados" class="form-control" required>
                                <?php
                
                                    $i = 0;
                                    while($i < count($estados)) {

                                        $e = $estados[$i];
                                        $id_estado = $e['id_estado'];

                                        if($meuEstado['id_estado'] == $id_estado) {

                                            echo "<option value='$id_estado' selected>";
                                            echo $e['descricao'];
                                            echo "</option>";

                                        } else {

                                            echo "<option value='$id_estado'>";
                                            echo $e['descricao'];
                                            echo "</option>";

                                        }
                                        $i++;
                                    }

                                ?>
                            </select> 
                        </div>

                        <div class="form-group" id="dados-cidades">
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova senha">
                        </div>
                
                        <button type="submit" class="btn btn-outline-danger">Atualizar</button>
                        <button type="button" id="btn-del-conta" class="btn btn-outline-dark">Excluir conta</button>
                        <p class="mt-5 mb-3 text-muted" style="text-align: center;">Todos os direitos reservados &copy; 2017-2018</p>
                    </form>
                </div>
            </div>
        </div> 
        
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/fontawesome-all.min.js"></script>
        <script src="ajax/script.js"></script>

        <script>
            
            var btn_del = document.querySelector('#btn-del-conta');

            btn_del.onclick = function () {

                var ok = confirm('Deseja realmente excluir sua conta permanentemente???');

                if(ok) {
                    window.location.href = 'deleteAccount.php';
                }
            }

        </script>
    </body>
</html>
