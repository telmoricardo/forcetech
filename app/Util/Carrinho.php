<?php

class Carrinho implements CarrinhoInterface{

    private $statusDoCarrinho;
    private $total = 0;
    private $produtoController;

    public function __construct(){
        $this->statusDoCarrinho = new StatusCarrinho();
    }

    public function adicionarAoCarrinho($id){
        if( !$this->statusDoCarrinho->carrinhoExiste() ){
            $this->statusDoCarrinho->criarOCarrinho();
        }

        if(!$this->statusDoCarrinho->estaNoCarrinho($id)){
            $_SESSION['carrinho'][$id] = 1;
        }else{
            $_SESSION['carrinho'][$id] += 1;
        }

    }
    public function removerDoCarrinho($id){
        if($this->statusDoCarrinho->estaNoCarrinho($id)){
            unset($_SESSION['carrinho'][$id]);
        }
    }
    public function pegarProdutosDoCarrinho(){
        if($this->statusDoCarrinho->carrinhoExiste()){
            return $_SESSION['carrinho'];
        }
    }
    public function totalDoPedido(ProdutoController $produtoController){

        $this->produtoController = $produtoController;

        if( $this->statusDoCarrinho->carrinhoExiste() ){

            $produtosNoCarrinho = $this->pegarProdutosDoCarrinho();

            foreach( $produtosNoCarrinho as $produto => $quantidade ){

                $produtoCarrinho = $this->produtoController->retornaIdProduto($produto);
                $this->total += $produtoCarrinho->getProduto_preco()*$quantidade;
            }

            return $this->total;
        }
    }

    public function limparCarrinho(){
        if($this->statusDoCarrinho->carrinhoExiste()){
            unset($_SESSION['carrinho']);
        }
    }

    public function atualizarQuantidade($id, $qtd){

        if($qtd <= 0 || empty($qtd)){
            $this->removerDoCarrinho($id);
        }

        if($this->statusDoCarrinho->estaNoCarrinho($id)){
            $_SESSION['carrinho'][$id] = $qtd;
        }

    }

}
