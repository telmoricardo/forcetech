<?php

/**
 * Description of Functions
 *
 * @author arte1
 */
class Functions {

    private $porcentual;
    private $valor;

    public function Juros($porcentual, $valor) {
        $this->porcentual = $porcentual;
        $this->valor = $valor;
        $x = $this->porcentual / 100;
        return $retorno = $this->valor * (1 + $x);
    }
    
    public function Descontos($porcentual, $valor) {
        $this->porcentual = $porcentual;
        $this->valor = $valor;
        $x = $this->porcentual / 100;
        return $retorno = $this->valor * (1 - $x);
    }
    
    public function Parcelas($parcelas, $valor){
        return $retorno = $valor / $parcelas;
    }

}
