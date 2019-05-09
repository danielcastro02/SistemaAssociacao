<?php
if (!isset($_SESSION)) {
    session_start();
    unset($_SESSION['temp']);
}
?>                  
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../../Base/header.php'; ?>
    </head> 
    <body class="homeimg">

        <?php
        include_once '../../Base/nav.php';
        ?>
        <br>
        <div class = "row">
            <div class = "col s8 card offset-s2">
                <center><h4>Cadastre o aluno</h4></center>
                <form id="formulario" class = "center" method = "post" action = "../../Controle/usuarioPDO.php?function=inserirAluno" name = "formulario-cadastro-aluno">
                    <div class = "col s12">
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "nome" required="true">
                            <label for = "nome">Nome</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "usuario" required="true" id="usuario">
                            <label for = "usuario" id="lusuario">Login</label>
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
                            <input class = "input-field" type = "text" name = "cep" required="true" id="cep">
                            <label for = "cep">CEP</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "telefone" required="true" id="telefone"> 
                            <label for = "telefone">Telefone</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field validate" type = "email" name = "email" required="true" id="email">
                            <label for = "email" id="lemail">E-mail</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "date" type = "text" name = "data_associacao" required="true">
                            <label for = "data_nasc">Data de associação</label>
                        </div>
                        <div class = "input-field col s6">
                            <select name = "id_curso" required="true">
                                <option value="0">Selecione o curso</option>
                                <?php
                                include_once '../../Controle/cursoPDO.php';
                                include_once '../../Modelo/curso.php';
                                $cursoPDO = new cursoPDO();
                                $resultado = $cursoPDO->selectTudo();
                                if ($resultado) {
                                    while ($linha = $resultado->fetch()) {
                                        $curso = new curso($linha);
                                        echo "<option value='" . $curso->getId() . "'>" . $curso->getNome() ." (".$curso->getTurno().")". "</option>";
                                    }
                                }else{
                                    echo "<option value='0'>Nenhum curso cadastrado!</option>";
                                }
                                ?>
                            </select>
                            <label for = "id_curso">Curso</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "date" type = "text" name = "data_inicio" required="true">
                            <label for = "data_nasc">Data de início do Curso</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "date" type = "text" name = "previsao_conclusao" required="true">
                            <label for = "previsao_conclusao">Data de conclusão de curso</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "date" type = "text" name = "data_nasc" required="true">
                            <label for = "data_nasc">Data de nascimento</label>
                        </div>

                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "cpf" required="true" id="cpf">
                            <label for = "cpf" id="lcpf">CPF</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" type = "text" name = "rg" required="true" id="rg">
                            <label for = "rg" id="lrg">RG</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" id="senha1" type = "password" name = "senha1" required="true">
                            <label for = "senha1" id="lsenha1">Senha</label>
                        </div>
                        <div class = "input-field col s6">
                            <input class = "input-field" id="senha2" type = "password" name = "senha2" required="true">
                            <label for = "senha2" id="lsenha2">Confirme a senha</label>
                        </div>

                        <?php include_once '../../Base/msgSaida.php'; ?>

                        <div class="row">
                            <div class="col s12">
                                <?php
                                include_once '../../Modelo/usuario.php';

                                if (isset($_SESSION['usuario'])) {
                                    $usuario = new usuario(unserialize($_SESSION['usuario']));
                                    ?>
                                <a href = "../Sistema/home.php" class = "btn hoverable corcancelar">Cancelar</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="../../index.php" class="btn hoverable corcancelar">Cancelar</a>
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
        <script src="../../js/mascaras.js"></script>
        <script>
            $(document).ready(function () {
                $('select').formSelect();
                $('.date').mask("00/00/0000");
                $('#cpf').mask("000.000.000-00");
                $('#telefone').mask("(00) 00000-0000");
                $('#cep').mask("00000-000");
            });
        </script>
        <script src="../../js/verificaSenha.js" type="text/javascript"></script>
        <script src="../../js/verificaFormulario.js" type="text/javascript"></script>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>