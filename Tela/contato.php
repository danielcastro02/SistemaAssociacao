<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        ?>

        <main id="main">
            <div class="row">
                <div style="height: 10vh;"></div>
                <div class="col s8 offset-s2 card center " style="padding-top: 10px;">
                    <div class="row">
                        <form class="col s10 offset-s1" action="../Controle/sistemaPDO.php?function=<?php echo isset($_GET['msg']) ? $_GET['msg'] == 'acessoNegado' ? 'acessoNegado' : 'contato' : 'contato'; ?>" method="post">
                            <?php
                            if (isset($_GET['msg'])) {
                                if ($_GET["msg"] == 'acessoNegado') {
                                    ?>
                                    <h5>Por favor informe os dados a seguir para resolvermos a situação.</h5>
                                    <div class="row">
                                        <div class="input-field col s4">
                                            <input class="input-field" type="text" name="nome" id="nome"/>
                                            <label for="nome">Nome</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input class="input-field" type="text" name="cpf" id="cpf"/>
                                            <label for="cpf">CPF</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input type="text" class="input-field" name="email" id="email"/>
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea class="materialize-textarea" name="descricao" id="descricao"></textarea>
                                            <label for="descricao">Descrição breve do problema.</label>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    nao();
                                }
                            } else {
                                nao();
                            }

                            function nao() {
                                ?>
                                <h5>Por favor informe os dados a seguir para entrar em contato conosco!</h5>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input class="input-field" type="text" name="nome" id="nome"/>
                                        <label for="nome">Nome</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input class="input-field" type="text" name="cpf" id="cpf"/>
                                        <label for="cpf">CPF</label>
                                    </div>
                                    <div class="col s6 input-field">
                                        <input type="text" class="input-field" name="email" id="email"/>
                                        <label for="email">E-mail</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="motivo">
                                            <option value="bug">Erro no Sistema</option>
                                            <option value="critica">Criticas</option>
                                            <option value="sugestao">Sugestões</option>
                                            <option value="problema">Problema específico</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea class="materialize-textarea" name="descricao" id="descricao"></textarea>
                                        <label for="descricao">Descrição breve do problema.</label>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                                <a class="btn corcancelar" href="../Tela/home.php">Cancelar</a>
                                <button class="btn corpadrao">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('select').formSelect();
                });
            </script>
        </main>
<?php include_once '../Base/footer.php'; ?>
    </body>
</html>
