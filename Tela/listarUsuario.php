<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Modelo/usuario.php';
if (isset($_SESSION['usuario'])) {
    $logado = new usuario();
    $logado = unserialize($_SESSION['usuario']);
    if ($logado->getAdministrador() == 'false') {
        header('location: ./acessoNegado.php');
    }
} else {
    header('location: ./login.php');
}
?>
<!DOCTYPE html>
<html>
    <header>
        <?php
        include_once '../Base/header.php';
        ?>
    </header>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        ?>
        <div class="row ">
            <!--<div class="col s2"></div>-->
            <br>
            <div class="col s8 offset-s2 card">
                <h5 class="center">Lista de usuários cadastrados</h5>

                <div class="row center">
                    <form method="post" action="./listarUsuario.php" class="col s10 offset-s1 input-field">
                        <table>
                            <tr>
                                <td>
                                    <div class="input-field col s12 center">
                                        <select name="select" id="select">
                                            <option value="todosUsers">Todos</option>
                                            <option value="nomeTodos">Nome/todos</option>
                                            <option value="apenaAlunos">Apenas alunos</option>
                                            <option value="rgUser">RG</option>
                                            <option value="cpfUser">CPF</option>
                                            <option value="cursoUser">Curso</option>
                                            <option value="membrosAtivos">Membros ativos</option>
                                            <option value="membrosInativos">Membros inativos</option>
                                            <option value="membrosDiretoria">Membros da diretoria</option>
                                            <option value="admin">Administradores</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field col s12 center">
                                        <input id="" class="input-field col s12" type="text" name="pesquisar">
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
                    include_once '../Controle/usuarioPDO.php';
                    $usuarioListar = new usuarioPDO();
                    if (isset($_POST['pesquisar'])) {
//                      $sql = false;  // não usar aqui -- colocar no fim
                        $pesquisa = $_POST['pesquisar'];
                        if ($_POST['select'] == 'nomeUser') {  //esse if é desnecessário, mas ainda não vou exclui-lo. Posso usa-lo depois.
                            $sql = $usuarioListar->pesquisarUsuariosPorNome($pesquisa);
                        } else {
                            if ($_POST['select'] == 'rgUser') {
//                                $pesquisa = $_POST['pesquisar'];
                                $sql = $usuarioListar->pesquisarUsuariosPorRG($pesquisa);
                            } else {
                                if ($_POST['select'] == 'cpfUser') {
//                                    $pesquisa = $_POST['pesquisar'];
                                    $sql = $usuarioListar->pesquisarUsuariosPorCPF($pesquisa);
                                } else {
                                    if ($_POST['select'] == 'cursoUser') {
//                                        $pesquisa = $_POST['pesquisar'];
                                        $sql = $usuarioListar->pesquisarUsuariosPorCurso($pesquisa);
                                    } else {
                                        if ($_POST['select'] == 'todosUsers') {
                                            $sql = $usuarioListar->litarUsuarios();
                                        } else {
                                            if ($_POST['select'] == 'membrosAtivos') {
                                                $sql = $usuarioListar->pesquisarUsuariosAtivos($pesquisa);
                                            } else {
                                                if ($_POST['select'] == 'membrosInativos') {
                                                    $sql = $usuarioListar->pesquisarUsuariosInativos($pesquisa);
                                                } else {
                                                    if ($_POST['select'] == 'membrosDiretoria') {
                                                        $sql = $usuarioListar->pesquisarUsuariosDaDiretoria($pesquisa);
                                                    } else {
                                                        if ($_POST['select'] == 'admin') {
                                                            $sql = $usuarioListar->pesquisarUsuariosAdministradores($pesquisa);
                                                        } else {
                                                            if ($_POST['select'] == 'nomeTodos') {
                                                                $sql = $usuarioListar->pesquisarUsuariosPorNome($pesquisa);
                                                            } else {
                                                                if ($_POST['select'] == 'apenaAlunos') {
                                                                    $sql = $usuarioListar->pesquisarUsuariosAluno($pesquisa);
                                                                } else {
                                                                    $sql = false;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
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
                            echo "<tr>";
                            echo "<td>" . $resultado['nome'] . "</td>";
                            echo "<td>" . $resultado['usuario'] . "</td>";
                            echo "<td>" . $resultado['cpf'] . "</td>";
                            echo "<td>" . $resultado['telefone'] . "</td>";

//                        -----------------------------------------------------------
                            if (($resultado['pode_logar'] == 'true')) {
                                echo "<td>";
                                ?><a class="btn corpadrao" href="../Controle/usuarioPDO.php?function=tornarUsuarioInativo&id=
                                   <?php echo $resultado['id'] ?>">Ativo</a>
                                   <?php
                                   echo "</td>";
                               } else {
                                   echo "<td>";
                                   ?>
                                <a class="btn red darken-2" href="../Controle/usuarioPDO.php?function=tornarUsuarioAtivo&id=
                                   <?php echo $resultado['id'] ?>">Inativo</a><?php
                                   echo "</td>";
                               }
//                        -----------------------------------------------------------


                           echo "<td>";
                           ?><a class="btn corpadrao" href="./verMais.php?id=<?php echo $resultado['id'];?>">Ver mais</a><?php
                        echo "</td>";
                        echo "</tr>"; 
                        }
                    } else {
                        echo "<tr><td><h6>Nenhum resultado econtrado</h6></td></tr>";

                    }
                    ?>
                </table>
            </div>
            <div class="col s2"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
                $('select').formSelect();
                //                var botao = document.getElementById("btn-pesquisar");
                //                botao.addEventListener('click',function (){
                //                    if(var escolha = document.getElementById("select"));
                //                    escolha.addEventListener('click', function (){
                //                        escolha.required="false"
                //                    })
                //                })
            });
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>