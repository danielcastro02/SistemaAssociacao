<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../Modelo/usuario.php';
if (isset($_SESSION['usuario'])) {
    $logado = new usuario();
    $logado = unserialize($_SESSION['usuario']);
    if ($logado->getAdministrador() == 'false') {
        header('location: ../Sistema/acessoNegado.php');
    }
} else {
    header('location: ../Sistema/login.php');
}
?>
<!DOCTYPE html>
<html>
    <header>
        <?php
        include_once '../../Base/header.php';
        ?>
    </header>
    <body class="homeimg">

        <?php
        include_once '../../Base/nav.php';
        ?>
        <main>
            <div class="row ">
                <div class="card col s8">
                    <form class="col s12" action="../../Controle/mensalidadeControle.php?function=insereCobranca" method="POST">
                        <div class="row">
                            <h5>Registro de Mensalidade</h5>
                        </div>
                        <div class="row">
                            <div class="input-field" col s6>
                                <input type="text" name="mes" class="input-field" required="true">
                                <label for="mes">Mês Referente</label>
                            </div>
                            <div class="input-field" col s6>
                                <input type="text" name="vencimento" class="input-field date" required="true">
                                <label for="mes">Data de Vencimento</label>
                            </div>
                            <div class="input-field" col s6>
                                <input type="text" name="valor" class="input-field dinheiro" required="true">
                                <label for="mes">Data de Vencimento</label>
                            </div>
                            <div class="col s6">
                                <select name="id_caixa_ref_mensalidade">
                                    <option disabled="true" selected="true" value="0">Selecione o Caixa</option>
                                    <option value="1">Dia</option>
                                    <option value="2">Noite</option>
                                </select>
                            </div>
                            <div class="row">
                                <a class="btn corcancelar" href="../Sistema/home.php">Voltar</a>
                                <input type="submit" class="btn corpadrao" value="Confirma">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </main>
        <script src="../../js/mascaras.js" type="text/javascript">
            $('.date').mask('00/00/0000');
            $('.dinheiro').mask('#.##0,00', {reverse: true});
            $('form').submit(function () {
                var valor = $('#valor').val();
                valor = valor.replace(".", "");
                valor = valor.replace(".", "");
                valor = valor.replace(".", "");
                valor = valor.replace(",", ".");
                return true;
            });
        </script>
        <script src="../../js/verificaData.js" type="text/javascript"></script>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>