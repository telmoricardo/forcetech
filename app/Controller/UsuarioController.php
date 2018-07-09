<?php

class UsuarioController {

    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    //cadastrar usuário
//    public function Cadastrar(Usuario $usuario) {
//        if (strlen($usuario->getNome()) >= 5 && strlen($usuario->getUsuario()) >= 7 && strlen($usuario->getSenha()) >= 7 && strpos($usuario->getEmail(), "@") && strpos($usuario->getEmail(), ".") &&
//                strlen($usuario->getCpf()) == 14 && $usuario->getSexo() != "" && $usuario->getPermissao() >= 1 && $usuario->getPermissao() <= 2 && $usuario->getStatus() >= 1 && $usuario->getStatus() <= 2) {
//
//            return $this->usuarioDAO->Cadastrar($usuario);
//        } else {
//            return false;
//        }
//    }
    public function Cadastrar(Usuario $usuario) {
        if (strlen($usuario->getNome()) >= 5 ):
            return $this->usuarioDAO->Cadastrar($usuario);
        else:
            return false;
        endif;
        
    }
    //atualizar usuário
    public function Atualizar(Usuario $usuario) {
        return $this->usuarioDAO->Atualizar($usuario);
    }
    
    //listar todos os usuarios
    public function ListarUsuario($inicio = null, $quantidade = null) {
        return $this->usuarioDAO->ListarUsuario($inicio, $quantidade);
    }
    //excluir usuario
    public function Excluir($cod) {
        return $this->usuarioDAO->Excluir($cod);
    }


    public function AutenticarUsuario($email, $senha, $nivel) {
        $senha = md5($senha);
        return $this->usuarioDAO->AutenticarUsuario($email, $senha, $nivel);
    }

    public function IsLogginIn() {
        return $this->usuarioDAO->IsLogginIn();
    }

    public function retornaUsuario($cod) {
        return $this->usuarioDAO->retornaUsuario($cod);
    }
    //retornando o status do usuario
    public function retornaStatusUser($cod) {
        return $this->usuarioDAO->retornaStatusUser($cod);
    }
     //alterar o status do usuario
    public function AlterarStatusUser($cod, $status) {
        return $this->usuarioDAO->AlterarStatusUser($cod, $status);
    }
    //retorna quantidade de usuarios
    public function RetornaQtdUser() {
        return $this->usuarioDAO->RetornaQtdUser();
    }
    public function verificarUsuario($cpf) {
            return $this->usuarioDAO->verificarUsuario($cpf);
    }

}
