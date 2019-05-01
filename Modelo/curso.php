<?php


class curso{
    private $id;
    private $nome;
    private $turno;
    private $nivel;
    
    
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
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getTurno() {
        return $this->turno;
    }

    function getNivel() {
        return $this->nivel;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }


}
