<?php
session_start();
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body class="homeimg">
        <?php include_once '../Base/nav.php'; ?>
        <br> 
        <div class="row">
            <div class="col s6 card offset-s3">
                <div class="center">
                    <h4>Cadastre o responsável</h4>
                    <?php
                    if(isset($_GET['msg'])){
                        if($_GET['msg']== 'responsavelMenorDeIdade'){
                            ?>
                    <h5 class="red-text">O Responsável tem que ser maior de Idade!</h5>
                                <?php
                        }
                    }
                    ?>
                </div>
                <form class="center"  method="post" action="../Controle/usuarioPDO.php?function=inserirUsuario&user=responsavel" name="formulario-cadastro-responsavel">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="usuario">
                            <label for="usuario">Login</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="cidade">
                            <label for="cidade">Cidade</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="bairro">
                            <label for="bairro">Bairro</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="rua">
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="numero">
                            <label for="numero">Número da casa</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="cep">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class = "input-field col s6">
                            <input required="true"  class = "input-field datepicker" type = "text" name = "data_nasc">
                            <label for = "data_nasc">Data de Nascimento</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="cpf">
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="rg">
                            <label for="rg">RG</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="password" name="senha1">
                            <label for="senha1">Senha</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="password" name="senha2">
                            <label for="senha2">Confirme a senha</label>
                        </div>
                        <?php
                        include_once '../Base/msgSaida.php';
                        //não esquecer de verificar a msg de menor de idade para responsável
                        ?>
                        <div class="row">
                            <div class="col s12">
                                <a href="./home.php" class="btn hoverable corpadrao">Cancelar</a>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    $(document).ready(function () {
                        $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
                    });
                </script>
            </div>
            <div class="col s3"></div>
        </div>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>