<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProdutoController {

    private $produtoDAO;

    public function __construct() {
        $this->produtoDAO = new ProdutoDAO();
    }

    public function Cadastrar(Produto $produto) {
        return $this->produtoDAO->Cadastrar($produto);
    }

    public function Atualizar(Produto $produto) {
        return $this->produtoDAO->Atualizar($produto);
    }

    //LISTAR PRODUTOS COM LIMITE
    public function ListarProduto($inicio = null, $quantidade = null) {
        return $this->produtoDAO->ListarProduto($inicio, $quantidade);
    }

    //RETORNA A QUANTIDADE DE PRODUTOS PAGINAÇÃO 
    public function RetornaQtdProduto() {
        return $this->produtoDAO->RetornaQtdProduto();
    }

    //excluir slider
    public function Excluir($cod) {
        return $this->produtoDAO->Excluir($cod);
    }

    //RETORNA PRODUTO ATRAVES DO ID
    public function retornaIdProduto($cod) {
        return $this->produtoDAO->retornaIdProduto($cod);
    }

    //retorna uma lista de tipo quando existe $cod
    public function groupByTipo() {
        return $this->produtoDAO->groupByTipo();
    }

    public function retornaProdutoUrl($url) {
        return $this->produtoDAO->retornaProdutoUrl($url);
    }

    public function AlterarImagem($cod, $thumb) {
        return $this->produtoDAO->AlterarImagem($cod, $thumb);
    }

    public function AlterarViews($url) {
        return $this->produtoDAO->AlterarViews($url);
    }

    public function AlterarDataPromocao($cod, $dataInicial, $dataFinal) {
        return $this->produtoDAO->AlterarDataPromocao($cod, $dataInicial, $dataFinal);
    }

    public function retornaProdutoImagem($cod) {
        return $this->produtoDAO->retornaProdutoImagem($cod);
    }

    public function retornaStatusProd($cod) {
        return $this->produtoDAO->retornaStatusProd($cod);
    }

    public function AlterarStatus($cod, $status) {
        return $this->produtoDAO->AlterarStatus($cod, $status);
    }

    /*     * *******************SITE************************** */

    public function ListProductCategory($categoria) {
        return $this->produtoDAO->ListProductCategory($categoria);
    }

    public function ListProductType($tipo) {
        return $this->produtoDAO->ListProductType($tipo);
    }

    public function produtosRelacionados($categoria, $inicio = null, $quantidade = null) {
        return $this->produtoDAO->produtosRelacionados($categoria, $inicio, $quantidade);
    }

    //LISTAR PRODUTOS EM PROMOÇÃO
    public function ListProductPromocao() {
        return $this->produtoDAO->ListProductPromocao();
    }

    //retorna uma lista de produtos quando existe $views
    public function maisVistos($inicio = null, $quantidade = null) {
        return $this->produtoDAO->maisVistos($inicio, $quantidade);
    }

    public function buscarProduto($termo) {
        return $this->produtoDAO->buscarProduto($termo);
    }

    public function qtdProdCat($categoria) {
        return $this->produtoDAO->qtdProdCat($categoria);
    }

}
