$(document).ready(function() {
    $('#Tdoc').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 10,
        ordering: false, // Desactivar el orden
        language: {
            search: "Buscar"
        }
    } );
    
} );

function guardarMetricas(){
    function verificarCamposCompletos(...campos) {
        return campos.every(campo => campo && campo.trim() !== "");
      }
      
      const campos = {
        fecha: $("#fecha").val(),
        ID: $("#ID").val(),
        Evaluador: $("#Evaluador").val(),
        Caso: $("#Caso").val(),
        Canal: $("#Canal").val(),
        Motivo: $("#Motivo").val(),
        Legajo: $("#select-Legajo").val(),
        AHT: $("#AHT").val(),
        NPC: $("#NPC").val(),
        FCR: $("#FCR").val(),
        OTRO: $("#OTRO").val(),
        obs: $("#ObserTarea").val()
      };
      
      if (!verificarCamposCompletos(...Object.values(campos))) {
        alert("Completar Datos");
      } else {
        const parametros = { ...campos };
        parametros.gMetrica = 1;
        parametros.suma = 0;
        parametros.inputs = [];
      
        for (let x = 1; x < 28; x++) {
          parametros.inputs[x] = $("#select-id" + x).val();          
          if (parametros.inputs[x] !== "100.00") {
            parametros.suma += parseFloat(parametros.inputs[x]) || 0;
          } else {
            parametros.suma = 0;
          }
        }
        
      
        // Realizar la solicitud AJAX para guardar los datos
        $.ajax({
          type: "POST",
          url: '/servicios/sistema/callcenter/metricas/pro/pro.php',
          data: parametros,
          success: function(data) {
            /* Se ejecuta si se ha guardado el registro correctamente */           
            alert("Registro guardado correctamente.");
            setTimeout(function() {
              $(location).attr('href', '/servicios/sistema/callcenter/metricas/index.php');
            }, 0); 
          },
          error: function(xhr, status, error) {
            // Se ejecuta si ha ocurrido un error al guardar el registro
            console.log("Error al guardar el registro.");
          }
        });
      } 
}

function idMetrica (x){    
    let caso = x;
    var parametros = {
        "RCaso": 1,
        caso : caso      
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/metricas/pro/pro.php',
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

function borrarId(x){ 
    var id = x;    
    var parametros = {
        "DelCaso": 1,
        caso : id      
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/metricas/pro/pro.php',
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
                alert(val)
                setTimeout(function() {
                    $(location).attr('href', '/servicios/sistema/callcenter/metricas/index.php');
                }, 0);
            }

            
    })
}


function GEstado(x,y){    
    var ObsTarea = $('#ObsTareaText').val();
    var parametros = {
        "GEstadoCaso": 1,
        x:x,
        y:y,
        "ObsTarea" : ObsTarea      
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/metricas/pro/pro.php',
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
                alert(val)
                setTimeout(function() {
                    $(location).attr('href', '/servicios/sistema/callcenter/metricas/index.php');
                  }, 0);
               
            }

            
    })
}