$(document).ready(function () {

    $("#encrypt").click(function (event) {
        event.preventDefault();

        //dados do cliente no cartão
        var parcelas = $("#parcelas").val();
        var name_card = $("#name_card_bookign").val();
        var card_cpf = $("#name_card_cpf").val();
        var numero_card = $("#number").val();
        var bandeira_card = $("#slBandeira").val();        
        var month_card = $("#month").val();
        var year_card = $("#year").val();
        var cvc_card = $("#cvc").val();       

        if (parcelas === '') {
            notifica('Falta Parcelas', 'SELECIONE A QUANT DE PARCELAS', 'error');
            $('#parcelas').focus();
            return false;
        };
        
        if (name_card === null || name_card === '') {
            notifica('Falta NOME', 'INFORME O NOME DO CLIENTE ', 'error');
            $('#name_card_bookign').focus();
            return false;
        };

        if (card_cpf === null || card_cpf === '') {
            notifica('Falta CPF', 'INFORME O CPF DO CLIENTE', 'error');
            $('#name_card_cpf').focus();
            return false;
        };
        
        if (validarCPF(card_cpf) === false) {
            notifica('CPF INVÁLIDO', 'INFORME UM CPF VÁLIDO', 'error');
            $('#name_card_cpf').focus();
            return false;
        };
        if (numero_card === null || numero_card === '') {
            notifica('Falta NÚMERO', 'INFORME O NÚMERO DO CARTÃO', 'error');
            $('#number').focus();
            return false;
        };
        if (bandeira_card === '') {
            notifica('Falta Bandeira', 'SELECIONE O CARTÃO', 'error');
            $('#slBandeira').focus();
            return false;
        };
        if (month_card === null || month_card === '') {
            notifica('Falta MÊS', 'INFORME O MÊS', 'error');
            $('#month').focus();
            return false;
        };
        if (year_card === null || year_card === '') {
            notifica('Falta ANO', 'INFORME O ANO', 'error');
            $('#year').focus();
            return false;
        };
        if (cvc_card === null || cvc_card === '') {
            notifica('Falta CVC', 'INFORME O CVC', 'error');
            $('#cvc').focus();
            return false;
        };
        
        
        if(parcelas !== null && name_card !== null && card_cpf !== null && numero_card !== null && bandeira_card !== null && month_card !== null && year_card !== null && cvc_card !== null){
            $("#encrypt").hide();
            $("#btnFinalizar").show();            
        }  
    });
    
});

