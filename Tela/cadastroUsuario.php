<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body class="homeimg">
        <!--
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="collapsible.html">JavaScript</a></li>
                </ul>
            </div>
        </nav>-->
        <br>
        <div class="row">
            <div class="col s3"></div>
            <div class="col s6">
                <center><h4>Cadastro de alunos</h4></center>
                <form method="post" action="../Controle/usuarioPDO.php?function=inserirUsuario" name="formulario-cadastro-aluno">
                    <div class="input-field col s6">
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="nome">
                            <label for="nome">Nome completo</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="cidade">
                            <label for="cidade">Cidade</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="rua">
                            <label for="rua">Rua</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="cpf">
                            <label for="cpf">CPF</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="senha01">
                            <label for="senha01">Senha</label>
                        </div>
                    </div>
                    <div class="input-field col s6">

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="login">
                            <label for="login">Login</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="bairro">
                            <label for="bairro">Bairro</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="numero">
                            <label for="numero">Número da casa</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="rg">
                            <label for="rg">RG</label>
                        </div>

                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="senha02">
                            <label for="senha02">Confirme a senha</label>
                        </div>
                        <div class="input-field col s12">

                        </div>
                    </div>

                    <div class="s12 center">
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "senhasdiferentes") {?>
                                <div class="row">
                                    <span class="red-text">Senhas não conferem</span>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <a href="./home.php" class="btn">Cancelar</a>
                        <button type="submit">Enviar</button>
                    </div>

            </div>
            <div class="col s3"></div>
        </div>
    </div>
</body>
</html>

