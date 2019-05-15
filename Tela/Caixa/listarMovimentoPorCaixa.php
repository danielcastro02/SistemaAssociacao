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
                if ($datas) {
            ?>
            <div class="row">
                <div class = "col s10 card offset-s1">
                    <center><h4>Movimentações</h4></center>
                    <table>
                        <tr>
                            <th></th>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Entrada</th>
                            <th>Saida</th>
                            <th>Saldo</th>
                        </tr>
                    </table>
                    <ul class="collapsible">
                        <?php while ($data = $datas->fetch()) {
                            $movimento = new movimento($data);
                            $entrada = $movimentoPDO->somaEntradasNoDia($movimento->getData_movimento());
                            $saida = $movimentoPDO->somaSaidasNoDia($movimento->getData_movimento());
                            $saldo = $entrada - $saida;
                        ?>
                        <li>
                            <div class="collapsible-header">
                                <table>
                                    <tr>
                                        <td style="width: 18%"> <?= $movimento->getData_movimento() ?></td>
                                        <td style="width: 27%"> Teste </td>
                                        <td style="width: 22%"> <?= $entrada ?> R$</td>
                                        <td style="width: 17%"> <?= $saida ?> R$</td>
                                        <td> <?= $saldo ?> R$</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="collapsible-body">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Valor</th>
                                            <th>Saldo movimentado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dados = $movimentoPDO->selectPorData($movimento->getData_movimento());
                                            while ($dado = $dados->fetch()) {
                                                $movimento = new movimento($dado);
                                            ?>
                                        <tr>
                                            <td><?php
                                                    include_once '../../Controle/tipo_movimentoPDO.php';
                                                    $tipo_movimentoPDO = new tipo_movimentoPDO();
                                                    $tipo_movimento = $tipo_movimentoPDO->selectPorID($movimento->getId_tipo_ref());
                                                    while ($item =  $tipo_movimento->fetch()) {
                                                        $tmo = new tipo_movimento($item);
                                                        echo $tmo->getNome_movimento();
                                                    }
                                                ?></td>
                                            <td><?php
                                                    include_once '../../Controle/usuarioPDO.php';
                                                    $usuarioPDO = new usuarioPDO();
                                                    $usuarios = $usuarioPDO->selectUsuarioPorId($movimento->getId_usuario_ref());
                                                    echo $usuarios->getNome();
                                                ?></td>
                                            <td><?= $movimento->getValor() ?></td>
                                            <td><?= $movimento->getSaldo_movimento() ?></td>
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
