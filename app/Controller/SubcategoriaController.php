<?php

/*
 * classe responsável intermediar a model e a _view_ de uma camada. 
 * Por exemplo, para pegar dados da model (guardados em um banco) e exibir na view (em uma página HTML), 
 * ou pegar os dados de um formulário (view) e enviar para alguém (model). 
 * Também é responsabilidade do controller cuidar das requisições (request e response). 
 * O controller não precisa saber como obter os dados nem como exibi-los, só quando fazer isso.
 */

/**
 * @TelmoRicardo
 */

class SubcategoriaController {
    private $subcategoriaDAO;
    
    public function __construct() {
        $this->subcategoriaDAO = new SubcategoriaDAO();
    }
    
    public function Cadastrar(Subcategoria $subcategoria){
        if(strlen($subcategoria->getSub_titulo()) > 1 && strlen($subcategoria->getSub_status()) > 0 && strlen($subcategoria->getSub_status()) <=3):
            return $this->subcategoriaDAO->Cadastrar($subcategoria);
        else:
            return false;
        endif;
    }
    
    public function Atualizar(Subcategoria $Subcategoria) {
        return $this->subcategoriaDAO->Atualizar($Subcategoria);
    }
    
    public function ListaSubcategoria($inicio = null, $quantidade = null) {
        return $this->subcategoriaDAO->ListaSubcategoria($inicio, $quantidade);
    }
    
    public function retornaSubcategoria($cod){
        return $this->subcategoriaDAO->retornaSubcategoria($cod);
    }
    public function retornaSubUrl($url){
        return $this->subcategoriaDAO->retornaSubUrl($url);
    }
    //retorna uma lista de subcategoria quando existe $cod
    public function listarSub($cod){
        return $this->subcategoriaDAO->listarSub($cod);
    }
    public function RetornaQtdSubcategoria() {
        return $this->subcategoriaDAO->RetornaQtdSubcategoria();
    }
    
}
