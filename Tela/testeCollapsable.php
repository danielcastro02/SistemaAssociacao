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
        <title>Reclamações</title>
    </header>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        ?>
        <div class="row ">
            <br>
            <div class="col s8 offset-s2 card">
                <h5 class="center">Lista de Reclamações</h5>

                <table class="striped">
                    <tr>
                        <td>Nome</td>
                        <td>CPF</td>
                        <td>E-mail</td>
                        <td></td>
                    </tr>
                    <?php
                    include_once '../Controle/usuarioPDO.php';
                    include_once '../Controle/sistemaPDO.php';
                    $usuarioListar = new usuarioPDO();
                    $sistema = new sistemaPDO();
                    $sql = $sistema->selectContatos();
                    if ($sql != false) {

                        while ($resultado = $sql->fetch()) {
                            $resultadoNome = $resultado['nome'];
                            $resultadoCpf = $resultado['cpf'];
                            $resultadoEmail = $resultado['email'];
                            $resultadoMotivo = $resultado['motivo'];
                            $resultadoDescricao = $resultado['descricao'];
                            echo "<tr>";
                            echo "<td>" . $resultado['nome'] . "</td>";
                            echo "<td>" . $resultado['cpf'] . "</td>";
                            echo "<td>" . $resultado['email'] . "</td>";

                            echo "</tr>";
                            ?>
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">filter_drama</i><?php echo $resultadoNome; ?></div>
                                    <div class="collapsible-body"><span>Motivo: <?php echo $resultadoMotivo; ?></span><br>
                                        <span>Descrição: <?php echo $resultadoDescricao; ?></span></div>
                                </li>
                            </ul>
                            <?php
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
            document.addEventListener('DOMContentLoaded', function () {
                var elems = document.querySelectorAll('.collapsible');
                var instances = M.Collapsible.init(elems, options);
            });

            // Or with jQuery

            $(document).ready(function () {
                $('.collapsible').collapsible();
            });
        </script>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>