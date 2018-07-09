<?php

require_once '../app/Config.inc.php';

$usuarioController = new UsuarioController();
$usuario = new Usuario();
$helper = new Helper();

$usuario->setNome(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING));
//convertendo data Y-m-d
$dataNasc = $helper->converteData(filter_input(INPUT_POST, "data_nasc", FILTER_SANITIZE_STRING));
$usuario->setNascimento($dataNasc);
$usuario->setEmail(filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING));
$usuario->setDocumento(filter_input(INPUT_POST, "txtCpf", FILTER_SANITIZE_STRING));
$cpf = $usuario->getDocumento();
$usuario->setNivel(3);
$usuario->setCelular(filter_input(INPUT_POST, "telephone_booking2", FILTER_SANITIZE_STRING));
$usuario->setTelefone(filter_input(INPUT_POST, "telephone_booking", FILTER_SANITIZE_STRING));
$usuario->setCep(filter_input(INPUT_POST, "endereco_cep", FILTER_SANITIZE_STRING));
$usuario->setRua(filter_input(INPUT_POST, "endereco_endereco", FILTER_SANITIZE_STRING));
$usuario->setNumero(filter_input(INPUT_POST, "endereco_n", FILTER_SANITIZE_NUMBER_INT));
$usuario->setBairro(filter_input(INPUT_POST, "endereco_bairro", FILTER_SANITIZE_STRING));
$usuario->setCidade(filter_input(INPUT_POST, "endereco_cidade", FILTER_SANITIZE_STRING));
$usuario->setUf(filter_input(INPUT_POST, "endereco_uf", FILTER_SANITIZE_STRING));
$usuario->setComplemento(filter_input(INPUT_POST, "endereco_complemento", FILTER_SANITIZE_STRING));
$usuario->setEmail_log($usuario->getEmail());
$usuario->setSenha_log(filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING));
$usuario->setSenha_cod(filter_input(INPUT_POST, "txtSenha2", FILTER_SANITIZE_STRING));
$usuario->setData_log(date('Y-m-d H:i:s'));
$usuario->setStatus(1);

if($usuarioController->verificarUsuario($cpf)):
     echo '<div class="msg-succes" style="margin-top: 8px;">Oppsss, o usuário já foi cadastrado!</div>';
else:
    echo 'Pode cadastrar';
endif;

if ($usuarioController->Cadastrar($usuario)):
    echo '<div class="msg-succes" style="margin-top: 8px;">Cadastrado com sucesso, redirecionando para minha conta</div>';
endif;


