<?php
if (realpath("./index.php")) {
    $pontos = "";
} else {
    $pontos = ".";
}
?>

<nav class="nav-extended corpadrao">
    <div class="nav-wrapper">
        <a href="<?php echo $pontos; ?>./index.php" class="brand-logo">Sistema para Associação</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo $pontos; ?>./Tela/alterarDadosUsuario.php">Alterar Dados</a></li>
            <li><a href="<?php echo $pontos; ?>./Tela/alterarEnderecoUsuario.php">Alterar Endereço</a></li>
            <li><a href="<?php echo $pontos; ?>./Controle/usuarioPDO.php?function=logout">Sair</a></li>
        </ul>
    </div>
</nav>