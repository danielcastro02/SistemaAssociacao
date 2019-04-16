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
            <li><a class='dropdown-trigger' data-target='dropdown1'>
                <?php 
                $usuario = new usuario();
                $usuario = unserialize($_SESSION['usuario']);
                echo $usuario->getNome();
                ?>
                </a></li>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a><b>Seu Perfil</b></a></li>
                <li><a href="../Tela/alterarDadosUsuario.php">Alterar Dados Pessoais</a></li>
                <li><a href="../Tela/alterarEnderecoUsuario.php">Alterar Endereço</a></li>
                <?php 
                    if(isset($_SESSION['aluno'])){
                        ?>
                <li><a href="../Tela/alterarCurso.php">Alterar Curso</a></li>
                <?php
                    }
                ?>
            </ul>

            <li><a class='dropdown-trigger' data-target='dropdown2'>Cadastrar informações</a></li>
            <ul id='dropdown2' class='dropdown-content'>
                <li><a><b>Cadastrar informações</b></a></li>
                <li><a href="../Tela/cadastroAluno.php">Aluno</a></li>
                <li><a href="#">Usuário</a></li>
                <li><a href="#">Membro da diretoria</a></li>
                <li><a href="#">Administrador</a></li>
            </ul>
            <!----------------------------------------------------------------------------------------------->
            <li><a class='dropdown-trigger' data-target='dropdown4'>Listar informações</a></li>
            <ul id='dropdown4' class='dropdown-content'>
                <li><a><b>Listar</b></a></li>
                <li><a href="../Tela/listarUsuario.php">Usuários</a></li>
<!--                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>-->
            </ul>
            <li><a class='dropdown-trigger' data-target='dropdown3'>Alterar dados</a></li>
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

     $('.dropdown-trigger').dropdown({
         hover:true
     });

</script>
