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
            } else {
                $usuario = new usuario();
                $usuario = $usuarioPDO->selectUsuarioPorId($_GET['id']);
                $aluno = new aluno();
                $aluno = $usuarioPDO->selectAlunoPorId($_GET['id']);
                $diretoria = new diretoria();
                $diretoria = $usuarioPDO->selectDiretoriaPorId($_GET['id']);
                if (!$usuario) {
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
                    <div class="card col s10 offset-s1 left">
                        <div class="col s12">
                            <div class="row">
                                <div class="col s12">
                                    <div  class="fotoPerfil" style='background-image: url("<?php echo $usuario->getFotoPerfil(); ?>");
                                          background-size: cover;
                                          background-position: center;
                                          background-repeat: no-repeat;
                                          margin-top: 10px;'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="center">
                                    <h5><?php echo $usuario->getNome(); ?></h5>
                                </div>
                                <div class="col s4">
                                    <br>
                                    <div class="row"></div>
                                    <span><b>Dados Gerais</b></span><br>

                                    <span>RG: <?php echo $usuario->getRg(); ?></span><br>
                                    <span>CPF: <?php echo $usuario->getCpf(); ?></span><br>
                                    <span>CEP: <?php echo $usuario->getCep(); ?></span><br>
                                    <span>Cidade: <?php echo $usuario->getCidade(); ?></span><br>
                                    <span>Bairro: <?php echo $usuario->getBairro(); ?></span><br>
                                    <span>Rua: <?php echo $usuario->getRua(); ?></span><br>
                                    <span>Número: <?php echo $usuario->getNumero(); ?></span><br>
                                </div>
                                <div class="col s4">
                                    <br>
                                    <div class="row"></div>
                                    <span><b>Dados Curso</b></span><br>
                                    <?php if ($aluno) { ?>
                                        <span>Curso: <?php echo $aluno->getCurso(); ?></span><br>
                                        <span>Previsão de Conclusão: <?php echo $aluno->getPrevisao_conclusao(); ?></span><br>
                                        <span>Saldo: <?php echo $aluno->getSaldo(); ?></span><br>
                                        <?php
                                        if ($aluno->getId_responsavel() != '') {
                                            $responsavel = new usuario();
                                            $responsavel = $usuarioPDO->selectUsuarioPorId($aluno->getId_responsavel());
                                            ?>
                                        <span><b>Dados do responsável:</b></span><br>
                                            <span>Nome: <?php echo $responsavel->getNome(); ?></span><br>
                                            <span>CPF: <?php echo $responsavel->getCpf(); ?></span>
                                            <?php
                                        } else {
                                            if ($usuario->getIdade() < 18) {
                                                $_SESSION['temp'] = $usuario->getId();
                                                ?>
                                                <a href="./cadastroResponsavel.php" class="btn corpadrao">Registrar Responsável</a>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?><h5>O usuário não é aluno</h5><?php
                                    }
                                    ?>
                                </div>
                                <div class="col s4">
                                    <br>
                                    <div class="row"></div>
                                    <span><b>Diretoria</b></span><br>
                                    <?php if ($diretoria) { ?>
                                        <span>Cargo: <?php echo $diretoria->getCargo(); ?></span><br>
                                    <?php } else {
                                        ?>
                                        <span>Usuário não pertence a diretoria.</span><br>
                                    <?php }
                                    ?>
                                        <br>
                                        <?php
                                        $idFilhos = $usuarioPDO->buscarFilhos($usuario->getId());
                                        if($idFilhos){
                                            ?>
                                                <span><b>Responsável por:</b></span><br>
                                                <?php
                                            while($linha = $idFilhos->fetch()){
                                                $us = new usuario();
                                                $us = $usuarioPDO->selectUsuarioPorId($linha['id_usuario']);
                                                ?>
                                                <span><?php echo $us->getNome();?></span><br>
                                                <span>CPF: <?php echo $us->getCpf();?></span><br>
                                                    <?php
                                            }
                                        }
                                        
                                        ?>
                                     
                                </div>
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
