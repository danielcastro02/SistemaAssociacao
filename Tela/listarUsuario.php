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
            <div class="col s3"></div>
            <div class="col s6">
                <br>
                <br>
                <h5 class="center">Lista de funcionários</h5>
                <table>
                    <tr>
                        <td>id</td>
                        <td>Nome</td>
                        <td>E-mail</td>
                        <td>Cargo</td>
                    </tr>
                    <?php
                    include_once '../Controle/funcionarioPDO.php';
                    $function = new funcionarioPDO();
                    $sql = $function->listar();
					
					
					
                    while ($resultado = $sql->fetch()) {
                        echo "<tr>";
                        echo "<td>".$resultado['id']."</td>";
                        echo "<td>".$resultado['nome']."</td>";
                        echo "<td>".$resultado['email']."</td>";
                        echo "<td>".$resultado['cargo']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col s3"></div>
        </div>
    </body>
</html>