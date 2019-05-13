<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php
        include_once '../../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <nav class="nav-extended ">
            <div class="nav-wrapper corpadrao">
                <a class="brand-logo center">Oops!</a>
            </div>
        </nav>
        <main>
            <div class="row">
                <div style="height: 10vh;"></div>
                <div class="col s6 offset-s3 card center" style="padding-top: 10px;">
                    <div class="row">
                        <div class="col s9">
                            <h5>Você não tem permissão de acessar este local!</h5>
                            <p>Se acredita que esta vendo esta mensagem por engano, por comunique a equipe de desenvolvimento!</p>

                        </div>
                        <img src="../../Img/Src/sintoMuito.jpg" class="col s3 circle">
                    </div>
                    <div class="row">
                        <a class="btn corpadrao hoverable" href="./contato.php?msg=acessoNegado">Contato</a>
                    </div>

                </div>
            </div>
        </main>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>
