<?php
if (realpath("./index.php")) {
    $pontos = "";
} else {
    $pontos = ".";
}
?>

<nav class="nav-extended corpadrao">
    <div class="nav-wrapper">
        <a href="<?php echo $pontos; ?>./Tela/home.php" class="brand-logo">Sistema para Associação</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <!-- Dropdown Trigger -->
            <li><a class='dropdown-button' data-activates='dropdown1'><?php echo $_SESSION['nome']; ?></a></li>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a><b>Seu Perfil</b></a></li>
                <li><a href="../Tela/alterarDadosUsuario.php">Alterar Dados</a></li>
                <li><a href="../Tela/alterarEnderecoUsuario.php">Alterar Endereço</a></li>
            </ul>

            <li><a class='dropdown-button' data-activates='dropdown2'>Cadastrar informações</a></li>
            <ul id='dropdown2' class='dropdown-content'>
                <li><a><b>Cadastrar informações</b></a></li>
                <li><a href="../Tela/cadastroAluno.php">Aluno</a></li>
                <li><a href="../Tela/cadastroResponsavel.php">Responsavel</a></li>
                <li><a href="#">Membro da diretoria</a></li>
                <li><a href="#">Administrador</a></li>
            </ul>
            <li><a class='dropdown-button' data-activates='dropdown3'>Alterar dados</a></li>
            <ul id='dropdown3' class='dropdown-content'>
                <li><a><b>Alterar dados</b></a></li>
                <li><a href="#">Aluno</a></li>
                <li><a href="#">Responsavel</a></li>
                <li><a href="#">Diretoria</a></li>
                <li><a href="#">Administrador</a></li>
            </ul>
            <li><a href="<?php echo $pontos; ?>./Controle/usuarioPDO.php?function=logout">Sair</a></li>
        </ul>
    </div>
</nav>

<script>
    $('.dropdown-button').dropdown({
        hover: true
    });
</script>
