<!DOCTYPE html>
<html>
    <head>
        <title>Login Recusado</title>
        <?php
        include_once '../Base/header.php';

        include_once '../Controle/usuarioPDO.php';
        $usuarioPDO = new usuarioPDO();
        $presidente = $usuarioPDO->selectPresidente();
        ?>
    </head>
    <body class="homeimg">

        <nav class="nav-extended ">
            <div class="nav-wrapper corpadrao">
                <a class="brand-logo center">Bem-vindo!</a>
            </div>
        </nav>

        <main id="main">
            <div class="row">
                <div style="height: 15vh;"></div>
                <div class="col s6 offset-s3 card center">
                    <div class="row">
                        <h5 class="red-text">Desculpe, você ainda não pode logar.</h5>
                    </div>
                    <div class="row">
                        <img class="col s2 push-s5" src="../Img/sintoMuito.png">
                    </div>
                    <h5>Entre em contato com o presidente da associação: <br><?php echo $presidente['nome']; ?></h5>
                    <span>Telefone: <?php echo $presidente['telefone']; ?></span><br>
                    <span>E-mail: <?php echo $presidente['email']; ?></span><br>
                    <span>Cidade: <?php echo $presidente['cidade']; ?></span><br>
                    <span>Rua: <?php echo $presidente['rua']; ?></span><br>
                    <span>Número: <?php echo $presidente['numero']; ?></span><br>
                    <div class="row">
                        <a href="./login.php" class="btn hoverable corpadrao">Voltar</a>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
