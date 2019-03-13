<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <link rel="icon" type="image/png" href="img/crown.png">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      
      <title>Pandora Trackers</title>

      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="bootstrap/css/fa-svg-with-js.css" />
      <link rel="stylesheet" type="text/css" href="bootstrap/css/cover.css" />
  </head>
  
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand" style="color: #dc3545;">Pandora Trackers</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="register.html">Cadastro</a>
            <a class="nav-link" href="#">Tracker</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <p class="lead">
          <?php
            session_start();
            if(isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              session_destroy();
            }else {
              echo "Verifique se os dados estão corretos...";
            }

          ?>
        </p>
  
        <p class="lead">
          <a class="btn btn-outline-danger" href="index.html"><i class="fas fa-home"></i></a>
        </p>
  
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Todos os direitos reservados &copy; 2017-2018</p>
        </div>
      </footer>
    
    </div>
 
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/fontawesome-all.min.js"></script>
  
  </body>
</html>
