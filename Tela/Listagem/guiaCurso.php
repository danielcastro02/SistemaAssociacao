<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../Modelo/usuario.php';
if (isset($_SESSION['usuario'])) {
    $logado = new usuario();
    $logado = unserialize($_SESSION['usuario']);
    if ($logado->getAdministrador() == 'false') {
        header('location: ../Sistema/acessoNegado.php');
    }
} else {
    header('location: ../Sistema/login.php');
}
include_once '../../Modelo/curso.php';
include_once '../../Controle/cursoPDO.php';
?>
<!DOCTYPE html>
<html>
    <header>
        <?php
        include_once '../../Base/header.php';
        ?>
    </header>
    <body class="homeimg">

        <?php
        include_once '../../Base/nav.php';
        ?>
        <main>
            <div class="row">
                <div class="col s10 offset-s1 ">
                    <ul class="collapsible card grey lighten-2">
                        <li>
                            <div class="collapsible-header">
                                Diurno
                            </div>
                            <div class="collapsible-body">
                                <?php
                                $cursoPDO = new cursoPDO();

                                $resultadoManha = $cursoPDO->selectPorTurno('Diurno');
                                if ($resultadoManha) {
                                    ?>
                                    <ul class="collapsible">
                                        <?php
                                        while ($linha = $resultadoManha->fetch()) {
                                            $curso = new curso($linha);
                                            ?>
                                            <li>
                                                <div class="collapsible-header">
                                                    <?php echo $curso->getNome() . " - " . $curso->getNivel(); ?>
                                                </div>
                                                <div class="collapsible-body card white">
                                                    <?php
                                                    include_once '../../Controle/usuarioPDO.php';
                                                    $usuarioPDO = new usuarioPDO();
                                                    $alunoManha = $usuarioPDO->selectPorCurso($curso->getId());

                                                    if ($alunoManha) {
                                                        ?>
                                                    <div class="loader">
                                                        <table class="striped">
                                                            <tr>
                                                                <td>Nome</td>
                                                                <td>Usuário</td>
                                                                <td>CPF</td>
                                                                <td>Telefone</td>
                                                                <td>Status</td>
                                                                <td></td>
                                                            </tr>
                                                            <?php
                                                            while ($linhaAlunoManha = $alunoManha->fetch()) {
                                                                $us = new usuario($linhaAlunoManha);
                                                                echo "<tr>";
                                                                echo "<td>" . $us->getNome() . "</td>";
                                                                echo "<td>" . $us->getUsuario() . "</td>";
                                                                echo "<td>" . $us->getCpf() . "</td>";
                                                                echo "<td>" . $us->getTelefone() . "</td>";

                                                                if (($us->getPode_logar() == 'true')) {
                                                                    echo "<td>";
                                                                    ?><input type="button" class="btn corpadrao ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioInativo&id=
                                                                       <?php echo $us->getId(); ?>" value="Ativo" pesquisa="select=selectPorCurso&pesquisa=<?php$curso->getId();?>">
                                                                       <?php
                                                                       echo "</td>";
                                                                   } else {
                                                                       echo "<td>";
                                                                       ?>
                                                                    <input type="button" class="btn red darken-2 ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioAtivo&id=
                                                                       <?php echo $us->getId(); ?>" value="Inativo"><?php
                                                                       echo "</td>";
                                                                   }


                                                                   echo "<td>";
                                                                   ?><a class="btn corpadrao" href="./verMais.php?id=<?php echo $us->getId(); ?>">Ver mais</a><?php
                                                                echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                    </div>

                                                </div>
                                            </li><?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                } else {
                                    echo 'Nenhum curso encontrado.';
                                }
                                ?>
                            </div>
                        </li>
                        
                        <li>
                            <div class="collapsible-header">
                                Noturno
                            </div>
                            <div class="collapsible-body">
                                <?php
                                $cursoPDO = new cursoPDO();

                                $resultadoNoite = $cursoPDO->selectPorTurno('Noturno');
                                if ($resultadoNoite) {
                                    ?>
                                    <ul class="collapsible card white">
                                        <?php
                                        while ($linha = $resultadoNoite->fetch()) {
                                            $curso = new curso($linha);
                                            ?>
                                            <li>
                                                <div class="collapsible-header">
                                                    <?php echo $curso->getNome() . " - " . $curso->getNivel(); ?>
                                                </div>
                                                <div class="collapsible-body ">
                                                    <?php
                                                    include_once '../../Controle/usuarioPDO.php';
                                                    $usuarioPDO = new usuarioPDO();
                                                    $alunoNoite = $usuarioPDO->selectPorCurso($curso->getId());

                                                    if ($alunoNoite) {
                                                        ?>
                                                        <table class="striped">
                                                            <tr>
                                                                <td>Nome</td>
                                                                <td>Usuário</td>
                                                                <td>CPF</td>
                                                                <td>Telefone</td>
                                                                <td>Status</td>
                                                                <td></td>
                                                            </tr>
                                                            <?php
                                                            while ($linhaAlunoNoite = $alunoNoite->fetch()) {
                                                                $us = new usuario($linhaAlunoNoite);
                                                                echo "<tr>";
                                                                echo "<td>" . $us->getNome() . "</td>";
                                                                echo "<td>" . $us->getUsuario() . "</td>";
                                                                echo "<td>" . $us->getCpf() . "</td>";
                                                                echo "<td>" . $us->getTelefone() . "</td>";

                                                                if (($us->getPode_logar() == 'true')) {
                                                                    echo "<td>";
                                                                    ?><input type="button" class="btn corpadrao ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioInativo&id=
                                                                       <?php echo $us->getId(); ?>" value="Ativo" pesquisa="select=selectPorCurso&pesquisa=<?php$curso->getId();?>">
                                                                       <?php
                                                                       echo "</td>";
                                                                   } else {
                                                                       echo "<td>";
                                                                       ?>
                                                                    <input type="button" class="btn red darken-2 ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioAtivo&id=
                                                                       <?php echo $us->getId(); ?>" value="Inativo" pesquisa="select=selectPorCurso&pesquisa=<?php$curso->getId();?>"><?php
                                                                       echo "</td>";
                                                                   }


                                                                   echo "<td>";
                                                                   ?><a class="btn corpadrao" href="./verMais.php?id=<?php echo $us->getId(); ?>">Ver mais</a><?php
                                                                echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </li><?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                } else {
                                    echo 'Nenhum curso encontrado.';
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </main> 
        <?php include_once '../../Base/footer.php'; ?>
    </body>
    <script>
        $(document).ready(function () {
            $(".collapsible").collapsible();
        });
    </script>
    <script src="../../js/ativoInativo.js" type="text/javascript"></script>
</html>