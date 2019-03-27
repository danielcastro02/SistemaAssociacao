<?php
if (realpath("./index.php")) {
    $pontos = "";
} else {
    $pontos = ".";
}
?>

<nav class="nav-extended teal darken-1">
    <div class="nav-wrapper">
        <a href="home.php" class="brand-logo">Sistema para Associação</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo $pontos; ?>./Tela/alterarDadosUsuario.php">Alterar Dados</a></li>
            <li><a href="<?php echo $pontos; ?>./Tela/alterarEnderecoUsuario.php">Alterar Endereço</a></li>
        </ul>
    </div>
</nav>
