<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head> 
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        ?>
        <br>
        <div class = "row">
            <div class = "col s6 card offset-s3">
                <center><h4>Cadastre o membro da diretoria</h4></center>
                <form class = "center" method = "post" action = "../Controle/usuarioPDO.php?function=inserirUsuario&user=aluno" name = "formulario-cadastro-aluno">
                    <div class = "col s12">
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "nome" required="true">
                            <label for = "nome">Nome</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "usuario" required="true">
                            <label for = "usuario">Login</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "cidade" required="true">
                            <label for = "cidade">Cidade</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "bairro" required="true">
                            <label for = "bairro">Bairro</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "rua" required="true">
                            <label for = "rua">Rua</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "numero" required="true">
                            <label for = "numero">Número da casa</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "cep" required="true">
                            <label for = "cep">CEP</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "telefone" required="true"> 
                            <label for = "telefone">Telefone</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "email" required="true">
                            <label for = "email">E-mail</label>
                        </div>
                        <div class = "input-field col s6">
                            <div class = "left grey-text">
                                Data de nascimento
                            </div>
                            <input class = "datepicker" type = "text" name = "data_nasc" required="true">
                            <label for = "data_nasc"></label>
                        </div>

                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "cpf" required="true">
                            <label for = "cpf">CPF</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "rg" required="true">
                            <label for = "rg">RG</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "password" name = "senha1" required="true">
                            <label for = "senha1">Senha</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "password" name = "senha2" required="true">
                            <label for = "senha2">Confirme a senha</label>
                        </div>

                        <?php include_once '../Base/msgSaida.php'; ?>

                        <div class="row">
                            <div class="col s12">
                                <a href = "./home.php" class = "btn hoverable corpadrao">Cancelar</a>
                                <a href = "../index.php" class = "btn hoverable corpadrao">Cancelar</a>
                                <button type = "submit" class = "btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class = "col s3"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
            });
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>