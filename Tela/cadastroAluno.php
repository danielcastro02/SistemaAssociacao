<?php
//date_default_timezone_set('America/Sao_Paulo');
//$date = date('Y-m-d H:i');
//$date = date('Y-m-d');
//echo $date . "<br>";
//$data = '02/09/1998';
//list($dia, $mes, $ano) = explode('/', $data);
//$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
//$nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
//$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
//print $idade;
//split = explode
if (!isset($_SESSION)) {
    session_start();
    unset($_SESSION['temp']);
}
//NÃO VERIRIFCAR SE ESTÁ LOGADO, PQ EXISTE O REQUERIMENTO DE ASSOCIAÇÃO
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
                <center><h4>Cadastre o aluno</h4></center>
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
                            <input class = "input-field" type = "text" name = "curso" required="true">
                            <label for = "curso">Curso</label>
                        </div>
                        <div class = "input-field col s6">
                            <div class = "left grey-text">
                                Data de conclusão de curso
                            </div>

                            <input class = "datepicker" type = "text" name = "previsao_conclusao" required="true">

                            <label for = "previsao_conclusao"></label>
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
                                <?php
                                include_once '../Modelo/usuario.php';

                                if (isset($_SESSION['usuario'])) {
                                    $usuario = new usuario(unserialize($_SESSION['usuario']));
                                    ?>
                                    <a href = "./home.php" class = "btn hoverable corcancelar">Cancelar</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="../index.php" class="btn hoverable corcancelar">Cancelar</a>
                                    <?php
                                }
                                ?>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
            });
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>