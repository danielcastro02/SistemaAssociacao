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
            <div class="row">
                <div class = "col s8 card offset-s2">
                    <center><h4>Movimento de Caixa</h4></center>
                    <form id="formulario" class = "center" method = "post" action = "../../Controle/movimentoControle.php?function=inserir">
                        <div class="row">
                            <input type="text" value="<?php echo $logado->getId(); ?>" name="id_usuario" id="id_usuario" hidden="true">
                            <div class="input-field col s4">
                                <select name="id_caixa_ref">
                                    <option value="0">Selecione o Caixa</option>
                                    <option value="1">Dia</option>
                                    <option value="2">Noite</option>
                                    <option value="3">Associação</option>
                                </select>
                                <label for = 'turno'>Caixa</label>
                            </div>

                            <div class="input-field col s4">
                                <select name="id_tipo_ref">
                                    <option value="0">Selecione o Tipo</option>
                                    <?php
                                    include_once '../../Controle/tipo_movimentoPDO.php';
                                    $tmovimentoPDO = new tipo_movimentoPDO();
                                    $resultado = $tmovimentoPDO->selectTudo();
                                    if ($resultado) {
                                        while ($linha = $resultado->fetch()) {
                                            $tmo = new tipo_movimento($linha);
                                            echo "<option value='" . $tmo->getId_tipo() . "' >" . $tmo->getNome_movimento() . "(" . ($tmo->getTipo() ? 'Entrada' : 'Saida') . ")</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for = 'turno'>Tipo</label>
                            </div>
                            <div class="input-field col s4">
                                <input type="text" name="valor" id="valor">
                                <label for="valor">Valor (R$)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" name='pesquisa' id="pesquisa">
                                <label for="usuario">Pesquise o usuario aqui</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="id_usuario_ref" id="select">
                                    <option value="0" class="disabled selected">Selecione o usuário</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <a href="../Sistema/home.php" class="btn corcancelar">Cancelar</a>
                            <button type="submit" class="btn corpadrao" name="btlogin">Inserir</button>
                        </div>

                    </form>
                </div>
            </div>
            <script src="../../js/mascaras.js" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $('#pesquisa').keyup(function (){
                        var dados = $("form").serialize();
                        $("#select").load('./loadSelectRegmov.php', dados , function (){
                            $('select').formSelect();
                        });
                        
                    });
                    $('select').formSelect();
                    $('#valor').mask('#.##0,00', {reverse: true});
                    $('form').submit(function () {
                        if ($('select').val() == '0') {
                            alert('Preencha corretamente os campos!');
                            return false;
                        } else {
                            var valor = $('#valor').val();
                            valor = valor.replace(".", "");
                            valor = valor.replace(".", "");
                            valor = valor.replace(".", "");
                            valor = valor.replace(",", ".");
                            return true;
                        }
                    });
                });
            </script>
        </main>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>