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
        <main>
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>

                    <div class="card col s10 offset-s1 center ">
                        <div class="row">

                                <div class="row">
                                    <form class="col s8 offset-s1" action="../../Controle/usuarioControle.php?function=alteraFoto" method="post" enctype="multipart/form-data">
                                        <h5>Selecione sua nova foto de perfil!</h5>
                                        <div class="file-field input-field">
                                            <button class="btn corpadrao">
                                                <div>Selecionar Foto</div>
                                            </button>
                                            <input type="file" class="file-chos" name="imagem">
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn corpadrao col s4 offset-s4" name="SendCadImg" value="true">Confirmar</button>
                                        </div>
                                    </form>
                                    <div class="col s3" style="margin-top: 20px;">
                                        <img  class="fotoPerfil prev-img">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const $ = document.querySelector.bind(document);
            const previewImg = $('.prev-img');
            const fileChooser = $('.file-chos');

            fileChooser.onchange = e => {
                const fileToUpload = e.target.files.item(0);
                const reader = new FileReader();

                // evento disparado quando o reader terminar de ler 
                reader.onload = e => previewImg.src = e.target.result;

                // solicita ao reader que leia o arquivo 
                // transformando-o para DataURL. 
                // Isso disparará o evento reader.onload.
                reader.readAsDataURL(fileToUpload);
            };
        </script>
    </main>
    <?php include_once '../../Base/footer.php'; ?>
</body>
</html>
