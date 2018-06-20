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
class SliderController {
    private $sliderDAO;
    
    public function __construct() {
        $this->sliderDAO = new SliderDAO();
    }
    
    public function Cadastrar(Slider $slider){
        if(strlen($slider->getSlider_titulo()) > 3 && strlen($slider->getSlider_status()) > 0 && strlen($slider->getSlider_status()) <=3):
            return $this->sliderDAO->Cadastrar($slider);
        else:
            return false;
        endif;
    }
    
    public function Atualizar(Slider $slider) {
         return $this->sliderDAO->Atualizar($slider);
    }
//    
    public function ListarSlider($inicio = null, $quantidade = null) {
        return $this->sliderDAO->ListarSlider($inicio, $quantidade);
    }
    
    public function ListarTamanhoSlider($tamanho) {
        return $this->sliderDAO->ListarTamanhoSlider($tamanho);
    }
    
    public function ListarTamanhoBanner($tamanho, $inicio = null, $quantidade = null) {
        return $this->sliderDAO->ListarTamanhoBanner($tamanho, $inicio, $quantidade);
    }
    
    
    //retorna dados do slider
    public function retornaSlider($cod){
        if($cod > 0):
            return $this->sliderDAO->retornaSlider($cod);
        else:
            return false;
        endif;
    }
//    
//    public function retornaCategoriaUrl($url){
//        return $this->categoriaDAO->retornaCategoriaUrl($url);
//        
//    }
//    
    //excluir slider
    public function Excluir($cod) {
        return $this->sliderDAO->Excluir($cod);
    }
    
    //Alterar Imagem
    public function AlterarImagem($cod, $thumb) {
        return $this->sliderDAO->AlterarImagem($cod, $thumb);
    }
    
    //retorna o status
    public function retornaStatusSlider($cod) {
        return $this->sliderDAO->retornaStatusSlider($cod);
    }
    
    //alterar status do slider
    public function AlterarStatus($cod, $status) {
        return $this->sliderDAO->AlterarStatus($cod, $status);
    }
    
    //retorna a quantidade
    public function RetornaQtdSlider() {
        return $this->sliderDAO->RetornaQtdSlider();
    }
}
