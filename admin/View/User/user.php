<?php
//intanciando os objetos
$usuarioController = new UsuarioController();
$usuario = new Usuario();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";
?>


<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-7">

                <div class="card">
                    <div class="header">
                        <h4 class="title">Cadastrar Usuário</h4>
<?php
$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $usuario->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $usuario->setNome(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING));
    $dataNasc = $helper->converteData(filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_STRING));
    $usuario->setNascimento($dataNasc);
    $usuario->setDocumento(filter_input(INPUT_POST, "txtCpf", FILTER_SANITIZE_STRING));
    $usuario->setNivel(filter_input(INPUT_POST, "slNivel", FILTER_SANITIZE_NUMBER_INT));
    $usuario->setEmail(filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING));
    $usuario->setTelefone(filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_STRING));
    $usuario->setCelular(filter_input(INPUT_POST, "txtCelular", FILTER_SANITIZE_STRING));
    $usuario->setNumero(filter_input(INPUT_POST, "txtNumero", FILTER_SANITIZE_NUMBER_INT));
    $usuario->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $usuario->setCep(filter_input(INPUT_POST, "txtCep", FILTER_SANITIZE_STRING));
    $usuario->setBairro(filter_input(INPUT_POST, "txtBairro", FILTER_SANITIZE_STRING));
    $usuario->setCidade(filter_input(INPUT_POST, "txtCidade", FILTER_SANITIZE_STRING));
    $usuario->setRua(filter_input(INPUT_POST, "txtEndereco", FILTER_SANITIZE_STRING));
    $usuario->setUf(filter_input(INPUT_POST, "txtEstado", FILTER_SANITIZE_STRING));
    $usuario->setComplemento(filter_input(INPUT_POST, "txtComplemento", FILTER_SANITIZE_STRING));
    $usuario->setData_log(date('Y-m-d H:i:s'));

    //dados para email, senha com md5 e senha
    $usuario->setEmail_log($usuario->getEmail());
    $usuario->setSenha_log(filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING));
    $usuario->setSenha_cod(filter_input(INPUT_POST, "txtSenha2", FILTER_SANITIZE_STRING));


    if ($usuarioController->Cadastrar($usuario)):
        $resultado = '<div class="alert alert-info">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Cadastrado com sucesso - </b></span>
        </div>';
    else:
        $resultado = '<div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Erro ao cadastrar, tente mais tarde - </b></span>
        </div>';
    endif;


endif;
?>
                    </div>
                    <div class="content">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome </label>
                                        <input type="text" name="txtNome" id="txtNome" class="form-control border-input" placeholder="Nome Completo" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de Nasc.:</label>
                                        <input type="text" name="txtData" id="data_nasc" maxlength="10" class="form-control border-input" placeholder="00/00/0000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CPF:</label>
                                        <input type="text" name="txtCpf" id="cpf" maxlength="14" class="form-control border-input" placeholder="999.999.999-99">
                                    </div>
                                </div>

                            </div>

                            <div class="row">                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" name="txtEmail" id="email" class="form-control border-input" placeholder="E-mail">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefone </label>
                                        <input type="text" name="txtTelefone" id="txtTelefone" maxlength="14" class="form-control border-input" placeholder="(61) 9999-9999">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Celular </label>
                                        <input type="text" name="txtCelular" id="txtCelular" maxlength="15" class="form-control border-input" placeholder="(61) 99999-9999">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="text" name="txtSenha1" id="senha" class="form-control border-input" placeholder="**************" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Repetir Senha</label>
                                        <input type="text" id="senha2" name="txtSenha2" class="form-control border-input" placeholder="**************" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="slStatus" class="form-control border-input">                                            
                                            <option value="1">Ativo</option>                                                
                                            <option value="2">Inativo</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nivel</label>
                                        <select name="slNivel" id="slNivel" class="form-control border-input">
                                            <option value="">Selecione o nível</option>                                            
                                            <option value="1">Administrador</option>                                                
                                            <option value="2">Editor</option>
                                            <option value="3">Cliente</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cep</label>
                                        <input type="text" id="cep" name="txtCep" class="form-control border-input" placeholder="Cep">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" name="txtEndereco" id="rua" class="form-control border-input" placeholder="endereco">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" name="txtNumero" id="numero" class="form-control border-input" placeholder="estado">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" id="bairro" name="txtBairro" class="form-control border-input" placeholder="Bairro">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Complemento:</label>
                                        <input type="text" name="txtComplemento" id="complemento" class="form-control border-input" placeholder="Complemento">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" id="cidade" name="txtCidade" class="form-control border-input" placeholder="Cidade">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" name="txtEstado" id="uf" class="form-control border-input" placeholder="estado">
                                    </div>
                                </div>
                            </div>                               
                            <div class="row">
                                <div class="col-md-12">
<?php echo $resultado; ?>
                                </div>

                            </div>                              
                            <div class="text-center">
                                <input type="submit" class="btn btn-success btn-fill btn-wd" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="modal_pagamento" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height:60%">
            <div class="modal-header">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
            </div>
            <div class="modal-body" style="text-align:center;height:30%">
                <br><br>
                <h3><b>Confirmando pagamento</b></h3>
                <div id="modal_pagamento_resultado"></div>
                <br>
                <img id="modal_pagamento_loading" src="assets/images/loading.gif">
                <br><br>
                <span id="modal_pagamento_wait">Por favor, aguarde...</span>
                <br>
                <span id="modal_pagamento_code"></span><br>
                <span id="modal_pagamento_boleto_link"></span>
                <br>
                <br><br>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="assets/js/functions.js" type="text/javascript"></script>
<script src="assets/js/js/functions.js" type="text/javascript"></script>
<script type="text/javascript">

    window.onload = function () {
        id('txtTelefone').onkeyup = function () {
            mascara(this, mtel);
        }
        id('txtCelular').onkeyup = function () {
            mascara(this, mtel);
        }

        id('cpf').onkeyup = function () {
            mascara(this, mcpf);
        }

        id('data_nasc').onkeyup = function () {
            mascara(this, mnasc);
        }

//        $("#modal_pagamento").modal("show");
    }

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        alert(out);
    }



    $(document).ready(function ()
    {
        $("#btnCadastrar").click(function () ///CADASTRO USUARIO
        {

            //dados do usuario
            var nomeCompleto = $("#txtNome").val();

            var email = $("#email").val();
            var cpf = $("#cpf").val();
            var nasc = $("#data_nasc").val();
            var senha = $("#senha").val();
            var senha2 = $("#senha2").val();

            var telephone_booking2 = $("#txtCelular").val();
            var endereco_cep1 = $("#cep").val();
            var endereco_endereco1 = $("#rua").val();
            var endereco_n1 = $("#numero").val();
            var endereco_bairro1 = $("#bairro").val();
            var endereco_cidade1 = $("#cidade").val();
            var endereco_complemento1 = $("#complemento").val();
            var endereco_uf1 = $("#uf").val();
            var nivel_1 = $("#slNivel").val();

            //Campos obrigatórios
            if (nomeCompleto == null || nomeCompleto == '' || nomeCompleto.length <= 5) {
                notifica('Falta nome', 'Por favor, preencha o Nome Completo', 'error');
                $('#modal_pagamento').modal('hide');
                $('#txtNome').focus();
                return false;
            }

            if (email == null || email == '' || (email.lastIndexOf("@") < 1) || (email.lastIndexOf(".") < 2)) {
                notifica('Falta E-mail', 'Por favor, informe um email válido', 'error');
                $('#modal_pagamento').modal('hide');
                $('#email').focus();
                return false;
            }
            if (cpf == null || cpf == '') {
                notifica('Falta CPF', 'Por favor, informe o CPF', 'error');
                $('#modal_pagamento').modal('hide');
                $('#cpf').focus();
                return false;
            }

            if (validarCPF(cpf) == false) {
                notifica('CPF INVÁLIDO', 'Por favor, informe o CPF válido', 'error');
                $('#modal_pagamento').modal('hide');
                $('#cpf').focus();
                return false;
            }

            if (nasc == null || nasc == '') {
                notifica('Falta Data Nascimento', 'Por favor, informe a Data de Nascimento', 'error');
                $('#modal_pagamento').modal('hide');
                $('#data_nasc').focus();
                return false;
            }
            if (senha == null || senha == '' || senha.length <= 6) {
                notifica('Falta Senha', 'Por favor, informe a Senha acima de 7 caracteres', 'error');
                $('#modal_pagamento').modal('hide');
                $('#senha').focus();
                return false;
            }
            if (senha2 == null || senha2 == '' || senha2.length <= 6) {
                notifica('Falta Confirmar Senha', 'Por favor, Confirme a Senha acima de 7 caracteres', 'error');
                $('#modal_pagamento').modal('hide');
                $('#senha2').focus();
                return false;
            }
            //verificando se a senhas são iguais
            if (senha != senha2) {
                notifica('Negado', 'Senhas não conferem', 'error');
                $('#modal_pagamento').modal('hide');
                $('#senha2').focus();
                return false;
            }


            if (nivel_1 == null || nivel_1 == '') {
                notifica('Falta Nível', 'Por favor, selecione o nível do Usuário', 'error');
                $('#modal_pagamento').modal('hide');
                $('#slNivel').focus();
                return false;
            }

            if (telephone_booking2 == null || telephone_booking2 == '') {
                notifica('Falta número celular', 'Por favor, informe um número do celular', 'error');
                $('#modal_pagamento').modal('hide');
                $('#telephone_booking2').focus();
                return false;
            }

            if (endereco_cep1 == null || endereco_cep1 == '') {
                notifica('Falta número do CEP', 'Por favor, informe seu CEP', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_cep').focus();
                return false;
            }
            if (endereco_endereco1 == null || endereco_endereco1 == '') {
                notifica('Falta Endereço', 'Por favor, informe seu Endereço', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_endereco').focus();
                return false;
            }
            if (endereco_n1 == null || endereco_n1 == '') {
                notifica('Falta número do Endereço', 'Por favor, informe o número no Endereço', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_n').focus();
                return false;
            }
            if (endereco_bairro1 == null || endereco_bairro1 == '') {
                notifica('Falta Bairro', 'Por favor, informe um Bairro', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_bairro').focus();
                return false;
            }
            if (endereco_cidade1 == null || endereco_cidade1 == '') {
                notifica('Falta Cidade', 'Por favor, informe sua Cidade', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_cidade').focus();
                return false;
            }
            if (endereco_uf1 == null || endereco_uf1 == '') {
                notifica('Falta Estado', 'Por favor, informe um Estado', 'error');
                $('#modal_pagamento').modal('hide');
                $('#endereco_uf').focus();
                return false;
            }

//            event.preventDefault();
            //Campos obrigatórios
        });


    });

    function validarCPF(cpf) {

        cpf = cpf.replace(/[^\d]+/g, '');

        if (cpf == '')
            return false;

        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
            return false;

        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;

        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;

        return true;

    }

</script>
