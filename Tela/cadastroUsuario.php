<?php
if (!isset($_SESSION)) {
    session_start();
}
echo "PÁGINA DESATIVADA -> VERIFICAR ARQUIVO cadastroAluno.php<br>PS: Não excluir essa página"
//VERIFICAR LOGIN
?>                  
<!--<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body class="homeimg">

        <?php
        if (isset($_SESSION['id'])) {
            if ($_SESSION['administrador'] == 'true') {
                include_once '../Base/navAdministrativa.php';
            } else {
                include_once '../Base/navBar.php';
            }
        }
        ?>

        <br>
        <div class="row">
            <div class="col s6 card offset-s3">
                <?php
                if (isset($_GET['tipo'])) {
                    if ($_GET['tipo'] == 'responsavel') {
                        ?>
                        <center><h4>Cadastro de Responsavel</h4></center>
                        <?php
                    } else {
                        ?><center><h4>Cadastro de alunos</h4></center><?php
                        }
                    } else {
                        ?><center><h4>Cadastro de alunos</h4></center><?php
                    }
                    ?>

                <form class="center"  method="post" action="../Controle/usuarioPDO.php?function=inserirAluno" name="formulario-cadastro-aluno">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="login">
                            <label for="login">Login</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cidade">
                            <label for="cidade">Cidade</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="bairro">
                            <label for="bairro">Bairro</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="rua">
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="numero">
                            <label for="numero">Número da casa</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cep">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="rg">
                            <label for="rg">Data de nascimento dd/mm/aaaa</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cpf">
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="rg">
                            <label for="rg">RG</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="password" name="senha01">
                            <label for="senha01">Senha</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="password" name="senha02">
                            <label for="senha02">Confirme a senha</label>
                        </div>
                        <div class="input-field col s6">

                        </div>
                        <?php 
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "senhasdiferentes") {
                                ?>  
                                <div class="row">
                                    <span class="red-text">Senhas não conferem</span>
                                </div>
                            <?php } elseif ($_GET['msg'] == 'senhavazia') {
                                ?>
                                <div class="row">
                                    <span class="red-text">Senha Vazia</span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col s12">
                                <a href="./home.php" class="btn hoverable corpadrao">Cancelar</a>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>-->