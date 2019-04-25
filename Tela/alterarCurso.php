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
        include_once '../Modelo/aluno.php';
        $logado = new aluno();
        $logado = unserialize($_SESSION['aluno']);
        ?>

        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center ">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../Controle/usuarioPDO.php?function=update" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="input-field" name="curso" value="<?php echo $logado->getCurso(); ?>">
                                <label for="curso">Curso</label>
                            </div>
                            <div class="input-field col s6">
                                <input class = "input-field datepicker" type = "text" name = "previsao_conclusao" value="<?php echo $logado->getPrevisao_conclusao(); ?>">
                                <label for = "previsao_conclusao">Previsão de Conclusão</label>
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
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha1" required="true">
                                <label for="senha">Senha</label>
                            </div>
                        </div>
                        <div class="row">
                            <a href="./home.php" class="btn corcancelar">Cancelar</a>
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
                });
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
            });

        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
