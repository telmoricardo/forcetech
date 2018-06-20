<?php

/*
 * Classe Categoria
 */

class Tipo {
    private $tipo_cod;
    private $tipo_nome;
    
    function getTipo_cod() {
        return $this->tipo_cod;
    }

    function getTipo_nome() {
        return $this->tipo_nome;
    }

    function setTipo_cod($tipo_cod) {
        $this->tipo_cod = $tipo_cod;
    }

    function setTipo_nome($tipo_nome) {
        $this->tipo_nome = $tipo_nome;
    }

}
