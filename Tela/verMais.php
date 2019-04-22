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
        include_once '../Controle/usuarioPDO.php';
        $usuarioPDO = new usuarioPDO();
        if (isset($_SESSION['usuario'])) {
            $logado = new usuario();
            $logado = unserialize($_SESSION['usuario']);
            if ($logado->getAdministrador() == 'false') {
                header('location: ./acessoNegado.php');
            }else{
                $usuario = new usuario();
                $usuario = $usuarioPDO->selectUsuarioPorId($_GET['id']);
                $aluno = $usuarioPDO->selectAlunoPorId($_GET['id']);
                $diretoria = $usuarioPDO->selectDiretoriaPorId($_GET['id']);
                if(!$usuario){
                    header('location: ./erroInterno.php');
                }
            }
        } else {
            header('location: ./login.php');
        }
        ?>


        <div class="row">
            <div class="col s12">
                <div class="row">
                    <br>
                    <br>
                    <div class="card col s10 offset-s1 center">
                        <div class="col s12">
                            <div  class="fotoPerfil" style='background-image: url("<?php echo $usuario->getFotoPerfil(); ?>");
                                                                    background-size: cover;
                                                                    background-position: center;
                                                                    background-repeat: no-repeat;'>
                                </div>
                            <div class="row">
                                <br>
                                <div class="row"></div>
                                <h5>Nome: <?php echo $usuario->getNome(); ?></h5>
                                <span>RG: <?php echo $usuario->getRg(); ?></span><br>
                                <span>CPF: <?php echo $usuario->getCpf(); ?></span><br>
                                <span>CEP: <?php echo $usuario->getCep(); ?></span><br>
                                <span>Cidade: <?php echo $usuario->getCidade(); ?></span><br>
                                <span>Bairro: <?php echo $usuario->getBairro(); ?></span><br>
                                <span>Rua: <?php echo $usuario->getRua(); ?></span><br>
                                <span>Número: <?php echo $usuario->getNumero(); ?></span><br>
                            </div>
                            <div class="row">
                                <a href="./listarUsuario.php" class="btn hoverable corpadrao">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once '../Base/footer.php'; ?>

    </body>
</html>
