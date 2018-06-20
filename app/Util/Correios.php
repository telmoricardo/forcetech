<?php

/*
 * Classe responsável para calcular o preco de entrega dos produtos
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Correios {

    private $tipo;
    private $formato;
    private $cepDestino;
    private $cepOrigem;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $diametro;
    private $correios;

    public function __construct() {
        $this->correios = new CorreiosConsulta();
    }

    private function dadosParaCalcularFrete() {

        $dadosCalcularFrete = [
            'tipo' => $this->tipo, // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato' => $this->formato, // opções: `caixa`, `rolo`, `envelope`
            'cep_destino' => $this->cepDestino, // Obrigatório
            'cep_origem' => $this->cepOrigem, // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso' => $this->peso, // Peso em kilos
            'comprimento' => $this->comprimento, // Em centímetros
            'altura' => $this->altura, // Em centímetros
            'largura' => $this->largura, // Em centímetros
            'diametro' => $this->diametro, // Em centímetros, no caso de rolo
                // 'mao_propria'       => '1', // Não obrigatórios
                // 'valor_declarado'   => '1', // Não obrigatórios
                // 'aviso_recebimento' => '1', // Não obrigatórios
            
        ];
        
        return $dadosCalcularFrete;
    }
    
    public function calcularFrete() {
        return $this->correios->frete($this->dadosParaCalcularFrete());
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function getFormato() {
        return $this->formato;
    }

    function getCepDestino() {
        return $this->cepDestino;
    }

    function getCepOrigem() {
        return $this->cepOrigem;
    }

    function getPeso() {
        return $this->peso;
    }

    function getComprimento() {
        return $this->comprimento;
    }

    function getAltura() {
        return $this->altura;
    }

    function getLargura() {
        return $this->largura;
    }

    function getDiametro() {
        return $this->diametro;
    }

    function getCorreios() {
        return $this->correios;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setFormato($formato) {
        $this->formato = $formato;
    }

    function setCepDestino($cepDestino) {
        $this->cepDestino = $cepDestino;
    }

    function setCepOrigem($cepOrigem) {
        $this->cepOrigem = $cepOrigem;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setComprimento($comprimento) {
        $this->comprimento = $comprimento;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setDiametro($diametro) {
        $this->diametro = $diametro;
    }

    function setCorreios($correios) {
        $this->correios = $correios;
    }



}
