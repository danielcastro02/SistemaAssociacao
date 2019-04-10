<?php
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
        <?php
        include_once '../Base/nav.php';
        ?>
        <div id="div-principal" class="row">
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="col s4">

            </div>
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'sucessoAluno') {
                    ?>
                    <div class="col s4 center">
                        <h5>Aluno(a) cadastrado(a) com sucesso.</h5>
                        <br>
                        <a class="btn hoverable corpadrao" href="../Tela/home.php">Tela inicial</a>
                        <a class="btn hoverable corpadrao" href="../Tela/cadastroAluno.php">Cadastrar +</a>
                    </div>
                    <?php
                } else {
                    if ($_GET['msg'] == 'sucessoAlunoRequerimento') {
                        include_once '../Controle/usuarioPDO.php';
                        $usuarioPDO = new usuarioPDO();
                        $presidente = $usuarioPDO->selectPresidente();
                        ?>
                        <div class="col s4 center">
                            <h5>Seu cadastro foi concluido com sucesso!<br>
                                Para acessar o portal aguarde a análise do adminstrador ou entre em contado com a Associação.
                            </h5>
                            <div class="row">
                                <span class="left-align col s12 ">Não se preocupe, basta entrar em contato com o presidente da associacao <?php echo $presidente['nome']; ?>
                                    para validar seus documentos...<br>Entre em contato pelo Telefone: <?php echo $presidente['telefone']; ?>, pelo E-mail: <?php echo $presidente['email']; ?>.<br>Ou diretamente no endereço:
                                    Rua, <?php echo $presidente['rua']; ?>, Bairro <?php echo $presidente['bairro']; ?>, Número  <?php echo $presidente['numero']; ?>, na cidade de <?php echo $presidente['cidade']; ?></span></div>
                            <div class="row left-align">
                                <h5 class="col s9">
                                    Isso é para a segurança de todos os nossos associados!</h5>
                                <img class="col s2" src="../Img/sintoMuito.png">
                            </div>
                            <br>
                            <a class="btn hoverable corpadrao" href="../index.php">Continuar</a>
                        </div>
                        <?php
                    } else {
                        if ($_GET['msg'] == 'cadastrarResponsavel') {
                            ?>
                            <div class="col s4 center">
                                <h5>Alunos(as) menores de idade preisam de um responsável.</h5>
                                <br>
                                <a class="btn hoverable corpadrao" href="../Tela/cadastroResponsavel.php">Cadastrar responsável</a>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>

    </body>
</html>