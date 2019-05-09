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
                <div class = "col s6 card offset-s3">
                    <center><h4>Cadastre o Tipo de movimento</h4></center>
                    <form id="formulario" class = "center" method = "post" action = "../../Controle/movimentoPDO.php?function=inserir">
                        <div class="row">
                            <input type="text" value="<?php echo $logado->getId(); ?>" name="id_usuario" id="id_usuario" hidden="true">
                            <div class="input-field col s6">
                                <select name="id_caixa_ref">
                                    <option value="0">Selecione o Caixa</option>
                                    <option value="1">Dia</option>
                                    <option value="2">Noite</option>
                                    <option value="3">Associação</option>
                                </select>
                                <label for = 'turno'>Caixa</label>
                            </div>
                                
                            <div class="input-field col s6">
                                <select name="id_tipo_ref">
                                    <option value="0">Selecione o Tipo</option>
                                    <option value="true">Entrada</option>
                                    <option value="false">Saída</option>
                                </select>
                                <label for = 'turno'>Tipo</label>
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
            $(document).ready(function(){
               $('select').formSelect();
            });
            </script>
        </main>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>