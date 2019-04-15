<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <?php
        include_once '../Base/header.php';
        ?>

    </head>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        include_once '../Modelo/usuario.php';
        $logado = new usuario();
        $logado = unserialize($_SESSION['usuario']);
        ?>


        <div class="row">
            <!--            <div class="col s6">
                            <div class="row">
                                <div class="card col s10 offset-s1">
                                    <div class="row">
                                        aaa
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>

                    <div class="card col s10 offset-s1 center">
                        <div class="col s6">
                            <div class="row">
                                <br>
                                <br>
                                <img src="../Img/user_icon.png" height="100px" width="100px">
                                <form action="../Controle/proc_cad_img.php" method="post">
                                    <label>Nome: </label>
                                    <input type="text" name="nome" placeholder="Digitar o nome: "><br><br>

                                    <label>Imagem: </label>
                                    <input type="file" name="imagem"><br><br>

                                    <input name="SendCadImg" type="submit" value="Cadastrar">
                                    <!--<div>
                                        <label>Nome: </label>
                                        <input type="text" class="input-field" name="nome">
                                    </div>
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" name="imagem"><br><br>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn corpadrao" name="SendCadImg">Adicionar</button>
                                        </div>
                                    </div>
                                    -->
                                </form>

                                <div class="row"></div>
                                <h5><?php echo $logado->getNome(); ?></h5>
                                <span>RG: <?php echo $logado->getRg(); ?></span><br>
                                <span>CPF: <?php echo $logado->getCpf(); ?></span><br>
                                <span>CEP: <?php echo $logado->getCep(); ?></span><br>
                                <span>Cidade: <?php echo $logado->getCidade(); ?></span><br>
                                <span>Bairro: <?php echo $logado->getBairro(); ?></span><br>
                                <span>Rua: <?php echo $logado->getRua(); ?></span><br>
                                <span>Número: <?php echo $logado->getNumero(); ?></span><br>
                            </div>

                        </div>

                        <div class="col s6">
                            <br>
                            <br>
                            <h5>Ultimas movimentações</h5>
                            <br>
                            <div class="left-align offset-s3">
                                Escrever como indica o padrão<br>
                                Abril: -R$200,00 BTN (pagar)<br>
                                Março: R$200,00 pago<br>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
