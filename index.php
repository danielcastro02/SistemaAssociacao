<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?php include_once './Base/header.php'; ?>
    </head>
    <body>
      <nav class="nav-extended teal darken-1">
            <div class="nav-wrapper">
                <a href="home.php" class="brand-logo">Sistema para Associação</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="./index.php">Página de apresentação</a></li>
                    <li><a href="./Tela/login.php">Login</a></li>
                </ul>
            </div>
        </nav>
      <script type="text/javascript" src="js/materialize.js"></script>
      <h3>Você está na tela inicial da dashboard... estoy logado como admin</h3>
      <br>
      <a class="btn" href="./Tela/cadastroUsuario.php">Sou um administrador e vou registrar um aluno</a>
    </body>
  </html>
  
