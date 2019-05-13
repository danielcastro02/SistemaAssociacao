<?php
//esta TELA "verificará" se o responsável já esta cadastrado -- busca por RG ou CPF(escolher)
//nota: Falar com Daniel


if (!isset($_SESSION)) {
    session_start();
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
        <main>
            <br>
            <div class = "row">
                <div class = "col s6 card offset-s3">
                    <center><h5>Informe o RG do reponsável.<br>Buscaremos em nossa base de dados para verificar o cadastro.</h5></center>
                    <br>
                    input busca por RG <br>
                    BTN cancelar - BTN Buscar
                    <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == naoEncontrado) {
                            //html usuário não encntrado
                        }
                    }
                    ?>
                    <form class = "center" method = "post" action = "../Controle/usuarioPDO.php?function=inserirUsuario&user=aluno" name = "formulario-cadastro-aluno">

                    </form>
                </div>
                <div class="col s3"></div>
            </div>
        </main>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>