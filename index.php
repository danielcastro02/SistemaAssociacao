<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?php include_once './Base/header.php'; ?>
    </head>
    <body>
      <script type="text/javascript" src="js/materialize.js"></script>
      <h3>Você está na tela inicial da dashboard... estoy logado como admin</h3>
      <br>
      <a class="btn" href="./Tela/cadastroUsuario.php">Sou um administrador e vou registrar um aluno</a>
    </body>
  </html>
  
  