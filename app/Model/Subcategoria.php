<?php

/*
 * Classe Categoria
 */

class Subcategoria {
    private $sub_cod;
    private $sub_titulo;
    private $sub_url;
    private $sub_descricao;
    private $sub_status;
    private $sub_views;
    private $sub_data;
    private $categoria;
    
    public function __construct() {
        $this->categoria = new Categoria();
    }
    
    function getSub_cod() {
        return $this->sub_cod;
    }

    function getSub_titulo() {
        return $this->sub_titulo;
    }

    function getSub_url() {
        return $this->sub_url;
    }

    function getSub_descricao() {
        return $this->sub_descricao;
    }

    function getSub_status() {
        return $this->sub_status;
    }

    function getSub_views() {
        return $this->sub_views;
    }

    function getSub_data() {
        return $this->sub_data;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setSub_cod($sub_cod) {
        $this->sub_cod = $sub_cod;
    }

    function setSub_titulo($sub_titulo) {
        $this->sub_titulo = $sub_titulo;
    }

    function setSub_url($sub_url) {
        $this->sub_url = $sub_url;
    }

    function setSub_descricao($sub_descricao) {
        $this->sub_descricao = $sub_descricao;
    }

    function setSub_status($sub_status) {
        $this->sub_status = $sub_status;
    }

    function setSub_views($sub_views) {
        $this->sub_views = $sub_views;
    }

    function setSub_data($sub_data) {
        $this->sub_data = $sub_data;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


}
