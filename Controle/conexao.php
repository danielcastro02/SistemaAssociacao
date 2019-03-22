<?php

class conexao {

    public function getConexao() {
        $conexao = new PDO("mysql:host=localhost;dbname=associacao","root","");
    }

}

?>