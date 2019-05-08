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
                                Manha
                            </div>
                            <div class="collapsible-body">
                                <?php
                                $cursoPDO = new cursoPDO();

                                $resultadoManha = $cursoPDO->selectPorTurno('Manha');
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
                                                            while ($linhaAlunoManha = $aluno->fetch()) {
                                                                $us = new usuario($linhaAlunoManha);
                                                                echo "<tr>";
                                                                echo "<td>" . $us->getNome() . "</td>";
                                                                echo "<td>" . $us->getUsuario() . "</td>";
                                                                echo "<td>" . $us->getCpf() . "</td>";
                                                                echo "<td>" . $us->getTelefone() . "</td>";

                                                                if (($us->getAdministrador() == 'true')) {
                                                                    echo "<td>";
                                                                    ?><a class="btn corpadrao" href="../../Controle/usuarioPDO.php?function=tornarUsuarioInativo&id=
                                                                       <?php echo $us->getId(); ?>">Ativo</a>
                                                                       <?php
                                                                       echo "</td>";
                                                                   } else {
                                                                       echo "<td>";
                                                                       ?>
                                                                    <a class="btn red darken-2" href="../../Controle/usuarioPDO.php?function=tornarUsuarioAtivo&id=
                                                                       <?php echo $us->getId(); ?>">Inativo</a><?php
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
                        <li>
                            <div class="collapsible-header">
                                Tarde
                            </div>
                            <div class="collapsible-body">
                                <?php
                                $cursoPDO = new cursoPDO();

                                $resultadoTarde = $cursoPDO->selectPorTurno('Tarde');
                                if ($resultadoTarde) {
                                    ?>
                                    <ul class="collapsible card">
                                        <?php
                                        while ($linha = $resultadoTarde->fetch()) {
                                            $curso = new curso($linha);
                                            ?>
                                            <li>
                                                <div class="collapsible-header">
                                                    <?php echo $curso->getNome() . " - " . $curso->getNivel(); ?>
                                                </div>
                                                <div class="collapsible-body">
                                                    <?php
                                                    include_once '../../Controle/usuarioPDO.php';
                                                    $usuarioPDO = new usuarioPDO();
                                                    $alunoTarde = $usuarioPDO->selectPorCurso($curso->getId());

                                                    if ($alunoTarde) {
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
                                                            while ($linhaAlunoTarde = $alunoTarde->fetch()) {
                                                                $us = new usuario($linhaAlunoTarde);
                                                                echo "<tr>";
                                                                echo "<td>" . $us->getNome() . "</td>";
                                                                echo "<td>" . $us->getUsuario() . "</td>";
                                                                echo "<td>" . $us->getCpf() . "</td>";
                                                                echo "<td>" . $us->getTelefone() . "</td>";

                                                                if (($us->getAdministrador() == 'true')) {
                                                                    echo "<td>";
                                                                    ?><a class="btn corpadrao" href="../../Controle/usuarioPDO.php?function=tornarUsuarioInativo&id=
                                                                       <?php echo $us->getId(); ?>">Ativo</a>
                                                                       <?php
                                                                       echo "</td>";
                                                                   } else {
                                                                       echo "<td>";
                                                                       ?>
                                                                    <a class="btn red darken-2" href="../../Controle/usuarioPDO.php?function=tornarUsuarioAtivo&id=
                                                                       <?php echo $us->getId(); ?>">Inativo</a><?php
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
                        <li>
                            <div class="collapsible-header">
                                Noite
                            </div>
                            <div class="collapsible-body">
                                <?php
                                $cursoPDO = new cursoPDO();

                                $resultadoNoite = $cursoPDO->selectPorTurno('Noite');
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

                                                                if (($us->getAdministrador() == 'true')) {
                                                                    echo "<td>";
                                                                    ?><a class="btn corpadrao" href="../../Controle/usuarioPDO.php?function=tornarUsuarioInativo&id=
                                                                       <?php echo $us->getId(); ?>">Ativo</a>
                                                                       <?php
                                                                       echo "</td>";
                                                                   } else {
                                                                       echo "<td>";
                                                                       ?>
                                                                    <a class="btn red darken-2" href="../../Controle/usuarioPDO.php?function=tornarUsuarioAtivo&id=
                                                                       <?php echo $us->getId(); ?>">Inativo</a><?php
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
</html>