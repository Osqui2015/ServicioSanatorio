$(document).ready(function () {
    if ( $.fn.dataTable.isDataTable( '#TPostulantes' ) ) {
        table = $('#TPostulantes').DataTable({
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
        table =$('#TPostulantes').DataTable({
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
});


function Puesto(){
  alert('a')
  var Puesto = $("#select-especialidad").val() || 0;
   var parametros = {
        "Tpuesto": "1",
        "Puesto" : Puesto
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/RRHH/rrhhP.php',
        type: 'POST',
        success:function(r){
            $('#tablaPostulante').html(r)
        }
    })
}