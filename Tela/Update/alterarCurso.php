<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Sistema/login.php');
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
        include_once '../../Modelo/aluno.php';
        $logado = new aluno();
        $logado = unserialize($_SESSION['aluno']);
        ?>

        <main id="main">
            <div class="row">
                <div class="col s8 offset-s2 card center ">
                    <h5>Seus dados</h5>
                    <form class="col s12 input-field" action="../../Controle/usuarioControle.php?function=update" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <select name = "id_curso" required="true">
                                    <option value="0">Selecione o curso</option>
                                    <?php
                                    include_once '../../Controle/cursoPDO.php';
                                    $cursoPDO = new cursoPDO();
                                    $resultado = $cursoPDO->selectTudo();
                                    if ($resultado) {
                                        while ($linha = $resultado->fetch()) {
                                            echo "<option value='" . $linha['id'] . ($linha['id'] == $logado->getId_curso() ? "' selected" : "") . ">" . $linha['nome'] . " (" . $linha['turno'] . ")" . "</option>";
                                        }
                                    } else {
                                        echo "<option value='0'>Nenhum curso cadastrado!</option>";
                                    }
                                    ?>
                                </select>
                                <label for = "id_curso">Curso</label>
                            </div>
                            <div class="input-field col s6">
                                <input class = "input-field date" type = "text" name = "data_inicio" value="<?php echo $logado->getData_inicio(); ?>">
                                <label for = "previsao_conclusao">Data de Início</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input class = "input-field date" type = "text" name = "previsao_conclusao" value="<?php echo $logado->getPrevisao_conclusao(); ?>">
                                <label for = "previsao_conclusao">Previsão de Conclusão</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="concluido">
                                    <option value="true"<?php  echo $logado->getConcluido()=='true'?'selected':''; ?>>Sim</option>
                                    <option value="false" <?php echo $logado->getConcluido()=='false'?'selected':''; ?> >Não</option>
                                </select>
                                <label for="concluido">Concluido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="password" class="input-field" name="senha1" required="true">
                                <label for="senha">Senha</label>
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
        <?php include_once '../../Base/footer.php'; ?>
        <script src="../../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('.date').mask("00/00/0000");
                $('select').formSelect();
            });
        </script>
    </body>
</html>
