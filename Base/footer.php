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
    <div class="footer-copyright white-text" ><a href="http://nobadserver.com" class="white-text">
            © 2019 Developed by - Daniel Castro - Konrado Souza - Lucas Lima</a>
        <div class="right white-text" style="margin-right: 5px;"><a href="<?php echo $pontos?>Tela/Sistema/contato.php" class="white-text">Contato</a></div>
        </div>
    
</footer>
