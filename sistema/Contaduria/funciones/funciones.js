function fechaTurno(){
    var fechaI = document.getElementById('inputFechaI').value
    var fechaF = document.getElementById('inputFechaF').value
    var matriDoc = document.getElementById('matriDoc').value

    var parametros = {
        "BFactMed": 1,
        fechaI:fechaI,
        fechaF:fechaF,
        matriDoc:matriDoc
    };
    
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Contaduria/pro/pro.php',
        type: 'POST',
        beforeSend: function(){}, 
	
        error: function( jqXHR, textStatus, errorThrown ) {

            if (jqXHR.status === 0) {
    
                alert('Not connect: Verify Network.');
    
            } else if (jqXHR.status == 404) {
    
                alert('Requested page not found [404]');
    
            } else if (jqXHR.status == 500) {
    
                alert('Internal Server Error [500].');
    
            } else if (textStatus === 'parsererror') {
    
                alert('Requested JSON parse failed.');
    
            } else if (textStatus === 'timeout') {
    
                alert('Time out error.');
    
            } else if (textStatus === 'abort') {
    
                alert('Ajax request aborted.');
    
            } else {
    
                alert('Uncaught Error: ' + jqXHR.responseText);
    
            }
    
            },
        
        complete: function(){},

        success:  function (val)
            {               
                $('#respuesta').html(val)
            }

            
    })
}