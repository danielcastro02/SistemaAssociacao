<?php

class cobranca_mensalidade {

    private $id_cobranca_mensalidade;
    private $id_caixa_ref_mensalide;
    private $id_usuario_ref_mensalidade;
    private $id_mensalidade_ref;
    
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
    
    function getId_cobranca_mensalidade() {
        return $this->id_cobranca_mensalidade;
    }

    function getId_caixa_ref_mensalide() {
        return $this->id_caixa_ref_mensalide;
    }

    function getId_usuario_ref_mensalidade() {
        return $this->id_usuario_ref_mensalidade;
    }

    function getId_mensalidade_ref() {
        return $this->id_mensalidade_ref;
    }

    function setId_cobranca_mensalidade($id_cobranca_mensalidade) {
        $this->id_cobranca_mensalidade = $id_cobranca_mensalidade;
    }

    function setId_caixa_ref_mensalide($id_caixa_ref_mensalide) {
        $this->id_caixa_ref_mensalide = $id_caixa_ref_mensalide;
    }

    function setId_usuario_ref_mensalidade($id_usuario_ref_mensalidade) {
        $this->id_usuario_ref_mensalidade = $id_usuario_ref_mensalidade;
    }

    function setId_mensalidade_ref($id_mensalidade_ref) {
        $this->id_mensalidade_ref = $id_mensalidade_ref;
    }


    
}
