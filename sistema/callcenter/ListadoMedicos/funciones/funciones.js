$(document).ready(function() {
    $('.select2').select2();
}); 

function MedicSelect(){
  var matricula = $('#Nombre').val();
  console.log (matricula);
    var parametros = {
        "fbuscar": "1",
        "matricula" : matricula        
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/ListadoMedicos/pro/pro.php',
        type: 'POST',
        success:function(r){
            $('#TOBS').html(r) 
        }
    })
}

function verChequeados(x){    
    // Obtener el valor de "Estudio"
    var Estudio = x;

    // Establecer el precio
    var precio = $('#precioMod').val();

    // Obtener los elementos de casilla de verificación seleccionados
    var checkboxes = document.querySelectorAll('.form-check-input:checked');
    var ids = [];
    checkboxes.forEach(function(checkbox) {
        ids.push(checkbox.value);
    });

    // Crear objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // URL del archivo PHP que manejará la edición en la base de datos
    var url = '/servicios/sistema/callcenter/ListadoMedicos/pro/pro.php';

    // Abrir una conexión POST con el archivo PHP
    xhr.open('POST', url, true);

    // Configurar el encabezado de la solicitud
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Crear el objeto de datos a enviar
    var data = {
        estudio: Estudio,
        precio: precio,
        ids: ids
    };

    // Enviar los datos al archivo PHP
    xhr.send('data=' + JSON.stringify(data));

    // Manejar la respuesta del servidor
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // La solicitud se ha completado correctamente
                var response = xhr.responseText;
                console.log(response);
            } else {
                // Ocurrió un error al realizar la solicitud
                console.error('Error: ' + xhr.status);
            }
        }
    };

}

function SelectCambio(){
    var ObraSocial = $('#ObraSocial').val();
    var Especialidad = $('#Especialidad').val();
    var Estudio = $('#Estudio').val();

    var parametros = {
        "tbusqueda": "1",
        "ObraSocial" : ObraSocial,
        "Especialidad" : Especialidad,
        "Estudio" : Estudio
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/ListadoMedicos/pro/pro.php',
        type: 'POST',
       
    success: function(r) {        
        if (isEmpty(r)) {
            console.log("r está vacío");
            verMedico(0)
        } 
            $('#Tmedicos').html(r);
        
}
    })
}


function isEmpty(value) {
    return value === null || value === undefined || value === "";
}

function verMedico(x){
    var parametros = {
        "fbuscar": "1",
        "matricula" : x        
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/callcenter/ListadoMedicos/pro/pro.php',
        type: 'POST',
        success:function(r){
            $('#TOBS').html(r) 
        }
    })
}