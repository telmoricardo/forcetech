window.onload = function () {
    id('telephone_booking').onkeyup = function () {
        mascara(this, mtel);
    }
    id('name_card_cpf').onkeyup = function () {
        mascara(this, mcpf);
    }

//            $("#modal_pagamento").modal("show");
}

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    alert(out);
}