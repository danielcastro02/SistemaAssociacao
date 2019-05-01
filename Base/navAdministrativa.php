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
                <li><a href="<?php echo $pontos; ?>Tela/alterarDadosUsuario.php">Alterar dados pessoais</a></li>
                <li><a href="<?php echo $pontos; ?>Tela/alterarEnderecoUsuario.php">Alterar endereço</a></li>
                <?php 
                    if(isset($_SESSION['aluno'])){
                        ?>
                <li><a href="<?php echo $pontos; ?>Tela/alterarCurso.php">Alterar curso</a></li>
                <li><a href="#">Alterar senha</a></li>
                <?php
                    }
                ?>
            </ul>

            <li><a class='dropdown-trigger' data-target='dropdown2'>Cadastrar informações</a></li>
            <ul id='dropdown2' class='dropdown-content'>
                <li><a><b>Cadastrar informações</b></a></li>
                <li><a href="<?php echo $pontos; ?>Tela/cadastroAluno.php">Aluno</a></li>
                <li><a href="<?php echo $pontos; ?>Tela/cadastroDiretoria.php">Membro da diretoria</a></li>
                <li><a href="<?php echo $pontos; ?>Tela/cadastroResponsavel.php">Responsável</a></li>
                <li><a href="<?php echo $pontos; ?>Tela/Curso/inserirCurso.php">Curso</a></li>
            </ul>
            <!----------------------------------------------------------------------------------------------->
            <li><a class='dropdown-trigger' data-target='dropdown4'>Listar informações</a></li>
            <ul id='dropdown4' class='dropdown-content'>
                <li><a><b>Listar</b></a></li>
                <li><a href="<?php echo $pontos; ?>Tela/listarUsuario.php">Usuários</a></li>
                <li><a href="#">Movimentações</a></li>
<!--                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>-->
            </ul>
            
            <li><a href="<?php echo $pontos; ?>./Controle/usuarioPDO.php?function=logout">Sair</a></li>
        </ul>
    </div>
</nav>

<script>

     $('.dropdown-trigger').dropdown({
         hover:false
     });

</script>
