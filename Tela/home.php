<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../Tela/login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <?php
        include_once '../Base/header.php';
        ?>

    </head>
    <body class="homeimg">

        <?php 
        if($_SESSION['administrador']== 'true'){
        include_once '../Base/navAdministrativa.php';
        }
        else{
        include_once '../Base/navPadrao.php';    
        }
?>


        <div class="row">
            <div class="col s12 m7">
                <div class="card">
                    <div class="card-image">
                        <img src="imagens/estrada.jpg">
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
