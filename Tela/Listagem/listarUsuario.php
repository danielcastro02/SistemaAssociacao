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
        <div class="row ">
            <!--<div class="col s2"></div>-->
            <br>
            <div class="col s8 offset-s2 card">
                <h5 class="center">Lista de usuários cadastrados</h5>

                <div class="row center">
                    <form method="post" action="./listarUsuario.php" id="formulario" class="col s10 offset-s1 input-field">
                        <table>
                            <tr>
                                <td>
                                    <div class="input-field col s12 center">
                                        <select name="select" id="select">
                                            <option value="selectTodosUsers">Todos</option>
                                            <option value="selectMembrosAtivos">Membros ativos</option>
                                            <option value="selectMembrosInativos">Membros inativos</option>
                                            <option value="selectMembrosDiretoria">Membros da diretoria</option>
                                            <option value="selectAdmin">Administradores</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field col s12 center">
                                        <input id="pesquisa" class="input-field col s12" type="text" name="pesquisar">
                                        <label for="pesquisar">Pesquise</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="col s12">
                                        <input type="submit" id="btn-pesquisar" class="btn corpadrao inline" value="Pesquisar">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="tabela">
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
                        include_once '../../Controle/usuarioPDO.php';
                        include_once '../../Modelo/usuario.php';
                        $usuarioListar = new usuarioPDO();
                        if (isset($_POST['pesquisar'])) {
                            $pesquisa = $_POST['pesquisar'];
                            $metodo = $_POST['select'];
                            $sql = $usuarioListar->$metodo($pesquisa);
                        } else {
                            $sql = $usuarioListar->litarUsuarios();
                        }
                        if (isset($_POST['pesquisar'])) {
                            if ($_POST['select'] == 'todosUsers') {
                                ?>
                                <div class="center alerta_vermelho">
                                    <h6><?php echo "Pesquisa realizada: Todos os usuários<br>"; ?></h6>
                                </div>
                                <?php
                            } else {
                                $saida = $_POST['pesquisar'];
                                ?>
                                <div class="center alerta_vermelho">
                                    <h6><?php echo "Pesquisa realizada: $saida<br>"; ?></h6>
                                </div>
                                <?php
                            }
                            ?> 

                            <br> 

                            <?php
                        }
                        if ($sql != false) {

                            while ($resultado = $sql->fetch()) {
                                $us = new usuario($resultado);
                                echo "<tr>";
                                echo "<td>" . $us->getNome() . "</td>";
                                echo "<td>" . $us->getUsuario() . "</td>";
                                echo "<td>" . $us->getCpf() . "</td>";
                                echo "<td>" . $us->getTelefone() . "</td>";

//                        -----------------------------------------------------------
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
//                        -----------------------------------------------------------


                                   echo "<td>";
                                   ?><a class="btn corpadrao" href="./verMais.php?id=<?php echo $us->getId(); ?>">Ver mais</a><?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td><h6>Nenhum resultado econtrado</h6></td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col s2"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('select').formSelect();
                $('#select').change(atualiza);
                $('#pesquisa').keyup(atualiza);
                function atualiza() {
                    var dados = $('#formulario').serialize();
                    $('#tabela').load("./ListagemUsuario/tabelaDinamica.php", dados);
                }
            });
        </script>
        <?php include_once '../../Base/footer.php'; ?>
    </body>
</html>