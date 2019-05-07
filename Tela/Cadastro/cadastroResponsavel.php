<?php
session_start();
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../../Base/header.php'; ?>
    </head>
    <body class="homeimg">
        <?php include_once '../../Base/nav.php'; ?>
        <br> 
        <div class="row">
            <div class="col s8 card offset-s2">
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
                <form class="center" id="formulario"  method="post" action="../../Controle/usuarioPDO.php?function=inserirResponsavel" name="formulario-cadastro-responsavel">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="usuario" id="usuario">
                            <label for="usuario" id="lusuario">Login</label>
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
                            <input required="true"  class="input-field validate" type="email" name="email" id="email">
                            <label for="email" id="lemail">E-mail</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "date" type = "text" name = "data_associacao" required="true">
                            <label for = "data_nasc">Data de associação</label>
                        </div>
                        <div class = "input-field col s6">
                            <input required="true"  class = "input-field date" type = "text" name = "data_nasc" id="datanasc">
                            <label for = "data_nasc" id="ldataNasc">Data de Nascimento</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="cpf" id="cpf">
                            <label for="cpf" id="lcpf">CPF</label>
                        </div>
                        <div class="input-field col s6">
                            <input required="true"  class="input-field" type="text" name="rg" id="rg">
                            <label for="rg" id="lrg">RG</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" id="senha1" type = "password" name = "senha1" required="true">
                            <label for = "senha1" id="lsenha1">Senha</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" id="senha2" type = "password" name = "senha2" required="true">
                            <label for = "senha2" id="lsenha2">Confirme a senha</label>
                        </div>
                        <?php
                        include_once '../Base/msgSaida.php';
                        //não esquecer de verificar a msg de menor de idade para responsável
                        ?>
                        <div class="row">
                            <div class="col s12">
                                <a href="../Sistema/home.php" class="btn hoverable corcancelar">Cancelar</a>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <?php include_once '../../Base/footer.php'; ?>
        <script src="../../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('.date').mask("00/00/0000");
                $('#cpf').mask('000.000.000-00');
                $('#celular').mask('(00) 00000-0000');
                $('#cep').mask('00000-000');
            });
        </script>
        <script src="../../js/verificaFormulario.js" type="text/javascript"></script>
        <script src="../../js/verificaSenha.js" type="text/javascript"></script>
        <script src="../../js/verificaIdade.js" type="text/javascript"></script>
    </body>
</html>