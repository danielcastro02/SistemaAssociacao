<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['id'])){
    header("location: ../Tela/login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Dados</title>
        <?php
        include_once '../Base/header.php';
        ?>

    </head>
    
    <body class="homeimg">
        
        <?php
        include_once '../Base/navPadrao.php';
        ?>
        
        <?php 
            if($_SESSION['administrador']){
               ?>
        <a href="./cadastroUsuario.php" class="btn corpadrao hoverable">Cadastrar Usuario</a>
                   <?php 
               
            }
        ?>
        
        <?php include_once '../Base/footer.php'; ?>
        
    </body>

