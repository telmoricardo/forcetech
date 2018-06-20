<?php

/*
 * Classe responsável pelos atributos da classe usuario
 */


class Usuario {

    private $cod;
    private $nome;
    private $nascimento;
    private $documento;
    private $nivel;
    private $email;
    private $telefone;
    private $celular;
    private $rua;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $email_log;
    private $senha_log;
    private $senha_cod;
    private $data_log;
    private $status;

    function getCod() {
        return $this->cod;
    }

    function getNome() {
        return $this->nome;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getCep() {
        return $this->cep;
    }

    function getEmail_log() {
        return $this->email_log;
    }

    function getSenha_log() {
        return $this->senha_log;
    }

    function getSenha_cod() {
        return $this->senha_cod;
    }

    function getData_log() {
        return $this->data_log;
    }
    
    function getStatus() {
        return $this->status;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setEmail_log($email_log) {
        $this->email_log = $email_log;
    }

    function setSenha_log($senha_log) {
        $this->senha_log = md5($senha_log);
    }

    function setSenha_cod($senha_cod) {
        $this->senha_cod = $senha_cod;
    }

    function setData_log($data_log) {
        $this->data_log = $data_log;
    }
    
    function setStatus($status) {
        $this->status = $status;
    }

}
