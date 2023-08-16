$(document).ready(function () {    
    

    if ( $.fn.dataTable.isDataTable( '#Tdoc' ) ) {
        table = $('#Tdoc').DataTable({
         language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
         },
            ordering: false,
        });
    }
    else {
        table =$('#Tdoc').DataTable({
         language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
        },
        ordering: false,
    });
    }


   $('#Tos').DataTable({
            language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
            },
            ordering: false,
        });
   



    $('#select-estudios').select2();
    $('#select-especialidad').select2();
    $('#select-os').select2();
    $('#select-doctor').select2();
});

function tdoc(x){
    Especialidad = $("#select-especialidad").val() || 0;
    ObraSocial = $("#select-os").val() || 0;
    Estudios = $("#select-estudios").val() || 0;
 

    var parametros = {
        "TMedico": "1",
        "x" : x,
        "ObraSocial" : ObraSocial,
        "Especialidad" : Especialidad,                
        "Estudios" : Estudios
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/CallCenter/callPHP.php',
        type: 'POST',
        success:function(r){
            $('#tablaDoc').html(r)
        }
    })

}

function infoDoc(x){
    var parametros = {
        "TInfo": "1",
        "x" : x
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/CallCenter/callPHP.php',
        type: 'POST',
        success:function(r){
            $('#tablaInfo').html(r)
        }
    })
}


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
        url:   '/servicios/sistema/CallCenter/callPHP.php',
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
            $(location).attr('href','/servicios/sistema/CallCenter/canCitas.php');
            }, 0);
        } 
    })  

}
function idMetrica(x){
    carduno(x)
    pregyresp(x)
}
function carduno(x){
    var parametros = {
        "Tcard": "1",
        "x" : x
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/CallCenter/callPHP.php',
        type: 'POST',
        success:function(r){
            $('#card1').html(r)
        }
    })
}
 
function pregyresp(x){    
    var parametros = {
        "Tpreguntas": "1",
        "x" : x
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/CallCenter/callPHP.php',
        type: 'POST',
        success:function(r){
            $('#preguntas').html(r)
        }
    })
}

function Cmetricas(){    
    fecha = $("#fecha").val();
    alert (fecha)
    caso = $("#n-caso").val();
    alert (caso)
}