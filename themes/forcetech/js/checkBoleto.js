$(document).ready(function () {

    $("#payment_boleto").click(function (event) {
        event.preventDefault();
        
        //dados do endereço
        var celular = $("#telephone_booking").val();
        var cep = $("#endereco_cep").val();
        var endereco = $("#endereco_endereco").val();
        var numero = $("#endereco_n").val();
        var bairro = $("#endereco_bairro").val();
        var cidade = $("#endereco_cidade").val();
        var uf = $("#endereco_uf").val();        

        if (celular === null || celular === '') {
            notifica('Falta Celular', 'Por favor, INFORME CELULAR ', 'error');//            
            $('#telephone_booking').focus();
            return false;
        } else if (cep === null || cep === '') {
            notifica('Falta CEP', 'Por favor, INFORME CEP ', 'error');            
            $('#endereco_cep').focus();
            return false;
        } else if (endereco === null || endereco === '') {
            notifica('Falta ENDEREÇO', 'Por favor, INFORME ENDEREÇO', 'error');            
            $('#endereco_endereco').focus();
            return false;
        } else if (numero === null || numero === '') {
            notifica('Falta NÚMERO', 'Por favor, Digite INFORME O NÚMERO', 'error');            
            $('#endereco_n').focus();
            return false;
        } else if (bairro === null || bairro === '') {
            notifica('Falta BAIRRO', 'Por favor, Digite INFORME O BAIRRO', 'error');            
            $('#endereco_n').focus();
            return false;
        } else if (cidade === null || cidade === '') {
            notifica('Falta CIDADE', 'Por favor, Digite INFORME A CIDADE', 'error');            
            $('#endereco_cidade').focus();
            return false;
        } else if (uf === null || uf === '') {
            notifica('Falta UF', 'Por favor, Digite INFORME O ESTADO', 'error');            
            $('#endereco_uf').focus();
            return false;
        }        
        if(celular !== null && cep !== null && endereco !== null && numero !== null && bairro !== null && cidade !== null && uf !== null){
            $("#step_pagamento_cartao_credito").hide(500);
            $("#step_pagamento_boleto").show(500);
            $("#step_pagamento_debito").hide(500);
            $("#checkout_payment").show(200);
            $("#policy").show(200);
            $("#tipo_pagamento_selecionado").val("boleto");
        }      
        
    });
});

