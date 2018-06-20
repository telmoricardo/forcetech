<?php

namespace app\Util;

class Pagseguro{
    
    //dados obrigatório do pagseguero, so vou utilizar dentro dessa classe
    //obs: TEM QUE FAZER AS ALTERAÇÕES NO ARQUIVO PAGSEGUROCONFIGWRAPPER.PHP
    
    private $pagseguroConfig;
    private $nome;
    private $sobrenome;
    private $email;
    private $ddd;
    private $telefone;
    private $idReferencia;
    private $credenciais;
    private $itemAdd = [];
    private $dadosCliente;

    public function __construct(){
        //chamando a classe Pagseguro, tem que acrescentar \PagseguroLibrary::init() é obrigatório
        $this->pagseguroConfig = new \PagSeguroPaymentRequest();
        \PagseguroLibrary::init();
    }

    private function dadosCompra(){
        //é obrigatório nome, sobrenome, email, dd, telefone
        $this->pagseguroConfig->setSender(
                $this->nome.' '.$this->sobrenome, $this->email, $this->ddd, $this->telefone
        );
        
        //converter moeda em Reais - Valor do Brasil
        $this->pagseguroConfig->setCurrency("BRL");
        
        //id da referencia do pagseguro
        $this->pagseguroConfig->setReference($this->idReferencia);
        
        // $this->pagseguroConfig->setShippingAddress( 'cep', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'pais' );
        $this->pagseguroConfig->setShippingAddress(null);
        
        //var_dump($this->itemAdd);
        
        foreach($this->itemAdd as $item):
            $this->pagseguroConfig->addItem( $item['id'], $item['produto'],$item['qtd'], $item['preco'] );
        endforeach;
    }
    
    //enviar para o pagseguro os dados da compra, as credenciais
    public function enviarPagseguro(){

        $this->dadosCompra();
        $this->credenciais = new \PagSeguroAccountCredentials(
            'telmoricardorosa@gmail.com', 'B7987963D8DC47A8972043D53015F261'
        );
        
        //retorna a Url do pagseguro
        $url = $this->pagseguroConfig->register( $this->credenciais );
        return $url;

    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setSobreNome($sobrenome){
        $this->sobrenome = $sobrenome;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDdd($ddd){
        $this->ddd = $ddd;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setIdReferencia($idReference)
    {
        $this->idReferencia = $idReference;
    }

    public function setItemAdd($itemAdd)
    {
        $this->itemAdd[] = $itemAdd;
    }

}
