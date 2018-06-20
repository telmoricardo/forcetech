$(document).ready(function (){
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco_endereco").val("");
        $("#endereco_bairro").val("");
        $("#endereco_cidade").val("");
        $("#endereco_uf").val("");
    }
    ///BUSCA CEP
    $("#endereco_cep").blur(function () {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {

            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {

                $("#endereco_endereco").val("...");
                $("#endereco_bairro").val("...");
                $("#endereco_cidade").val("...");

                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        $("#endereco_endereco").val(dados.logradouro);
                        $("#endereco_bairro").val(dados.bairro);
                        $("#endereco_cidade").val(dados.localidade);
                        $("#endereco_uf").val(dados.uf);
                        $("#endereco_n").focus();

                    } //end if.
                    else {
                        limpa_formulário_cep();
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
    ///BUSCA CEP
});  