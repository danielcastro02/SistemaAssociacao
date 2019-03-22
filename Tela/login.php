<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <nav class="nav-extended teal darken-1">
            <div class="nav-wrapper">
                <a class="brand-logo center">Bem-vindo!</a>
            </div>
        </nav>

        <main id="main">
            <div class="row">
                <div class="col s4 offset-s4 card center">
                    <h5>Identifique-se com seu cadastro</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioPDO.php?function=login" method="POST">
                        <div class="input-field col s12">
                            <input type="text" class="input-field" name="usuario">
                            <label for="usuario">Usuário</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="password" class="input-field" name="senha">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn teal darken-1" name="btlogin">Entrar</button>
                        </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == false) {
                                ?>
                                <div class="row">
                                    <span class="red-text">Usuário ou senha inválidos!</span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="row">
                            <a href="./Usuario/registro.php">Cadastre-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <footer class="teal darken-1 center">
            <div class="footer-copyright white-text">
                © 2019 Developed by - Daniel Castro - Konrado Souza - Lucas Lima
            </div>
        </footer>
    </body>
</html>
