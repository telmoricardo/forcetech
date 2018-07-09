<?php
$usuarioController = new UsuarioController();
$usuario = new Usuario();
$helper = new Helper();

$resultado = "";

$btnUsuario = filter_input(INPUT_POST, "btnUsuario", FILTER_SANITIZE_STRING);
if ($btnUsuario):
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

    $retornaDados = $usuarioController->verificarUsuario($cpf);
    if ($retornaDados != null):
        $resultado = '<div class="msg-error">            
            <span><b> Opss, usuário já foi cadastro </b></span>
        </div>';
    else:
        if ($usuarioController->Cadastrar($usuario)):
            $insertGoTo = HOME . '/login';
            echo"<script language='javascript' type='text/javascript'>alert('Cadastrado com sucesso, entre com seu email e com senha!');</script>";
            header("refresh:0;url={$insertGoTo}");
        else:
            $resultado = '<div class="msg-error">            
                <span><b> Favor preencha todos os dados </b></span>
            </div>';
        endif;
    endif;
endif;
?>
<div class="container">
    <div class="content">
        <div class="row checkout-row">
            <div class="column column-12">
                <form class="form" method="post" id="cadastroCliente">
                    <div class="form_title">
                        <h3><strong>1</strong>Detalhes Importantes</h3>
                        <p>Alguns dados básicos</p>

                    </div>

                    <div class="step">                        
                        <div class="row">
                            <div class="column column-12">
                                <div class="form-field">
                                    <label>Nome Completo:</label>
                                    <input type="text" id="nome_completo" name="txtNome" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>E-mail</label>
                                    <input type="text" id="email" name="txtEmail" class="form-control">
                                </div>
                            </div>
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>CPF</label>
                                    <input type="text" id="name_card_cpf" name="txtCpf" maxlength="14"  class="form-control">
                                </div>
                            </div>
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>Data de Nasc.:</label>
                                    <input type="text" id="data_nasc" name="data_nasc" maxlength="10" placeholder="00/00/0000" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Senha</label>
                                    <input type="password" id="senha" name="txtSenha" class="form-control">
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Confirmar Senha</label>
                                    <input type="password" id="senha2" name="txtSenha2" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Telefone</label>
                                    <input type="text" id="telephone_booking" name="telephone_booking" maxlength="14" class="form-control">
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Celular</label>
                                    <input type="text" id="telephone_booking2" name="telephone_booking2" maxlength="15"  class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form_title">
                        <h3><strong>2</strong>Informações pessoais</h3>
                        <p>Precisamos de mais alguns dados de preenchimento, é bem rápido</</p>
                    </div>

                    <div class="step">                        
                        <div class="row">
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>CEP</label>
                                    <input type="text" id="endereco_cep" name="endereco_cep" maxlength="8" class="form-control" placeholder="Sem traços" value="">
                                </div>
                            </div>
                            <div class="column column-9">
                                <div class="form-field">
                                    <label>Endereço</label>
                                    <input type="text" id="endereco_endereco" name="endereco_endereco"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>Nº</label>
                                    <input type="text" id="endereco_n" name="endereco_n" maxlength="15" class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-4">
                                <div class="form-field">
                                    <label>Bairro</label>
                                    <input type="text" id="endereco_bairro" name="endereco_bairro" class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-4">
                                <div class="form-field">
                                    <label>Cidade</label>
                                    <input type="text" id="endereco_cidade" name="endereco_cidade"  class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>UF</label>
                                    <input type="text" id="endereco_uf" name="endereco_uf"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-12">
                                <div class="form-field">
                                    <label>Complemento</label>
                                    <input type="text" id="endereco_complemento" name="endereco_complemento"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-blue" id="cadastroUsuario" style="width: 300px; margin-bottom: 8px;">
                            Preencha os dados
                        </button>                       
                        <!--<input type="button" style="width: 350px;" class="btn btn-blue" value="Cadastrar" id="cadastroUsuario"/>-->
                        <input type="submit" style="width: 300px; display: none; margin-bottom: 8px;" class="btn btn-green" name="btnUsuario" id="btnUsuario" value="Cadastrar"/>



                        <div class="row">
                            <div class="column column-12">                                
                                <?php echo $resultado; ?>                
                            </div>                        
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= HOME; ?>/_cdn/jquery-3.2.1.min.js"></script> 
<script src="<?= HOME; ?>/_cdn/checkCadastre.js"></script>
