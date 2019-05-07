<?php
include_once '../../Modelo/usuario.php';
if (!isset($_SESSION)) {
    session_start();
    unset($_SESSION['temp']);
}
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
    <head>
        <?php include_once '../../Base/header.php'; ?>
        <title>Cadastro de Curso</title>
    </head> 
    <body class="homeimg">

        <?php
        include_once '../../Base/nav.php';
        ?>
        <br>
        <div class = "row">
            <div class = "col s8 card offset-s2">
                <center><h4>Cadastre o Curso</h4></center>
                <form id="formulario" class = "center" method = "post" action = "../../Controle/cursoPDO.php?function=inserir">
                    <div class="row">
                        <div class="input-field col s4">
                            <input type="text" class="input-field" name="nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s4">
                            <select name="turno">
                                <option value="0">Selecione o Turno</option>
                                <option value="Manha">Manha</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noite">Noite</option>
                            </select>
                            <label for = 'turno'>Turno</label>
                        </div>
                        <div class="input-field col s4">
                            <select name="nivel">
                                <option value="0">Selecione o Nível</option>
                                <option value="Médio">Médio</option>
                                <option value="Subsequente">Subsequente</option>
                                <option value="Superior">Superior</option>
                            </select>
                            <label for = 'nivel'>Nível</label>
                        </div>
                        <div class="row">
                            <a href="../Sistema/home.php" class="btn corcancelar">Cancelar</a>
                            <button type="submit" class="btn corpadrao" name="btlogin">Inserir</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <script src="../../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('.date').mask("00/00/0000");
                $('select').formSelect();
            });
        </script>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>

