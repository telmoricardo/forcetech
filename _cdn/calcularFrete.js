$(document).ready(function () {
   
    enviar = $('form[name="calcular_frete"]');
    action = 'inc/calcularFrete.php';
    enviar.submit(function(){  
        
        var dados = $(this).serialize();
        
        $.ajax({
            
            url: action,
            type: 'POST',
            dataType: 'html',
            data: dados,
            success: function(data){
                var val_frete = data;
                val_frete = val_frete.replace(',', '.');
                
                var total = parseFloat(val_frete);
            
                $('#valor_frete').text(total);
            }
        });
        
        //não faz reload
        return false;
        
    });
    
});


