<?php
include_once '../../Controle/usuarioPDO.php';
include_once '../../Modelo/usuario.php';
$usuarioPDO = new usuarioPDO();
$resultado = $usuarioPDO->selectTodosUsers($_GET['pesquisa']);
if($resultado){
    while ($linha = $resultado->fetch()){
        $usuario= new usuario($linha);
        echo "<option value='".$usuario->getIdPessoa()."'>".$usuario->getNome()."</option>";
    }
}
