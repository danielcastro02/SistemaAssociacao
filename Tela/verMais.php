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
                                <div class="col s4">
                                    <br>
                                    <div class="row"></div>
                                    <h4>Dados Gerais</h4>
                                    <h5>Nome: <?php echo $usuario->getNome(); ?></h5>
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
                                    <h4>Dados Curso</h4>
                                    <?php if($aluno){ ?>
                                    <h5>Curso: <?php echo $aluno->getCurso(); ?></h5>
                                    <span>Previsão de Conclusão: <?php echo $aluno->getPrevisao_conclusao(); ?></span><br>
                                    <span>Saldo: <?php echo $aluno->getSaldoCpf(); ?></span><br>
                                    <?php
                                    if($aluno->getId_usuario()!= 'null'){
                                        $responsavel = new usuario();
                                        $responsavel = $usuarioPDO->selectUsuarioPorId($aluno->getId_usuario());
                                        ?>
                                    <h5>Dados do responsável:</h5>
                                    <span>Nome: <?php echo $responsavel->getNome(); ?></span>
                                    <span>CPF: <?php echo $responsavel->getCpf(); ?></span>
                                    <?php
                                    }
                                    
                                    }else{
                                        ?><h5>O usuário não é aluno</h5><?php
                                    }
?>
                                </div>
                                <div class="col s4">
                                    <br>
                                    <div class="row"></div>
                                    <h4>Diretoria</h4>
                                    <?php if($diretoria){ ?>
                                    <h5>Cargo: <?php echo $diretoria->getCargo(); ?></h5>
                                    <?php }else{
                                        ?>
                                    <h5>Usuário não pertence a diretoria.</h5>
                                            <?php
                                    } ?> 
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
