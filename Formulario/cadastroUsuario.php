<?php
session_start(); //ESTÁ CLASSE É TEMPORARIA
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body>
        <br>
        <div class="row">
            <div class="col s3 red"></div>
            <div class="col s6">
                <center><h4>Cadastro de alunos</h4></center>
                <form class="center" method="post" action="../Controle/usuarioPDO.php?function=inserirUsuario" name="formulario-cadastro-aluno">
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
                                <input class="input-field" type="text" name="telefone">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="input-field col s6">
                                <input class="input-field" type="text" name="email">
                                <label for="email">E-mail</label>
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
                                <input class="input-field" type="text" name="senha01">
                                <label for="senha01">Senha</label>
                            </div>
                            <div class="input-field col s6">
                                <input class="input-field" type="text" name="senha02">
                                <label for="senha02">Confirme a senha</label>
                            </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "senhasdiferentes") {
                                ?>
                                <div class="row">
                                    <span class="red-text">Senhas não conferem</span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <a href="./home.php" class="btn">Cancelar</a>
                        <button type="submit" class="btn">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="col s3 red"></div>
        </div>
    </div>
</body>
</html>



