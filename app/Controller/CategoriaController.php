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
class CategoriaController {
    private $categoriaDAO;
    
    public function __construct() {
        $this->categoriaDAO = new CategoriaDAO();
    }
    
    public function Cadastrar(Categoria $categoria){
        if(strlen($categoria->getCategoria_nome()) > 3 && strlen($categoria->getCategoria_status()) > 0 && strlen($categoria->getCategoria_status()) <=3):
            return $this->categoriaDAO->Cadastrar($categoria);
        else:
            return false;
        endif;
    }
    
    public function Atualizar(Categoria $categoria) {
         return $this->categoriaDAO->Atualizar($categoria);
    }
    
    public function ListarCategoria($inicio = null, $quantidade = null) {
        return $this->categoriaDAO->ListarCategoria($inicio, $quantidade);
    }
    
    public function ListarTodaCategoria() {
        return $this->categoriaDAO->ListarTodaCategoria();
    }
    
    
    public function retornaCategoria($cod){
        if($cod > 0):
            return $this->categoriaDAO->retornaCategoria($cod);
        else:
            return false;
        endif;
    }
    
    public function retornaCategoriaUrl($url){
        return $this->categoriaDAO->retornaCategoriaUrl($url);
        
    }
    
    public function Excluir($cod) {
        return $this->categoriaDAO->Excluir($cod);
    }
    
    public function RetornaQtdSubcategoria() {
        return $this->categoriaDAO->RetornaQtdSubcategoria();
    }
}
