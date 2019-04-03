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
        if ($_SESSION['administrador'] == 'true') {
            include_once '../Base/navAdministrativa.php';
        } else {
            include_once '../Base/navPadrao.php';
        }
        ?>


        <div class="row">
            <div class="col s6">
                <div class="row">
                    <div class="card col s10 offset-s1">
                        <div class="row">
                            aaa
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="card col s10 offset-s1">
                        <div class="row">
                            <div class="row"></div>
                            <img src="../Img/user_icon.png" height="100px" width="100px">
                            <form action="./uploadImagens.php">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Foto de Perfil</span>
                                        <input type="file" name="pic">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </form>
                            <div class="row"></div>
                            <h5><?php echo $_SESSION['nome']; ?></h5>
                            <span>RG: <?php echo $_SESSION['rg']; ?></span><br>
                            <span>CPF: <?php echo $_SESSION['cpf']; ?></span><br>
                            <span>CEP: <?php echo $_SESSION['cep']; ?></span><br>
                            <span>Cidade: <?php echo $_SESSION['cidade']; ?></span><br>
                            <span>Bairro: <?php echo $_SESSION['bairro']; ?></span><br>
                            <span>Rua: <?php echo $_SESSION['rua']; ?></span><br>
                            <span>Número: <?php echo $_SESSION['numero']; ?></span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
