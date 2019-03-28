<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
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

        <?php
        include_once '../Base/navPadrao.php';
        ?>
        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center grey lighten-2">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioPDO.php?function=updateEndereco" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cidade" value="<?php echo $_SESSION['cidade']; ?>">
                                <label for="cidade">Cidade</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="bairro" value="<?php echo $_SESSION['bairro']; ?>">
                                <label for="bairro">Bairro</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="rua" value="<?php echo $_SESSION['rua']; ?>">
                                <label for="rua">Rua</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="numero" value="<?php echo $_SESSION['numero']; ?>">
                                <label for="numero">Número</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cep" value="<?php echo $_SESSION['cep']; ?>">
                                <label for="cep">CEP</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="oldsenha">
                                <label for="oldsenha">Senha</label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn corpadrao" name="btlogin">Alterar</button>
                            <a href="./home.php" class="btn corpadrao">Cancelar</a>
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
