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
        <script type="text/javascript" src="../js/materialize.js"></script>

        <?php
        include_once '../Base/navPadrao.php';
        ?>
        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center ">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioPDO.php?function=update" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="nome" value="<?php echo $_SESSION['nome']; ?>">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="usuario"  value="<?php echo $_SESSION['usuario']; ?>">
                                <label for="usuario">Usuário</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cpf" value="<?php echo $_SESSION['cpf']; ?>">
                                <label for="cpf">CPF</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="rg" value="<?php echo $_SESSION['rg']; ?>">
                                <label for="rg">RG</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="telefone" value="<?php echo $_SESSION['telefone']; ?>">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="email" value="<?php echo $_SESSION['email']; ?>">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row" id="esconde">
                            <a class="btn corpadrao hoverable">Alterar Senha</a>
                        </div>
                        <div class="row" hidden="true" id="mostra">
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha2">
                                <label for="senha2">Nova senha</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha2conf">
                                <label for="senha2conf">Confirmar nova senha</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="oldsenha">
                                <label for="oldsenha">Senha antiga</label>
                            </div>
                        </div>
                        <?php 
                            if(isset($_GET['msg'])){
                                if($_GET['msg'] == 'sucesso'||$_GET['msg'] == 'sucessoss'){
                                    ?>
                        <div class="row center">
                            <span>Dados alterados com sucesso</span>
                        </div>
                        <?php
                                }else{
                                    if($_GET['msg'] == 'senhavazia'){
                                        ?>
                                            <div class="row">
                                    <span class="red-text">Digite sua senha antiga!</span>
                                </div>
                                            <?php
                                    }
                                }
                            }
                        ?>
                        <div class="row">
                            <button type="submit" class="btn corpadrao" name="btlogin">Alterar</button>
                            <a href="./home.php" class="btn corpadrao">Cancelar</a>
                        </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == false) {
                                ?>
                                <div class="row">
                                    <span class="red-text">Erro</span>
                                </div>

                                <?php
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </main>
        <script>
        $(document).ready(function(){
            $("#esconde").click(function(){
                $("#mostra").removeAttr('hidden');
                $("#esconde").attr('hidden', 'true');
            });
        });
        
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
