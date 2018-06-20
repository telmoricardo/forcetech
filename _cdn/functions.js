//Notification
function notifica(titulo, mensagem, tipo)
{
    if (tipo == 'success')
    {
        toastr.success(mensagem, titulo);
    } else if (tipo == 'info')
    {
        toastr.info(mensagem, titulo);
    } else if (tipo == 'warning')
    {
        toastr.warning(mensagem, titulo);
    } else if (tipo == 'error')
    {
        toastr.error(mensagem, titulo);
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}
///Notification

/* Máscaras TELEFONE */
function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}
function mtel(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function mcel(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function mcpf(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito    
    v = v.replace(/(\d)(\d{8})$/, "$1.$2");   
    v = v.replace(/(\d)(\d{5})$/, "$1.$2");    
    v = v.replace(/(\d)(\d{2})$/, "$1-$2");   
    return v;
}
function mnasc(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito    
    v = v.replace(/(\d)(\d{6})$/, "$1/$2");    //Coloca hífen entre o quarto e o quinto dígitos  
    v = v.replace(/(\d)(\d{4})$/, "$1/$2");    //Coloca hífen entre o quarto e o quinto dígitos  
    
    return v;
}
function id(el) {
    return document.getElementById(el);
}
function mdata(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");

    v = v.replace(/(\d{2})(\d{2})$/, "$1$2");
    return v;
}
/* Máscaras TELEFONE */

 