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
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'responsavelMenorDeIdade') {
                            ?>
                            <h5 class="red-text">O Responsável tem que ser maior de Idade!</h5>
                            <?php
                        }
                    }
                    ?>
                </div>
                <form class="center" id="formulario"  method="post" action="../Controle/usuarioPDO.php?function=inserirResponsavel" name="formulario-cadastro-responsavel">
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
                            <input required="true"  class="input-field" type="text" name="cep" id="cep">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="telefone" id="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field validate" type="email" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class = "input-field col s6">
                            <input required="true"  class = "input-field date" type = "text" name = "data_nasc">
                            <label for = "data_nasc">Data de Nascimento</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="cpf" id="cpf">
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
                                <a href="./home.php" class="btn hoverable corcancelar">Cancelar</a>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <?php include_once '../Base/footer.php'; ?>
        <script src="../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('.date').mask("00/00/0000");
                $('#cpf').mask('000.000.000-00');
                $('#celular').mask('(00) 00000-0000');
                $('#cep').mask('00000-000');
                $('#formulario').submit(function () {
                    var cpf = $('#cpf').val().replace('.', '').toString();
                    cpf = cpf.replace('.', '');
                    cpf = cpf.replace('-', '');
                    if (cpf.length == 11) {
                        var x = false;
                        for (var i = 0; i <= 8; i++) {
                            if (!(cpf[i] == cpf[i + 1])) {
                                x = true;
                            }
                        }
                        if (x) {
                            var v = [];
                            v[0] = (1 * cpf[0]) + (2 * cpf[1]) + (3 * cpf[2]);
                            v[0] += (4 * cpf[3]) + (5 * cpf[4]) + (6 * cpf[5]);
                            v[0] += (7 * cpf[6]) + (8 * cpf[7]) + (9 * cpf[8]);
                            v[0] = v[0] % 11;
                            v[0] = v[0] % 10;

                            v[1] = (1 * cpf[1]) + (2 * cpf[2]) + (3 * cpf[3]);
                            v[1] += (4 * cpf[4]) + (5 * cpf[5]) + (6 * cpf[6]);
                            v[1] += (7 * cpf[7]) + (8 * cpf[8]) + (9 * v[0]);
                            v[1] = v[1] % 11;
                            v[1] = v[1] % 10;

                            if ((v[0] != cpf[9]) || v[1] != cpf[10]) {
                                alert("O CPF inserido é inválido!")
                                $("#cpf").attr('class', 'invalid');
                                $("#cpf").focus();
                            } else {
                                $("#cpf").attr('class', 'valid');
                            }
                        } else {
                            $("#cpf").attr('class', 'invalid');
                            $("#cpf").focus();
                        }
                    } else {
                        $("#cpf").attr('class', 'invalid');
                        $("#cpf").focus();
                    }
                });
            });
        </script>
    </body>
</html>