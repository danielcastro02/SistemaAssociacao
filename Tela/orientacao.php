<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
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
                        <h5>Aluno cadastrado com sucesso.</h5>
                        <br>
                        <a class="btn hoverable corpadrao" href="../Tela/home.php">Tela inicial</a>
                        <a class="btn hoverable corpadrao" href="../Tela/cadastroAluno.php">Cadastrar +</a>
                    </div>
                    <?php
                } else {
                    if ($_GET['msg'] == 'sucessoAlunoRequerimento') {
                        ?>
                        aluno menor de idade cadastrado com sucesso - Deseja cadastrar um responsável?
                        <?php
                    } else {
                        if ($_GET['msg'] == 'cadastrarResponsavel') {
                            ?>
                            Form cadastro de responsáveel
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>

    </body>
</html>