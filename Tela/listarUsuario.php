<!DOCTYPE html>
<html>
    <header>
        <?php
        include_once '../Base/header.php';
        ?>
    </header>
    <body>



        <?php
        include_once '../Base/nav.php';
        ?>
        <div class="row">
            <!--<div class="col s2"></div>-->
            <div class="col s8 offset-l2">
                <br>
                <br>
                <h5 class="center">Lista de usuários cadastrados</h5>

                <div class="row center">
                    <form method="post" action="../Controle/usuarioPDO.php?function=litarUsuarios" class="col s8 input-field">
                        <table>
                            <tr>
                                <td>
                                    <div class="input-field col s12 ">
                                        <input required="true"  class="input-field" type="text" name="pesquisar">
                                        <label for="pesquisar">Informe o nome</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="col s2">
                                        <input type="submit" class="btn corpadrao inline" value="Pesquisar">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <table>
                    <tr>
                        <td>Nome</td>
                        <td>Usuário</td>
                        <td>CPF</td>
                        <td>Telefone</td>
                    </tr>
                    <?php
                    include_once '../Controle/usuarioPDO.php';
                    $usuarioListar = new usuarioPDO();

                    if (isset($_POST['pesquisar'])) {
                        $sql = $usuarioListar->litarUsuarios();
                    } else {
                        $sql = $usuarioListar->litarUsuarios();
                    }


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
                           ?><a class="btn corpadrao" href="#">Ver mais</a><?php
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col s2"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('.datepicker').datepicker({format: 'dd-mm-yyyy'});
            });
        </script>
    </body>
</html>