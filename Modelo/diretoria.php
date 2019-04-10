<?php

class diretoria{

    private $id_usuario;
    private $cargo;
    
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
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }



}

