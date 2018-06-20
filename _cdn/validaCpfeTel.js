window.onload = function () {
    if (typeof telephone_booking != 'undefined') {
        id('telephone_booking').onkeyup = function () {
            mascara(this, mtel);
        };
    }

    if (typeof telephone_booking2 != 'undefined') {
        id('telephone_booking2').onkeyup = function () {
            mascara(this, mcel);
        };
    }

    if (typeof name_card_cpf != 'undefined') {
        id('name_card_cpf').onkeyup = function () {
            mascara(this, mcpf);
        };
    }

    if (typeof data_nasc != 'undefined') {
        id('data_nasc').onkeyup = function () {
            console.log(mascara(this, mdata));
        };
    }


};

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    alert(out);
}