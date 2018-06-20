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
class TipoController {
    private $tipoDAO;
    
    public function __construct() {
        $this->tipoDAO = new TipoDAO();
    }
    
    public function ListarTodaTipo() {
        return $this->tipoDAO->ListarTodaTipo();
    }
    public function ListarTipo($inicio = null, $quantidade = null) {
        return $this->tipoDAO->ListarTipo($inicio, $quantidade);
    }
    
    
}
