<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Sistema/login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Dados</title>
        <?php
        include_once '../../Base/header.php';
        ?>
    </head>
    <body class="homeimg">
        <?php
        include_once '../../Base/nav.php';
        ?>
        <main id="main">
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>

                    <div class="card col s10 offset-s1 center">
                        <div class="row">
                            <div class="col s6 offset-s3 center">
                                <div class="row">
                                    <form action="../../Controle/usuarioPDO.php?function=alteraFoto" method="post" enctype="multipart/form-data">
                                        <h5>Selecione sua nova foto de perfil!</h5>
                                        <div class="file-field input-field">
                                            <button class="btn corpadrao">
                                                <div>Selecionar Foto</div>
                                            </button>
                                            <input type="file" name="imagem">
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn corpadrao col s4 offset-s4" name="SendCadImg" value="true">Confirmar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>
