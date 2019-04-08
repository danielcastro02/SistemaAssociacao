<?php
if (isset($_SESSION['administrador'])) {
    if ($_SESSION['administrador'] == 'true') {
        include_once '../Base/navAdministrativa.php"';
    } else {
        if ($_SESSION['administrador'] == 'false') {
            include_once '../Base/navPadrao.php';
        }
    }
} else {
    include_once '../Base/navBar.php';
}
