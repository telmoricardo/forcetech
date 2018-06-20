<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PedidoProdutoController {
    private $pedidoProdutoDAO;
    
    public function __construct() {
        $this->pedidoProdutoDAO = new PedidoProdutoDAO();
    }
    
    public function Cadastrar(PedidoProduto $pedidoProduto ) {
        return $this->pedidoProdutoDAO->Cadastrar($pedidoProduto);
    }
    
    public function Deletar($id){
        return $this->pedidoProdutoDAO->Deletar($id);
    }
    
    public function produtoPedidoRelacionado($cod) {
        return $this->pedidoProdutoDAO->produtoPedidoRelacionado($cod);
    }
    public function AlterarBoleto($cod, $boleto) {
        return $this->pedidoProdutoDAO->AlterarBoleto($cod, $boleto);
    }
}
