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
        <?php include_once '../Base/navBar.php'; ?>
        <br>
        <div class="row">
            <div class="col s6 card offset-s3">
                <div class="center">
                    <br>
                    <br>
                    <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'menorDeIdade') {
                            ?>
                            <h5>Este a luno é menor de idade, é necessário cadastrar um responsável
                                maior de idade.<br><br></h5>
                     <a href="#" class="btn">Cadastrar agora</a>
                    <a href="#" class="btn">Cadastrar depois</a>
                    <br>
                    <br>
                    <br>
                            <?php
                        } else {
                            //cadastro realizado com sucesso - redirecionar para página de orientação
                        }
                    }
                    ?>
                </div>

            </div>
            <div class="col s3"></div>
        </div>
    </body>
</html>

<?php
//
if (isset($_GET['cadastrar'])) {
    
}