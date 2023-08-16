function verificarDatos() {
    var nombreDoctor = $("#select-doctor").val();
    var tipoCancelacion = $("#tipoCancelacion").val();
    var fechaInicio = $("#fechaInicio").val();
    var fechaFin = $("#fechaFin").val();
    var observacion = $("#observacion").val();
  
    if (!nombreDoctor || !tipoCancelacion || !fechaInicio || !fechaFin || !observacion) {
      alert("Faltan completar algunos datos");
    }else{
      GCancelar()
    }
  }


  function GCancelar(){
    var nombreDoctor = $("#select-doctor").val();
    var tipoCancelacion = $("#tipoCancelacion").val();
    var fechaInicio = $("#fechaInicio").val();
    var fechaFin = $("#fechaFin").val();
    var observacion = $("#observacion").val();
    var UsuarioSistema = $("#UsuarioSistema").val();
    var parametros = {
        "cancelarG" : 1,  
        "nombreDoctor" : nombreDoctor,
        "tipoCancelacion" : tipoCancelacion,
        "fechaInicio" : fechaInicio,
        "fechaFin" : fechaFin,
        "observacion" : observacion,
        "UsuarioSistema":UsuarioSistema
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/Cancelaciones/pro/pro.php',
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
            $(location).attr('href','/servicios/sistema/callcenter/Cancelaciones/');
            }, 0);
        } 
    })  

}