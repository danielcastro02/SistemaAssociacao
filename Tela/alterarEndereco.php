<?php
if (!isset($_SESSION)) {
    session_start();
}
?>\
<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Dados</title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body class="homeimg">
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>

        <nav>
            <div class="nav-wrapper teal darken-1">
                <a class="brand-logo center">Configurações</a>
            </div>
        </nav>
        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center grey lighten-2">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioDAO.php?function=update" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cidade">
                                <label for="cidade">Cidade</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="bairro">
                                <label for="bairro">Bairro</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="rua">
                                <label for="rua">Rua</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="numero">
                                <label for="numero">Número</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cep">
                                <label for="cep">CEP</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha1">
                                <label for="senha1">Senha</label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn teal darken-1" name="btlogin">Alterar</button>
                            <a href="../index.php" class="btn teal darken-1">Cancelar</a>
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

        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
