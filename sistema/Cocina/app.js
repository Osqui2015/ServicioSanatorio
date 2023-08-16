
/* COCINA */
function buscarFecha() {
  var startDate = document.getElementById("startDate").value;
  var endDate = document.getElementById("endDate").value;

  console.log("Start Date: " + startDate);
  console.log("End Date: " + endDate);

   var parametros = {
        "startDate" : startDate,
        "endDate" : endDate
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'buscar_fecha.php',
        type: 'POST',
        success:function(r){
            $('#busquedaData').html(r)
        }
    })
}
