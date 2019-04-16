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
            <!--            <div class="col s6">
                            <div class="row">
                                <div class="card col s10 offset-s1">
                                    <div class="row">
                                        aaa
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>

                    <div class="card col s10 offset-s1 center">
                        <div class="col s6">
                            <div class="row">
                                <br>
                                <br>
                                <a href="./alterarFotoPerfil.php">
                                    <div style='background: url("<?php echo $_SESSION['fotoPerfil']; ?>");
                                            background-size: 100px,100px;
                                            height: 100px;
                                            width: 100px;
                                            border-radius: 50%;
                                            margin-left: auto;
                                            margin-right: auto;
                                            margin-top: 0px;'>
                                    <div class="linkfoto white-text">Alterar Foto</div>            
                                </div>
                                </a>
                                <div class="row"></div>
                                <h5><?php echo $logado->getNome(); ?></h5>
                                <span>RG: <?php echo $logado->getRg(); ?></span><br>
                                <span>CPF: <?php echo $logado->getCpf(); ?></span><br>
                                <span>CEP: <?php echo $logado->getCep(); ?></span><br>
                                <span>Cidade: <?php echo $logado->getCidade(); ?></span><br>
                                <span>Bairro: <?php echo $logado->getBairro(); ?></span><br>
                                <span>Rua: <?php echo $logado->getRua(); ?></span><br>
                                <span>Número: <?php echo $logado->getNumero(); ?></span><br>
                            </div>

                        </div>

                        <div class="col s6">
                            <br>
                            <br>
                            <h5>Ultimas movimentações</h5>
                            <br>
                            <div class="left-align offset-s3">
                                Escrever como indica o padrão<br>
                                Abril: -R$200,00 BTN (pagar)<br>
                                Março: R$200,00 pago<br>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
