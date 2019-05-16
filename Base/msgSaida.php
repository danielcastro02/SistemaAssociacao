<?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "senhasdiferentes") {
        ?>  
        <div class="row">
            <span class="red-text">Senhas não conferem</span>
        </div>
    <?php } elseif ($_GET['msg'] == 'senhavazia') {
        ?>
        <div class="row">
            <span class="red-text">Senha Vazia</span>
        </div>
    <?php } elseif ($_GET['msg'] == 'senhaPequena') {
        ?>  
        <div class="row">
            <span class="red-text">A senha precisa ter pelo menos 8 caracteres</span>
        </div>
        <?php
    }
}
?>