<!DOCTYPE HTML>
<html>
    <head>
        <META charset="UTF-8">
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data"> 
            <label for="conteudo">Enviar imagem:</label>
            <input type="file" name="pic" accept="image/*">    
            <button type="submit">Enviar imagem</button>
        </form>
    </body>
</html>

<?php
if (isset($_FILES['pic'])) {
    $ext = strtolower(substr($_FILES['pic']['name'], -4)); //Pegando extensão do arquivo
    $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
    $dir = '../Img/'; //Diretório para uploads 
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir . $new_name); //Fazer upload do arquivo
    echo("Imagem enviada com sucesso!");
}
?>
