<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="collapsible.html">JavaScript</a></li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <div class="col s3"></div>
            <div class="col s6">
                <center><h4>Cadastro de alunos</h4></center>
                <form method="get" action="../Controle/usuarioDAO.php" name="formulario-cadastro-aluno">
                    <div class="input-field col s6">
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="nome">
                            <label for="nome">Nome completo</label>
                        </div>
                       
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="cidade">
                            <label for="cidade">Cidade</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="rua">
                            <label for="rua">Rua</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="cpf">
                            <label for="cpf">CPF</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>
                       
                        <div class="input-field col s12">

                        </div>
                    </div>
                    <div class="input-field col s6">
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="login">
                            <label for="login">Login</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="bairro">
                            <label for="bairro">Bairro</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="numero">
                            <label for="numero">Número da casa</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="rg">
                            <label for="rg">RG</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <input class="input-field" type="text" name="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="input-field col s12">

                        </div>
                    </div>  
                </form>
            </div>
            <div class="col s3"></div>
        </div>
    </div>
</body>
</html>

