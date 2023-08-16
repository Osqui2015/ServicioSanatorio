$(document).ready(function() {
    $('#tablaHab').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 25,
        language: {
            search: "Buscar"
        },
        columnDefs: [
            {
                targets: 4,
                render: DataTable.render.date(),
            },
        ],
    } );
} );

function piso(x){ 
    piso = x;
    var parametros = {
        "cargaHab" : 1,
        "piso" : piso
    };
    console.log(parametros)
    $.ajax({
        data: parametros,
        url: 'procesos.php',
        type: 'POST'
    })
    .done(function(val) {
        $('#cardHab').html(val); 
    })
        .fail(function(jqXHR, textStatus, errorThrown) {
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
    });
      
}

function CamEstado(x){
    var paragraph = document.getElementById("NumHab");    
    paragraph.innerHTML = x;
    
  // Obtener el valor del span
  let valorSpan = document.getElementById('NumHab').textContent;

  // Convertir el valor en un número entero
  let numero = parseInt(valorSpan);

  if (numero >= 0) {
    document.getElementById('salidaPositiva').removeAttribute('hidden');
    document.getElementById('salidaNegativa').setAttribute('hidden', '');

    document.getElementById('PositivoG').removeAttribute('hidden');
    document.getElementById('NegativoG').setAttribute('hidden', '');
  } else {
    document.getElementById('salidaNegativa').removeAttribute('hidden');
    document.getElementById('salidaPositiva').setAttribute('hidden', '');

    document.getElementById('NegativoG').removeAttribute('hidden');
    document.getElementById('PositivoG').setAttribute('hidden', '');
  }

}

function LimpiarEstado (){
    $("#selectEstado").val('');
    $("#ObsHab").val('');
}



function GEstadosHab(){
  var span = document.getElementById("NumHab");
  var valorSpan = span.textContent;

  SEstado = $("#selectEstado").val();
  ObsHab = $("#ObsHab").val();
  var user = document.getElementById("pContent").textContent;
  
    var parametros = {
        "EstadoHab" : 1,
        "SEstado" : SEstado,
        "valorSpan" : valorSpan,
        "ObsHab" : ObsHab,
        "user" : user
    };
  console.log(parametros)
    $.ajax({
        data: parametros,
        url: 'procesos.php',
        type: 'POST'
    })
    .done(function(val) {                
        let primerNumero = Math.abs(valorSpan).toString().substring(0, 1);
        LimpiarEstado();
        piso(primerNumero);        
    })
        .fail(function(jqXHR, textStatus, errorThrown) {
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
    });
}

function ReportePiso(x){
    piso = x; 
    var parametros = {
        "cargaReporteHab" : 1,
        "piso" : piso
    }; 
    console.log(parametros)
    $.ajax({
        data: parametros,
        url: '/servicios/sistema/AdmHotel/procesos/reporte.php',
        type: 'POST'
    })
    .done(function(val) {
        $('#TabReporte').html(val);
    })
        .fail(function(jqXHR, textStatus, errorThrown) {
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
    });
}


function HHab(x){
    
    var parametros = {
        "cargaHisHab" : 1,
        "piso" : x
    };
    console.log(parametros)
    $.ajax({
        data: parametros,
        url: 'procesos.php',
        type: 'POST'
    })
    .done(function(val) {
        $('#tablaHabi').html(val);
        let primerNumero = Math.abs(x).toString().substring(0, 1);
        piso(primerNumero)
    })
        .fail(function(jqXHR, textStatus, errorThrown) {
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
    });
} 




function GEstadosHabOffice() {
    var selectElement = document.getElementById("selectEstadoNeg");
    var SEstado = selectElement.value;        


    var span = document.getElementById("NumHab");
    var valorSpan = span.textContent;
      
    ObsHab = $("#ObsHab").val();
    var user = document.getElementById("pContent").textContent;
    
      var parametros = {
          "EstadoHab" : 1,
          "SEstado" : SEstado,
          "valorSpan" : valorSpan,
          "ObsHab" : ObsHab,
          "user" : user
      };
    console.log(parametros)
      $.ajax({
          data: parametros,
          url: 'procesos.php',
          type: 'POST'
      })
      .done(function(val) {                
          let primerNumero = Math.abs(valorSpan).toString().substring(0, 1);
          LimpiarEstado();
          piso(primerNumero);        
      })
          .fail(function(jqXHR, textStatus, errorThrown) {
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
      });






    
}
