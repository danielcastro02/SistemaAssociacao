<?php
if (realpath("./index.php")) {
    $pontos = "";
} else {
    $pontos = ".";
}
?>

<nav class="nav-extended corpadrao">
    <div class="nav-wrapper">
        <a href="<?php echo $pontos; ?>./index.php" class="brand-logo">Associação de Cacequi</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php
            if (isset($_SESSION['usuario'])) { ?>
                <li><a href="<?php echo $pontos; ?>./Tela/home.php">Voltar ao Sistema</a></li>
                <?php
            } else {
                ?>
                <li><a href="<?php echo $pontos; ?>./Tela/login.php">Entrar</a></li>
                <li><a href="<?php echo $pontos; ?>./Tela/contrato.php">Associar-se</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>


