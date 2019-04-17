<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body class="homeimg">

        <?php
        include_once '../Base/nav.php';
        include_once '../Controle/usuarioPDO.php';
        $usuarioPDO = new usuarioPDO();
        include_once '../Modelo/usuario.php';
        $presidente = new usuario();
        $presidente = $usuarioPDO->selectPresidente();
        ?>

        <main id="main">
            <div class="row">
                <div style="height: 15vh;"></div>
                <div class="col s6 offset-s3 card center">
                    <?php
                    if ($_GET['msg'] == 'sucessoReclamacao') {
                        ?>
                        <h5>Os administradores do sistema já foram notificadose analizarão a sua solicitação, por favor aguarde contato.</h5>

                        <?php
                    }
                    if ($_GET['msg'] == 'erroReclamacao') {
                        ?>
                        <h5>Algo saiu errado, por favor tente novamente.</h5>
                            <?php
                    }
                    if ($_GET['msg'] == 'sucessoContatoBug') {
                        ?>
                        <h5> A equipe de desenvolvimento ja foi notificada do problema, em breve retornaremos o contato</h5>
                            <?php
                    }
                    if ($_GET['msg'] == 'sucessoContatoCritica') {
                        ?>
                        <h5>Obrigado pelo seu comentario, trabalhando juntos seremos os melhores!</h5>
                            <?php
                    }
                    if ($_GET['msg'] == 'sucessoContatoSugestao') {
                        ?>
                        <h5>Obrigado pela sujestão com sua ajuda estamos uma passo mais perto da perfeição! :)</h5>
                            <?php
                    }
                    if ($_GET['msg'] == 'sucessoContatoProblema') {
                        ?>
                        <h5>Os administardores do sistema receberam sua mensagem, em breve retornarão o contato!</h5>
                            <?php
                    }
                    if ($_GET['msg'] == 'erroContato') {
                        ?>
                            <h5>Algo saiu errado, por favor tente novamente.</h5>
                            <?php
                    }
                    ?>
                    <p>Você ainda pode contatar o presindente da associacão: </p>
                    <span><?php echo $presidente->getNome(); ?>
                    <br>Entre em contato pelo Telefone: <?php echo $presidente->getTelefone(); ?>, pelo E-mail: <?php echo $presidente->getEmail(); ?>.<br>Ou diretamente no endereço:
                    Rua, <?php echo $presidente->getRua(); ?>, Bairro <?php echo $presidente->getBairro(); ?>, Número  <?php echo $presidente->getNumero(); ?>, na cidade de <?php echo $presidente->getCidade(); ?></span>
                </div>
            </div>
        </main>
        <?php include_once '../Base/footer.php'; ?>
    </body>
</html>
