function verinfo(numero){
	console.log (numero);
    matricula = numero;   
         
    var parametros = {
        "fbuscar": "1",
        "matricula" : matricula        
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
        type: 'POST',
        success:function(r){
            $('#TodosTurnos').html(r)
        }
    })
}
function select(){
    nombre = $("#Nombre").val();
    Especialidad = $("#Especialidad").val ();
    ObraSocial = $("#ObraSocial").val ();
    Estudios = $("#Estudios").val ();

    if ((Especialidad == 00) && (nombre == 00 ) && (ObraSocial == 00) && (Estudios == 00)){
        console.log ('vacio');
        setTimeout(function(){
            $(location).attr('href','index.php');
            }, 0);
    }else{
        if ((Especialidad != 00) && (nombre == 00 ) && (ObraSocial == 00) && (Estudios == 00)){            
             var parametros = {
                "TablaM": "1",
                "ObraSocial" : ObraSocial,
                "Especialidad" : Especialidad,
                "Nombre" : nombre,
                "Estudios" : Estudios
            };
        }else{
            var parametros = {
                "Tabla": "1",
                "ObraSocial" : ObraSocial,
                "Especialidad" : Especialidad,
                "Nombre" : nombre,
                "Estudios" : Estudios
            };
        }
        
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpSecretaria.php',
            type: 'POST',
            success:function(r){
                $('#misTurnos').html(r)
            }
        })
    }
}

function BorrarFiltro() {
    setTimeout(function(){
        $(location).attr('href','index.php');
        }, 0);
}


///
function verinfo(numero){
	console.log (numero);
    matricula = numero;   
        
    var parametros = {
        "fbuscarMedico": "1",
        "matricula" : matricula        
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
        type: 'POST',
        success:function(r){
            $('#TodosTurnos').html(r)
        }
    })
}

//

function tablaCancelar() {
    NombreM = $("#NombreM").val();    

    var parametros = {
        "addCancelacion" : 1,        
        "NombreM" : NombreM         
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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
                $('#tablaCancelacion').html(val)
            } 
    })  
}

function GCancelar(){
    var nombreDoctor = $("#Nombre").val();
    var tipoCancelacion = $("#tipoCancelacion").val();
    var fechaInicio = $("#fechaInicio").val();
    var fechaFin = $("#fechaFin").val();
    var observacion = $("#observacion").val();
    var parametros = {
        "cancelarG" : 1,  
        "nombreDoctor" : nombreDoctor,
        "tipoCancelacion" : tipoCancelacion,
        "fechaInicio" : fechaInicio,
        "fechaFin" : fechaFin,
        "observacion" : observacion
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success: function(response) {
            alert("Los datos se han guardado correctamente");
            setTimeout(function(){
            $(location).attr('href','cancelarcita.php');
            }, 0);
        } 
    })  

}