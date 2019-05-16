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
        $metodo = '';
        $pesquisa = '';
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
            if (($us->getPode_logar() == 'true')) {
                echo "<td>";
                ?><input type="button" class="btn corpadrao ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioInativo&id=
                       <?php echo $us->getId(); ?>" value="Ativo" <?php if($metodo=='selectPorCurso'){echo "pesquisa = 'select=selectPorCurso&pesquisa=".$pesquisa."'";} ?>>
                       <?php
                       echo "</td>";
                   } else {
                       echo "<td>";
                       ?>
                <input type="button" class="btn red darken-2 ativoInativo" caminho="../../Controle/usuarioControle.php?function=tornarUsuarioAtivo&id=
                       <?php echo $us->getId(); ?>" value="Inativo"<?php if($metodo=='selectPorCurso'){echo "pesquisa = 'select=selectPorCurso&pesquisa=".$pesquisa."'";} ?>><?php
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
<script src="../../js/ativoInativo.js" type="text/javascript"></script>