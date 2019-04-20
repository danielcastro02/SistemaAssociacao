<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
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
        include_once '../Base/nav.php';
        include_once '../Modelo/usuario.php';
        $logado = new usuario();
        $logado = unserialize($_SESSION['usuario']);
        ?>


        <div class="row">
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>
                    <div class="card col s10 offset-s1 center">
                        <div class="col s12">
                            <div class="row">
                                <br>
                                <div class="row"></div>
                                <h5>Nome: <?php echo $logado->getNome(); ?></h5>
                                <span>RG: <?php echo $logado->getRg(); ?></span><br>
                                <span>CPF: <?php echo $logado->getCpf(); ?></span><br>
                                <span>CEP: <?php echo $logado->getCep(); ?></span><br>
                                <span>Cidade: <?php echo $logado->getCidade(); ?></span><br>
                                <span>Bairro: <?php echo $logado->getBairro(); ?></span><br>
                                <span>Rua: <?php echo $logado->getRua(); ?></span><br>
                                <span>Número: <?php echo $logado->getNumero(); ?></span><br>
                            </div>
                            <div class="row">
                                <a href="./listarUsuario.php" class="btn hoverable corpadrao">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
