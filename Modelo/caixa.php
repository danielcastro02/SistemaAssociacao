<?php

class caixa {

    private $id_caixa;
    private $nome_caixa;
    private $saldo_atual;
    private $n_usuarios;

    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function getId_caixa() {
        return $this->id_caixa;
    }

    function getNome_caixa() {
        return $this->nome_caixa;
    }

    function getSaldo_atual() {
        return $this->saldo_atual;
    }

    function getN_usuarios() {
        return $this->n_usuarios;
    }

    function setId_caixa($id_caixa) {
        $this->id_caixa = $id_caixa;
    }

    function setNome_caixa($nome_caixa) {
        $this->nome_caixa = $nome_caixa;
    }

    function setSaldo_atual($saldo_atual) {
        $this->saldo_atual = $saldo_atual;
    }

    function setN_usuarios($n_usuarios) {
        $this->n_usuarios = $n_usuarios;
    }

}
