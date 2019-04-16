<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
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

        <?php
        include_once '../Base/nav.php';
        include_once '../Modelo/usuario.php';
        $logado = new usuario();
        $logado = unserialize($_SESSION['usuario']);
        ?>

        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioPDO.php?function=updateEndereco" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cidade" value="<?php echo $logado->getCidade(); ?>">
                                <label for="cidade">Cidade</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="bairro" value="<?php echo $logado->getBairro(); ?>">
                                <label for="bairro">Bairro</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="rua" value="<?php echo $logado->getRua(); ?>">
                                <label for="rua">Rua</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="numero" value="<?php echo $logado->getNumero(); ?>">
                                <label for="numero">Número</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cep" value="<?php echo $logado->getCep(); ?>">
                                <label for="cep">CEP</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha1" required="true">
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
                            <a href="./home.php" class="btn hoverable corpadrao">Cancelar</a>
                            <button type="submit" class="btn hoverable corpadrao" name="btlogin">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
