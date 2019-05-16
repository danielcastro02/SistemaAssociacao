<?php
class mensalidade {

    private $id_mensalidade;
    private $mes;
    private $valor;
    private $vencimento;
    
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
    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }
    function getVencimento() {
        return $this->vencimento;
    }

    function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

        function getId_mensalidade() {
        return $this->id_mensalidade;
    }

    function getMes() {
        return $this->mes;
    }

    function getValor() {
        return $this->valor;
    }

    function setId_mensalidade($id_mensalidade) {
        $this->id_mensalidade = $id_mensalidade;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

}
