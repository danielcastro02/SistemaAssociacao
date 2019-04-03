<nav class="nav-extended corpadrao">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">Associação de Cacequi</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if(isset($_SESSION['id'])){?>
                <li><a href="./Tela/home.php">Voltar ao Sistema</a></li>
            <?php
            }else{
            ?>
            <li><a href="./Tela/login.php">Entrar</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>
