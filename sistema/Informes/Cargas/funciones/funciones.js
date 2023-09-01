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
                $(location).attr('href', '/servicios/sistema/Informes/Cargas/index.php');
            }            
            
        }
    });
} 

function Cargars() {
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

function CargarDatos() {
    var formData = new FormData();
    var files = document.querySelectorAll('input[type="file"]');
    
    for (var i = 0; i < files.length; i++) {
        var fileInput = files[i];
        var fileId = fileInput.id; // Obtener el ID del input
        formData.append(fileId, fileInput.files[0]);
    }

    var nIngreso = document.getElementById('nIngreso').value;
    var fechaCarga = document.getElementById('fechaCarga').value;

    if (nIngreso === '' || fechaCarga === '') {
        alert('Por favor, completa Datos.');
    }else{
        var x = document.getElementById('valorParametro').value;
        formData.append('nIngreso', nIngreso);
        formData.append('fechaCarga', fechaCarga);
    
        $.ajax({
            url: '/servicios/sistema/Informes/Cargas/pro/guardar_archivos.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                alert(response);
                $(location).attr('href', '/servicios/sistema/Informes/Cargas/muestra.php?parametro=' + encodeURIComponent(x));
            }
        });
    }

    
}

function addComentarios(){
    var cComentario = $('#cComentario').val();
    var nIngreso = $("#nIngreso").val();
    var Usuario = document.querySelector('.navbar-text').textContent.trim();

    console.log(cComentario)
    console.log(nIngreso)
    var parametros = {
        cComentario: cComentario,
        nIngreso: nIngreso,
        Usuario:Usuario,
        addC:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/Cargas/pro/mdatos.php",
        data: parametros,
        success: function(response) {
           // alert(response); // Muestra la respuesta del servidor            
            $('#cComentario').val(' ');
            verComentario()
        }
    });
}

function verComentario(){
    var nIngreso = $("#nIngreso").val();
    var parametros = {        
        nIngreso: nIngreso,        
        verC:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/Cargas/pro/mdatos.php",
        data: parametros,
        beforeSend: function () {},
        error: function (jqXHR, textStatus, errorThrown) {
            var errorMessage = '';
            if (jqXHR.status === 0) {
                errorMessage = 'No hay conexión: Verifica tu red.';
            } else if (jqXHR.status == 404) {
                errorMessage = 'Página solicitada no encontrada [404]';
            } else if (jqXHR.status == 500) {
                errorMessage = 'Error interno del servidor [500].';
            } else if (textStatus === 'parsererror') {
                errorMessage = 'Error al analizar JSON solicitado.';
            } else if (textStatus === 'timeout') {
                errorMessage = 'Error de tiempo de espera.';
            } else if (textStatus === 'abort') {
                errorMessage = 'Solicitud Ajax cancelada.';
            } else {
                errorMessage = 'Error no capturado: ' + jqXHR.responseText;
            }
            alert(errorMessage);
        },
        complete: function () {},
        success: function (val) {                      
            $('#verTablaCom').html(val);
        }
    });
}