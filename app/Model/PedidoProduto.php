<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PedidoProduto {
    private $id;
    private $pedidos_produto_cliente;
    private $pedidos_produto_id_moip;
    private $pedidos_produto_quantidade;
    private $pedidos_produto_subtotal;
    private $pedidos_produto_id;
    private $pedidos_produto_nome;
    private $pedidos_produto_data;
    private $pedidos_produto_boleto;
    
    public function __construct() {
        $this->pedidos_produto_id_moip = new Pedido();
    }
    
    function getId() {
        return $this->id;
    }

    function getPedidos_produto_cliente() {
        return $this->pedidos_produto_cliente;
    }

    function getPedidos_produto_id_moip() {
        return $this->pedidos_produto_id_moip;
    }

    function getPedidos_produto_quantidade() {
        return $this->pedidos_produto_quantidade;
    }

    function getPedidos_produto_subtotal() {
        return $this->pedidos_produto_subtotal;
    }

    function getPedidos_produto_id() {
        return $this->pedidos_produto_id;
    }

    function getPedidos_produto_nome() {
        return $this->pedidos_produto_nome;
    }

    function getPedidos_produto_data() {
        return $this->pedidos_produto_data;
    }

    function getPedidos_produto_boleto() {
        return $this->pedidos_produto_boleto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPedidos_produto_cliente($pedidos_produto_cliente) {
        $this->pedidos_produto_cliente = $pedidos_produto_cliente;
    }

    function setPedidos_produto_id_moip($pedidos_produto_id_moip) {
        $this->pedidos_produto_id_moip = $pedidos_produto_id_moip;
    }

    function setPedidos_produto_quantidade($pedidos_produto_quantidade) {
        $this->pedidos_produto_quantidade = $pedidos_produto_quantidade;
    }

    function setPedidos_produto_subtotal($pedidos_produto_subtotal) {
        $this->pedidos_produto_subtotal = $pedidos_produto_subtotal;
    }

    function setPedidos_produto_id($pedidos_produto_id) {
        $this->pedidos_produto_id = $pedidos_produto_id;
    }

    function setPedidos_produto_nome($pedidos_produto_nome) {
        $this->pedidos_produto_nome = $pedidos_produto_nome;
    }

    function setPedidos_produto_data($pedidos_produto_data) {
        $this->pedidos_produto_data = $pedidos_produto_data;
    }

    function setPedidos_produto_boleto($pedidos_produto_boleto) {
        $this->pedidos_produto_boleto = $pedidos_produto_boleto;
    }



    
}





