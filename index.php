<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once './Base/header.php'; ?>
    </head>
    <body>
        <?php include_once './Base/navBar.php'; ?>

        <div class="section white">
            <div class="row">
                <div class="row card col s10 push-s1 grey lighten-4">
                    <h1>Associação de transportes de Cacequi</h1>
                </div>
            </div>
        </div>
        
        <div class="parallax-container">
            <div class="parallax"><img src="imagens/campus2.jpg"></div>
        </div>

        <div class="section white">
            <div class="row">
                <div class="row card col s10 push-s1 grey lighten-4">
                    <h2>Missão</h2>
                    <p>Promover a educação profissional, científica e tecnológica por meio do ensino, pesquisa e extensão, com foco na formação de cidadãos críticos, autônomos e empreendedores, comprometidos com o desenvolvimento sustentável.</p>
                </div>
            </div>
        </div>
        
        <div class="parallax-container">
            <div class="parallax"><img src="imagens/campus2.jpg"></div>
        </div>

        <div class="section white">
            <div class="row">
                <div class="row card col s10 push-s1 grey lighten-4">
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
        </div>

        <div class="parallax-container">
            <div class="parallax"><img src="imagens/campus2.jpg"></div>
        </div>
        
        <div class="section white">
            <div class="row">
                <div class="row card col s10 push-s1 grey lighten-4">
                    <h2>Visão</h2>
                    <p>Ser referência em educação profissional, científica e tecnológica como instituição promotora do desenvolvimento regional sustentável.</p>
                </div>
            </div>
        </div>

        <div class="parallax-container">
            <div class="parallax"><img src="imagens/campus2.jpg"></div>
        </div>

        <script>
            $(document).ready(function () {
                $('.parallax').parallax();
            });
        </script>

        <?php include_once './Base/footer.php'; ?>

    </body>
</html>

