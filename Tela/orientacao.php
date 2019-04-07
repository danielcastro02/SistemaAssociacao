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
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'sucessoAluno') {
                ?>
                aluno cadastrado com sucesso - Maior de idade
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
        } else {
            header("Location: ../index.php");
        }
        ?>

    </body>
</html>