$(document).ready(function () {

    $("#payment_card").click(function ()
    {
        $("#step_pagamento_cartao_credito").show(500);
        $("#step_pagamento_boleto").hide(500);
        $("#step_pagamento_debito").hide(500);
        $("#checkout_payment").hide(200);
        $("#bt_continue").show(200);
        $("#tipo_pagamento_selecionado").val("cartao");

    });

    $("#payment_boleto").click(function ()
    {
        $("#step_pagamento_cartao_credito").hide(500);
        $("#step_pagamento_boleto").show(500);
        $("#step_pagamento_debito").hide(500);
        $("#checkout_payment").show(200);
        $("#policy").show(200);
        $("#tipo_pagamento_selecionado").val("boleto");
    });

    $("#payment_debito").click(function ()
    {
        $("#step_pagamento_cartao_credito").hide(500);
        $("#step_pagamento_boleto").hide(500);
        $("#step_pagamento_debito").show(500);
        $("#checkout_payment").show(200);
        $("#policy").show(200);
        $("#tipo_pagamento_selecionado").val("debito");
    });

});