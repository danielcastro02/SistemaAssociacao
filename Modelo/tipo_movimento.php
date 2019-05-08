<?php

class tipo_movimento {
    private $id_tipo;
    private $nome_movimento;
    private $tipo;
    
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
    
    function getId_tipo() {
        return $this->id_tipo;
    }

    function getNome_movimento() {
        return $this->nome_movimento;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setNome_movimento($nome_movimento) {
        $this->nome_movimento = $nome_movimento;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}
