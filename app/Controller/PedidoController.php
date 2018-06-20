<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PedidoController {

    private $pedidoDAO;

    public function __construct() {
        $this->pedidoDAO = new PedidoDAO();
    }

    public function Cadastrar(Pedido $pedido) {
        return $this->pedidoDAO->Cadastrar($pedido);
    }
    
    public function ListarPedidos($inicio = null, $quantidade = null) {
        return $this->pedidoDAO->ListarPedidos($inicio, $quantidade);
    }
     public function ListarPedidosCliente($cod, $inicio = null, $quantidade = null) {
         return $this->pedidoDAO->ListarPedidosCliente($cod, $inicio, $quantidade);
     }
    //retorna o pedido pelo ID
    public function retornaPedidoId($id) {
        return $this->pedidoDAO->retornaPedidoId($id);
    }
    
    public function retornaStatusPedido($cod) {
        return $this->pedidoDAO->retornaStatusPedido($cod);
    }
    public function AlterarStatusPedido($cod, $status) {
        return $this->pedidoDAO->AlterarStatusPedido($cod, $status);
    }
    
    public function RetornaQtdPedido() {
        return $this->pedidoDAO->RetornaQtdPedido();
    }
   
}
