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
    $_POST = $_GET;
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
                ?><a class="btn corpadrao" href="../Controle/usuarioPDO.php?function=tornarUsuarioInativo&id=
                   <?php echo $us->getId(); ?>">Ativo</a>
                   <?php
                   echo "</td>";
               } else {
                   echo "<td>";
                   ?>
                <a class="btn red darken-2" href="../Controle/usuarioPDO.php?function=tornarUsuarioAtivo&id=
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