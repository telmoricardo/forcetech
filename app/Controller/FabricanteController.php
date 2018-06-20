<?php

class FabricanteController {

    private $fabricanteDAO;

    public function __construct() {
        $this->fabricanteDAO = new FabricanteDAO();
    }

    public function Cadastrar(Fabricante $fabricante) {
        return $this->fabricanteDAO->Cadastrar($fabricante);
    }
    
    public function ListaFabricante() {
        return $this->fabricanteDAO->ListaFabricante();
    }
    
    public function retornaFabricante($cod) {
        if($cod > 0):
            return $this->fabricanteDAO->retornaFabricante($cod);
        else:
            return false;
        endif;
    }

}
