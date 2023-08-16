function CDatos() {
    var nIngreso = $("#nIngreso").val();
    var fechaC = $("#fechaC").val();

    var n = parseInt($("#n").val()) || 0;


    var formData = new FormData();

    formData.append('nIngreso', nIngreso);
    formData.append('fechaC', fechaC);

    // Append each file input to the formData
    $('input[type="file"]').each(function() {
        formData.append($(this).attr('id'), $(this)[0].files[0]);
    });

    $.ajax({
        url: '/servicios/sistema/Informes/Cargas/pro/pro.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response);

            if (n !== 0) {
                $(location).attr('href', '/servicios/sistema/Informes/Cargas/muestra.php?parametro=' + encodeURIComponent(n));
            }else{
                $(location).attr('href', '/servicios/sistema/Informes/Cargas/');
            }            
            
        }
    });
} 

function CargarDatos() {
    var nIngreso = $("#nIngreso").val();
    var nOIS = $("#nOIS").val();
    var fechaIngreso = $("#fechaIngreso").val();
    var dni = $("#dni").val();
    var nombreApellido = $("#nombreApellido").val();
    var numAfiliado = $("#numAfiliado").val();
    var habitacion = $("#habitacion").val();
    var estado = $("#estado").val();

    var Usuario = document.querySelector('.navbar-text').textContent.trim();



    // Verificar si algún campo está vacío
    if (nIngreso === '' || nOIS === '' || fechaIngreso === '' || dni === '' || nombreApellido === '' || numAfiliado === '' || habitacion === '') {
        alert("Por favor, complete todos los campos obligatorios.");
        return;
    }

    var formData = {
        nIngreso: nIngreso,
        nOIS: nOIS,
        fechaIngreso: fechaIngreso,
        dni: dni,
        nombreApellido: nombreApellido,
        numAfiliado: numAfiliado,
        habitacion: habitacion,
        estado: estado,
        Usuario : Usuario
    };

    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/Cargas/pro/guardar_datos.php",
        data: formData,
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor
            CDatos()
        }
    });
}

function Gestado(){
    var idEstado = $('#idEstado').val();
    var nIngreso = $("#nIngreso").val();
    var parametros = {
        nIngreso: nIngreso,
        idEstado: idEstado,
        mEstado:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/Cargas/pro/guardar_datos.php",
        data: parametros,
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor            
        }
    });
}