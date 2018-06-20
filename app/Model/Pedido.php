<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pedido {
    private $id;
    private $pedidos_cliente;
    private $pedidos_id_moip;
    private $pedidos_data;
    private $pedidos_total;
    private $pedidos_frete;
    private $pedidos_frete_tipo;
    private $pedidos_status;
    private $pedidos_cep;
    private $pedidos_endereco;
    private $pedidos_numero;
    private $pedidos_bairro;
    private $pedidos_cidade;
    private $pedidos_uf;
    private $pedidos_complemento;
    
    
    public function __construct() {
        $this->pedidos_cliente = new Usuario();       
    }
    
    function getId() {
        return $this->id;
    }

    function getPedidos_cliente() {
        return $this->pedidos_cliente;
    }

    function getPedidos_id_moip() {
        return $this->pedidos_id_moip;
    }

    function getPedidos_data() {
        return $this->pedidos_data;
    }

    function getPedidos_total() {
        return $this->pedidos_total;
    }

    function getPedidos_frete() {
        return $this->pedidos_frete;
    }

    function getPedidos_frete_tipo() {
        return $this->pedidos_frete_tipo;
    }

    function getPedidos_status() {
        return $this->pedidos_status;
    }

    function getPedidos_cep() {
        return $this->pedidos_cep;
    }

    function getPedidos_endereco() {
        return $this->pedidos_endereco;
    }

    function getPedidos_numero() {
        return $this->pedidos_numero;
    }

    function getPedidos_bairro() {
        return $this->pedidos_bairro;
    }

    function getPedidos_cidade() {
        return $this->pedidos_cidade;
    }

    function getPedidos_uf() {
        return $this->pedidos_uf;
    }

    function getPedidos_complemento() {
        return $this->pedidos_complemento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPedidos_cliente($pedidos_cliente) {
        $this->pedidos_cliente = $pedidos_cliente;
    }

    function setPedidos_id_moip($pedidos_id_moip) {
        $this->pedidos_id_moip = $pedidos_id_moip;
    }

    function setPedidos_data($pedidos_data) {
        $this->pedidos_data = $pedidos_data;
    }

    function setPedidos_total($pedidos_total) {
        $this->pedidos_total = $pedidos_total;
    }

    function setPedidos_frete($pedidos_frete) {
        $this->pedidos_frete = $pedidos_frete;
    }

    function setPedidos_frete_tipo($pedidos_frete_tipo) {
        $this->pedidos_frete_tipo = $pedidos_frete_tipo;
    }

    function setPedidos_status($pedidos_status) {
        $this->pedidos_status = $pedidos_status;
    }

    function setPedidos_cep($pedidos_cep) {
        $this->pedidos_cep = $pedidos_cep;
    }

    function setPedidos_endereco($pedidos_endereco) {
        $this->pedidos_endereco = $pedidos_endereco;
    }

    function setPedidos_numero($pedidos_numero) {
        $this->pedidos_numero = $pedidos_numero;
    }

    function setPedidos_bairro($pedidos_bairro) {
        $this->pedidos_bairro = $pedidos_bairro;
    }

    function setPedidos_cidade($pedidos_cidade) {
        $this->pedidos_cidade = $pedidos_cidade;
    }

    function setPedidos_uf($pedidos_uf) {
        $this->pedidos_uf = $pedidos_uf;
    }

    function setPedidos_complemento($pedidos_complemento) {
        $this->pedidos_complemento = $pedidos_complemento;
    }


}
