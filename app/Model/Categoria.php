<?php

/*
 * Classe Categoria responsavel pelos atributos da tabela categoria
 */

/**
 * @Telmo Ricardo 
 */

class Categoria {
    private $categoria_cod;
    private $categoria_nome;
    private $categoria_url;
    private $categoria_descricao;
    private $categoria_status;
    private $categoria_views;
    private $categoria_data;
    
    
    function getCategoria_cod() {
        return $this->categoria_cod;
    }

    function getCategoria_nome() {
        return $this->categoria_nome;
    }

    function getCategoria_url() {
        return $this->categoria_url;
    }

    function getCategoria_descricao() {
        return $this->categoria_descricao;
    }

    function getCategoria_status() {
        return $this->categoria_status;
    }

    function getCategoria_views() {
        return $this->categoria_views;
    }

    function getCategoria_data() {
        return $this->categoria_data;
    }

    function setCategoria_cod($categoria_cod) {
        $this->categoria_cod = $categoria_cod;
    }

    function setCategoria_nome($categoria_nome) {
        $this->categoria_nome = $categoria_nome;
    }

    function setCategoria_url($categoria_url) {
        $this->categoria_url = $categoria_url;
    }

    function setCategoria_descricao($categoria_descricao) {
        $this->categoria_descricao = $categoria_descricao;
    }

    function setCategoria_status($categoria_status) {
        $this->categoria_status = $categoria_status;
    }

    function setCategoria_views($categoria_views) {
        $this->categoria_views = $categoria_views;
    }

    function setCategoria_data($categoria_data) {
        $this->categoria_data = $categoria_data;
    }



}
