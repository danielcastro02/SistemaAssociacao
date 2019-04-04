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
}
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body class="homeimg">

        <?php include_once '../Base/navBar.php'; ?>

        <br>
        <div class="row">
            <div class="col s6 card offset-s3">
                <center><h4>Cadastre o aluno</h4></center>
                <form class="center"  method="post" action="../Controle/usuarioPDO.php?function=inserirUsuario" name="formulario-cadastro-aluno">
                    <div class="col s12"> 
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="login">
                            <label for="login">Login</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cidade">
                            <label for="cidade">Cidade</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="bairro">
                            <label for="bairro">Bairro</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="rua">
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="numero">
                            <label for="numero">Número da casa</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cep">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="curso">
                            <label for="email">Curso</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="conclusao">
                            <label for="email">Ano de conclusão do curso</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="nascimento">
                            <label for="email">Data de nascimento dd/mm/aaaa</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="cpf">
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="text" name="rg">
                            <label for="rg">RG</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="password" name="senha01">
                            <label for="senha01">Senha</label>
                        </div>
                        <div class="input-field col s6">
                            <input class="input-field" type="password" name="senha02">
                            <label for="senha02">Confirme a senha</label>
                        </div>
                        <!--                        <div class="input-field col s6">
                                                    <input class="input-field" type="text" name="cargo">
                                                    <label for="cargo">Cargo</label>
                                                </div>-->
                        <!--                        <div>
                                                    <h1>Dados do </h1>
                                                </div>-->
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "senhasdiferentes") {
                                ?>  
                                <div class="row">
                                    <span class="red-text">Senhas não conferem</span>
                                </div>
                            <?php } elseif ($_GET['msg'] == 'senhavazia') {
                                ?>
                                <div class="row">
                                    <span class="red-text">Senha Vazia</span>
                                </div>
                            <?php } elseif ($_GET['msg'] == 'senhaPequena') {
                                ?>  
                                <div class="row">
                                    <span class="red-text">S senha precisa ter pelo menos 6 caracteres</span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col s12">
                                <a href="./home.php" class="btn hoverable corpadrao">Cancelar</a>
                                <button type="submit" class="btn hoverable corpadrao">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s3"></div>
        </div>
        <script>
            $(document).ready(function
                    );
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>