<?php

class conexao {
    public function getConexao(){
        $con = new pdo("mysql:host=localhost;dbname=associacao", "root", "");
        return $con;
    }
}

?>
