<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Produto {
    private $produto_cod;
    private $produto_nome;
    private $produto_url;
    private $produto_breve;
    private $produto_codigo;
    private $produto_descricao;
    private $produto_categoria;
    private $produto_subcategoria;
    private $produto_preco;    
    private $produto_tipo;
    private $produto_thumb;
    private $produto_peso;
    private $produto_estoque;
    private $produto_altura;
    private $produto_largura;
    private $produto_profundidade;
    private $produto_status;
    private $produto_datainicial;
    private $produto_datafinal;
    private $produto_view;
    
    public function __construct() {
        $this->produto_categoria = new Categoria();
        $this->produto_subcategoria = new Subcategoria;
        $this->produto_tipo = new Tipo();
    }
    function getProduto_cod() {
        return $this->produto_cod;
    }

    function getProduto_nome() {
        return $this->produto_nome;
    }

    function getProduto_url() {
        return $this->produto_url;
    }

    function getProduto_breve() {
        return $this->produto_breve;
    }

    function getProduto_codigo() {
        return $this->produto_codigo;
    }

    function getProduto_descricao() {
        return $this->produto_descricao;
    }

    function getProduto_categoria() {
        return $this->produto_categoria;
    }

    function getProduto_subcategoria() {
        return $this->produto_subcategoria;
    }

    function getProduto_preco() {
        return $this->produto_preco;
    }

    function getProduto_tipo() {
        return $this->produto_tipo;
    }

    function getProduto_thumb() {
        return $this->produto_thumb;
    }

    function getProduto_peso() {
        return $this->produto_peso;
    }

    function getProduto_estoque() {
        return $this->produto_estoque;
    }

    function getProduto_altura() {
        return $this->produto_altura;
    }

    function getProduto_largura() {
        return $this->produto_largura;
    }

    function getProduto_profundidade() {
        return $this->produto_profundidade;
    }

    function getProduto_status() {
        return $this->produto_status;
    }

    function getProduto_datainicial() {
        return $this->produto_datainicial;
    }

    function getProduto_datafinal() {
        return $this->produto_datafinal;
    }

    function getProduto_view() {
        return $this->produto_view;
    }

    function setProduto_cod($produto_cod) {
        $this->produto_cod = $produto_cod;
    }

    function setProduto_nome($produto_nome) {
        $this->produto_nome = $produto_nome;
    }

    function setProduto_url($produto_url) {
        $this->produto_url = $produto_url;
    }

    function setProduto_breve($produto_breve) {
        $this->produto_breve = $produto_breve;
    }

    function setProduto_codigo($produto_codigo) {
        $this->produto_codigo = $produto_codigo;
    }

    function setProduto_descricao($produto_descricao) {
        $this->produto_descricao = $produto_descricao;
    }

    function setProduto_categoria($produto_categoria) {
        $this->produto_categoria = $produto_categoria;
    }

    function setProduto_subcategoria($produto_subcategoria) {
        $this->produto_subcategoria = $produto_subcategoria;
    }

    function setProduto_preco($produto_preco) {
        $this->produto_preco = $produto_preco;
    }

    function setProduto_tipo($produto_tipo) {
        $this->produto_tipo = $produto_tipo;
    }

    function setProduto_thumb($produto_thumb) {
        $this->produto_thumb = $produto_thumb;
    }

    function setProduto_peso($produto_peso) {
        $this->produto_peso = $produto_peso;
    }

    function setProduto_estoque($produto_estoque) {
        $this->produto_estoque = $produto_estoque;
    }

    function setProduto_altura($produto_altura) {
        $this->produto_altura = $produto_altura;
    }

    function setProduto_largura($produto_largura) {
        $this->produto_largura = $produto_largura;
    }

    function setProduto_profundidade($produto_profundidade) {
        $this->produto_profundidade = $produto_profundidade;
    }

    function setProduto_status($produto_status) {
        $this->produto_status = $produto_status;
    }

    function setProduto_datainicial($produto_datainicial) {
        $this->produto_datainicial = $produto_datainicial;
    }

    function setProduto_datafinal($produto_datafinal) {
        $this->produto_datafinal = $produto_datafinal;
    }

    function setProduto_view($produto_view) {
        $this->produto_view = $produto_view;
    }


}
