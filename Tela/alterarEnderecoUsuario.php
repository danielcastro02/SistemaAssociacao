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
        if($_SESSION['administrador']== 'true'){
        include_once '../Base/navAdministrativa.php';
        }
        else{
        include_once '../Base/navPadrao.php';    
        }
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
                                <input type="password" class="input-field" name="senha">
                                <label for="senha">Senha</label>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == 'sucesso') {
                                ?>
                                <div class="row center">
                                    <span>Dados alterados com sucesso</span>
                                </div>
                                <?php
                            }
                            if ($_GET['msg'] == 'senhavazia') {
                                ?>
                                <div class="row">
                                    <span class="red-text">Digite sua senha antiga!</span>
                                </div>
                                <?php
                            }
                            if ($_GET['msg'] == 'senhaerrada') {
                                ?>
                                <div class="row">
                                    <span class="red-text">Senha incorreta!</span>
                                </div>
                                <?php
                            }
                            if ($_GET['msg'] == 'bderro') {
                                ?>
                                <div class="row">
                                    <span class="red-text">Erro no banco!</span>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <div class="row">
                            <button type="submit" class="btn hoverable corpadrao" name="btlogin">Alterar</button>
                            <a href="./home.php" class="btn hoverable corpadrao">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
