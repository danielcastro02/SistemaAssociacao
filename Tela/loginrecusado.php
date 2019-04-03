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

                <a class="brand-logo center">Oops!</a>
            </div>
        </nav>

        <main id="main">
            <div class="row">

                <div style="height: 3vh;"></div>
                <div class="col s8 offset-s2 card center">
                    <div class="row">
                        <div class="col s10 offset-s1">
                            <div class="row">
                                <h5 class="red-text">Desculpe, você ainda não pode logar...</h5>
                            </div>
                            <div class="row">
                                <span class="left-align col s12 ">Não se preocupe, basta entrar em contato com o presidente da associacao <?php echo $presidente['nome']; ?>
                                    para validar seus documentos...<br>Entre em contato pelo Telefone: <?php echo $presidente['telefone']; ?>, pelo E-mail: <?php echo $presidente['email']; ?>.<br>Ou diretamente no endereço:
                                    Rua, <?php echo $presidente['rua']; ?>, Bairo <?php echo $presidente['bairro']; ?>, Número  <?php echo $presidente['numero']; ?>, na cidade de <?php echo $presidente['cidade']; ?></span></div>
                            <div class="row left-align">
                                <h5 class="col s9">
                                    Isto é para a segurança de todos os nossos associados!</h5>
                                <img class="col s2" src="../Img/sintoMuito.png">
                            </div>

                            <div class="row">
                                <a href="./login.php" class="btn hoverable corpadrao">Voltar</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
