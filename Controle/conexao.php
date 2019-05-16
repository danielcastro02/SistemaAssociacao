<?php

class conexao {

    public function getConexao() {
        $con = new PDO("mysql:host=localhost;dbname=associacaoremodelada","root","");
        return $con;
    }

}
