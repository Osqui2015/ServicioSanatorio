function btnPiso(p){
    console.log("carga")
    piso = p;
    $("#idpiso").val(piso)
    var parametros = {
        "cargaHab" : 1,
        "piso" : piso
        };
     
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpHotelMuca.php',
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
                    $('#CargarDatos').html(val)
                } 
        })
}

function IdEstado(numero){
    n = numero;
    console.log(n);
    $("#IdH").val(n);
    LimpiarEstado()
}

function GEstadoH(){
    console.log("gEstadosH")
    idHab = $("#IdH").val();
    idest = $("#EstadoSelect").val();
    user = $("#usuario").val()

    var obs = [];  
    $('.get_value').each(function(){  
         if($(this).is(":checked"))  
         {  
            obs.push($(this).val());  
         }  
    });

    var parametros = {
        "editEstadoHab" : 1,
        "idHab": idHab,
        "idest": idest,
        "obs" : obs,
        "user" : user,
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpHotelMuca.php',
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
               let x = JSON.parse(val);              
               if (x.existe === '1'){
                
                $('#cambiarEstado').modal('hide')
                console.log ('ok')
                p = $("#idpiso").val()
                btnPiso(p)
                
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    }) 
}
 
function LimpiarEstado(){
    $("#EstadoSelect").val('');
    $("#Observacion").val('');
}