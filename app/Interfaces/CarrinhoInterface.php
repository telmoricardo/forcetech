<?php

interface CarrinhoInterface{

    public function adicionarAoCarrinho($id);
    public function removerDoCarrinho($id);
    public function pegarProdutosDoCarrinho();
    public function atualizarQuantidade($id, $qtd);
    public function totalDoPedido(ProdutoController $produtoController);
    public function limparCarrinho();

}
