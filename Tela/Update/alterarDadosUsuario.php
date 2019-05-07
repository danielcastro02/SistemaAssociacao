<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Sistemalogin.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Dados</title>
        <?php
        include_once '../../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <?php
        include_once '../../Base/nav.php';
        include_once '../../Modelo/usuario.php';
        $logado = new usuario();
        $logado = unserialize($_SESSION['usuario']);
        ?>

        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center ">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../../Controle/usuarioPDO.php?function=update" method="POST" id="formulario">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="nome" value="<?php echo $logado->getNome(); ?>">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="usuario"  value="<?php echo $logado->getUsuario(); ?>" id="usuario">
                                <label for="usuario" id="lusuario">Usuário</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="cpf" value="<?php echo $logado->getCpf(); ?>" id="cpf">
                                <label for="cpf" id="lcpf">CPF</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="rg" value="<?php echo $logado->getRg(); ?>" id="rj">
                                <label for="rg" id="rg">RG</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="telefone" value="<?php echo $logado->getTelefone(); ?>">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="email" class="input-field validate" name="email" value="<?php echo $logado->getEmail(); ?>" id="email">
                                <label for="email" id="email">Email</label>
                            </div>
                        </div>
                        <div class="row" id="esconde">
                            <a class="btn corpadrao hoverable">Alterar Senha</a>
                        </div>
                        <div class="row" hidden="true" id="mostra">
                            <div class="input-field col s6">
                                <input type="password" class="input-field msenha" name="senha1" id="senha1">
                                <label for="senha2" id="lsenha1">Nova senha</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" class="input-field msenha" name="senha2" id="senha2">
                                <label for="senha2conf" id="lsenha2">Confirmar nova senha</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="oldsenha" required="true">
                                <label for="oldsenha">Senha antiga</label>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == 'sucesso' || $_GET['msg'] == 'sucessoss') {
                                ?>
                                <div class="row center">
                                    <span class="green-text">Dados alterados com sucesso</span>
                                </div>
                                <?php
                            } else {
                                if ($_GET['msg'] == 'senhavazia') {
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
                            <a href="../Sistema/home.php" class="btn corcancelar">Cancelar</a>
                            <button type="submit" class="btn corpadrao" name="btlogin">Alterar</button>
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
            $(document).ready(function () {
                $("#esconde").click(function () {
                    $("#mostra").removeAttr('hidden');
                    $("#esconde").attr('hidden', 'true');
                    $(".msenha").attr('required', 'true');
                });
            });
            
        </script>
        <script src="../../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('#cpf').mask("000.000.000-00");
                $('#telefone').mask("(00) 00000-0000");
                $('#cep').mask("00000-000");
            });
        </script>
        <script src="../../js/verificaSenha.js" type="text/javascript"></script>
        <script src="../../js/verificaFormulario.js"></script>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>
