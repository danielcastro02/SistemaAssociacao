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
        <?php include_once '../../Base/header.php' ?>
    </header>
    <body class="homeimg">
        <?php include_once '../../Base/nav.php'?>
        <main>
            <?php
                include_once '../../Controle/movimentoPDO.php';
                $movimentoPDO = new movimentoPDO();
                $datas = $movimentoPDO->selectTodasDatas();
                if (isset($datas)) {
            ?>
            <div class="row">
                <div class = "col s10 card offset-s1">
                    <center><h4>Movimentações</h4></center>
                    <ul class="collapsible">
                        <?php foreach ($datas as $data) {?>
                        <li>
                            <div class="collapsible-header"><?= $data['data_movimento'] ?></div>
                            <div class="collapsible-body">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Caixa</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Valor</th>
                                            <th>Saldo movimentado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $movimentos = $movimentoPDO->selectPorData($data['data_movimento']);
                                            foreach ($movimentos as $movimento) { ?>
                                        <tr>
                                            <td><?= $movimento['id_caixa_ref'] ?></td>
                                            <td><?= $movimento['id_tipo_ref'] ?></td>
                                            <td><?= $movimento['id_usuario_ref'] ?></td>
                                            <td><?= $movimento['valor'] ?></td>
                                            <td><?= $movimento['saldo_movimento'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <script>
                $(document).ready(function(){
                    $('.collapsible').collapsible();
                });
            </script>
        </main>
        <?php include_once '../../Base/footer.php'?>
    </body>
</html>
