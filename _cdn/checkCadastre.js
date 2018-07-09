$(document).ready(function () {
    
    btnCadastro = $("#cadastroUsuario");
    btnValidar = $("#btnUsuario");
//    botao = $('#cadastroUsuario');
//
//    var BASE = "php/crud.php";
//
//    var cadastro = $('.form');

    btnCadastro.click(function (event) {
        event.preventDefault();
        
        //Campos obrigatórios
        var nomeCompleto = $("#nome_completo").val();
        var email = $("#email").val();
        var cpf = $("#name_card_cpf").val();
        var nasc = $("#data_nasc").val();
        var senha = $("#senha").val();
        var senha2 = $("#senha2").val();

        //endereço do usuario
        var telephone_booking2 = $("#telephone_booking2").val();
        var endereco_cep1 = $("#endereco_cep").val();
        var endereco_endereco1 = $("#endereco_endereco").val();
        var endereco_n1 = $("#endereco_n").val();
        var endereco_bairro1 = $("#endereco_bairro").val();
        var endereco_cidade1 = $("#endereco_cidade").val();
        var endereco_uf1 = $("#endereco_uf").val();

        if (nomeCompleto == null || nomeCompleto == '' || nomeCompleto.length <= 5) {
            notifica('Falta nome', 'Preencha o Nome Completo', 'error');
            $('#nome_completo').focus();
            return false;
        }
        if (email == null || email == '' || (email.lastIndexOf("@") < 1) || (email.lastIndexOf(".") < 2)) {
            notifica('Falta E-mail', 'Informe um email válido', 'error');
            $('#email').focus();
            return false;
        }
        if (cpf == null || cpf == '') {
            notifica('Falta CPF', 'Informe o CPF', 'error');
            $('#name_card_cpf').focus();
            return false;
        }
        if (validarCPF(cpf) == false) {
            notifica('CPF INVÁLIDO', 'Informe o CPF válido', 'error');
            $('#name_card_cpf').focus();
            return false;
        }
        if (nasc == null || nasc == '') {
            notifica('Falta Data Nascimento', 'Informe a Data de Nascimento', 'error');
            $('#data_nasc').focus();
            return false;
        }
        if (senha == null || senha == '' || senha.length <= 6) {
            notifica('Falta Senha', 'Senha acima de 7 caracteres', 'error');
            $('#senha').focus();
            return false;
        }
        if (senha2 == null || senha2 == '' || senha2.length <= 6) {
            notifica('Falta Confirmar Senha', 'Confirme a Senha acima de 7 caracteres', 'error');
            $('#senha2').focus();
            return false;
        }
        if (senha != senha2) {
            notifica('Negado', 'Senhas não conferem', 'error');
            $('#senha2').focus();
            return false;
        }
        if (telephone_booking2 == null || telephone_booking2 == '') {
            notifica('Falta número celular', 'Informe um número do celular', 'error');
            $('#telephone_booking2').focus();
            return false;
        }
        if (endereco_cep1 == null || endereco_cep1 == '') {
            notifica('Falta número do CEP', 'Informe seu CEP', 'error');
            $('#endereco_cep').focus();
            return false;
        }
        if (endereco_endereco1 == null || endereco_endereco1 == '') {
            notifica('Falta Endereço', 'Informe seu Endereço', 'error');
            $('#endereco_endereco').focus();
            return false;
        }
        if (endereco_n1 == null || endereco_n1 == '') {
            notifica('Falta número', 'Informe o número no Endereço', 'error');
            $('#endereco_n').focus();
            return false;
        }
        if (endereco_bairro1 == null || endereco_bairro1 == '') {
            notifica('Falta Bairro', 'Informe um Bairro', 'error');
            $('#endereco_bairro').focus();
            return false;
        }
        if (endereco_cidade1 == null || endereco_cidade1 == '') {
            notifica('Falta Cidade', 'Informe sua Cidade', 'error');
            $('#endereco_cidade').focus();
            return false;
        }
        if (endereco_uf1 == null || endereco_uf1 == '') {
            notifica('Falta Estado', 'Informe um Estado', 'error');
            $('#endereco_uf').focus();
            return false;
        }

        if (nomeCompleto != null && email != null) {
            btnCadastro.hide();
            btnValidar.show();
//            
//            cadastro.submit(function () {
//                var formDados = new FormData($(this)[0]);
//                $.ajax({
//                    url: BASE,
//                    type: 'POST',
//                    cache: false,
//                    data: formDados,
//                    contentType: false,
//                    processData: false,
//                    success: function (data) {
//                       
//                        botao.delay(300).fadeOut("slow");
//                        $(".resultado").html(data);
//                        url = "https://localhost/works/cel/minha-conta";
//                        var delay = 1000;
//                        setTimeout(function () {
//                            window.location = url;
//                        }, delay);                        
//                   
//                    },
//                    dataType: 'html'
//                });
//                return false;
//            });
        }
    });
});