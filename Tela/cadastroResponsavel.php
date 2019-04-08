<?php
session_start();
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body class="homeimg">
        <?php include_once '../Base/navBar.php'; ?>
        <br> 
        <div class="row">
            <div class="col s6 card offset-s3">
                <div class="center">
                    <h4>Cadastre o responsável</h4>
                </div>
                <form class="center"  method="post" action="../Controle/usuarioPDO.php?function=inserirUsuario&user=responsavel" name="formulario-cadastro-responsavel">
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
                        <div class = "input-field col s6">
                            <div class = "left grey-text">
                                Data de nascimento
                            </div>
                            <input class = "input-field" type = "date" name = "nascimento">
                            <label for = "nascimento"></label>
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
                        <?php include_once '../Base/msgSaida.php'; ?>
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
</html>