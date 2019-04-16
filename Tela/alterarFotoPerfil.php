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
        <title>Alterar Dados</title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        include_once '../Modelo/aluno.php';
        $logado = new aluno();
        $logado = unserialize($_SESSION['aluno']);
        $user = new usuario();
        $user = unserialize($_SESSION['usuario']);
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
                                    <form action="../Controle/proc_cad_img.php" method="post" enctype="multipart/form-data">
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
                                            <button type="submit" class="btn corpadrao col s4 offset-s4" name="SendCadImg">Confirmar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            $(document).ready(function () {
                $("#esconde").click(function () {
                    $("#mostra").removeAttr('hidden');
                    $("#esconde").attr('hidden', 'true');
                });
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
            });

        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
