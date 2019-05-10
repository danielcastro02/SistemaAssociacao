<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
?>

<footer class="center corpadrao">
        <div class="row footer-copyright white-text"><a href="http://nobadserver.com" class="center col l10 s12 offset-l1 white-text">
                © 2019 Developed by - Daniel Castro - Daniel Anesi - Lucas Lima - Victor Xavier</a>
        <a class="col s2 l1 offset-s5 grey-text text-lighten-4" href="<?php echo $pontos ?>Tela/Sistema/contato.php">Contato</a>
    </div>
</footer>

<!--
<footer class="corpadrao center">
    <div class="footer-copyright white-text" ><a href="http://nobadserver.com" class="white-text">
            © 2019 Developed by - Daniel Castro - Konrado Souza - Lucas Lima</a>
        <div class="right white-text" style="margin-right: 5px;"><a href="<?php echo $pontos ?>Tela/Sistema/contato.php" class="white-text">Contato</a></div>
    </div>
</footer>-->
