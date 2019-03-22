<?php
if (!isset($_SESSION)) {
    session_start();
}
?>\
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro</title>
    </head>
    <body class="homeimg">
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>

        <nav>
            <div class="nav-wrapper cyan lighten-2">
                <a class="brand-logo center">Configurações</a>
            </div>
        </nav>
        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioDAO.php?function=update" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="nome">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="usuario">
                                <label for="usuario">Usuário</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha1">
                                <label for="senha1">Senha</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha2">
                                <label for="senha2">Confirme sua senha</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="oldsenha">
                                <label for="senha2">Senha antiga</label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn cyan lighten-2" name="btlogin">Alterar</button>
                            <a href="../index.php" class="btn cyan lighten-2">Cancelar</a>
                        </div>
                        <?php
                        if(isset($_GET['msg'])){
                            if($_GET['msg'] == false){
                                ?>
                                <div class="row">
                                    <span class="red-text">Erro</span>
                                </div>
                        
                                <?php
                            }else{
                                header('Location ../index.php');
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </main>

        <footer class="cyan lighten-2 center">
            <div class="footer-copyright white-text">
                © 2019 Developed by - Daniel Castro - Konrado Souza
            </div>
        </footer>
    </body>
</html>
