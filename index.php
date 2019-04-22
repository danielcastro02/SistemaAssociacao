<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once './Base/header.php'; ?>
    </head>
    <body>
        <?php
        if (isset($_SESSION['administrador'])) {
            if ($_SESSION['administrador'] == 'true') {
                include_once './Base/navAdministrativa.php"';
            } else {
                if ($_SESSION['administrador'] == 'false') {
                    include_once './Base/navPadrao.php';
                }
            }
        } else {
            include_once './Base/navBar.php';
        }
        ?>
        <div class="section white">
            <div class="row">
                <h1>Associação de transportes de Cacequi</h1>
            </div>
        </div>

        <div class="parallax-container" style="height: 200px;">
            <div class="parallax"><img src="Img/estrada.jpg"></div>
        </div>

        <div class="section white">
            <div class="row">
                <h2>Missão</h2>
                <p>Promover a educação profissional, científica e tecnológica por meio do ensino, pesquisa e extensão, com foco na formação de cidadãos críticos, autônomos e empreendedores, comprometidos com o desenvolvimento sustentável.</p>
            </div>
        </div>

        <div class="parallax-container" style="height: 200px;">
            <div class="parallax"><img src="Img/estrada.jpg"></div>
        </div>

        <div class="section white">
            <div class="row">
                <h2>Valores</h2>
                <ul>
                    <li>Ética</li>
                    <li>Solidariedade: humanização, inclusão, igualdade na diversidade, cooperação.</li>
                    <li>Sustentabilidade: responsabilidade social e ambiental.</li>
                    <li>Desenvolvimento humano: criticidade, autonomia e empreendedorismo.</li>
                    <li>Democracia: igualdade na diversidade, liberdade, justiça.</li>
                    <li>Qualidade.</li>
                    <li>Inovação: criatividade.</li>
                </ul>
            </div>
        </div>

        <div class="parallax-container" style="height: 200px;">
            <div class="parallax"><img src="Img/estrada.jpg"></div>
        </div>

        <div class="section white">
            <div class="row">
                <h2>Visão</h2>
                <p>Ser referência em educação profissional, científica e tecnológica como instituição promotora do desenvolvimento regional sustentável.</p>
            </div>
        </div>

        <div class="parallax-container" style="height: 200px;">
            <div class="parallax"><img src="Img/estrada.jpg"></div>
        </div>

        <script>
            $(document).ready(function () {
                $('.parallax').parallax();
            });
        </script>

        <?php include_once './Base/footer.php'; ?>

    </body>

</html>
