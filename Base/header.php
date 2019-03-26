<?php
if (realpath("./index.php")) {
    $pontos = "";
} else {
    $pontos = ".";
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo $pontos; ?>./css/materialize.css">
<link rel="stylesheet" href="<?php echo $pontos; ?>./css/custom.css">
<script type="text/javascript" src="<?php echo $pontos; ?>./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo $pontos; ?>./js/materialize.js"></script>