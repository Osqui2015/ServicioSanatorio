function carpeta (){
    console.log ('entre')
    var nIngreso = $("#carpeta").val();
    console.log(nIngreso)
    console.log (nIngreso)
        // Cargar el árbol de archivos al cargar la página
        loadFileTree(nIngreso);

        // Función para cargar el árbol de archivos
        function loadFileTree(folder) {
            $.ajax({
                url: 'get_tree.php',
                type: 'POST',
                data: { folder: folder },
                success: function(data) {
                    $('#file-tree').html(data);
                }
            });
        }
        // Manejar clics en botones de carpeta para expandir/contraer
        $(document).on('click', 'li.folder > span', function() {
            $(this).parent().toggleClass('open');
            $(this).siblings('ul').slideToggle();
        });

        // Manejar clics en archivos PDF
        $(document).on('click', 'li.file.pdf > a', function(e) {
            e.preventDefault();
            var filePath = $(this).attr('href');
            showPDF(filePath);
        });

        function showPDF(filePath) {
            $('#pdf-iframe').attr('src', filePath);
            $('#pdf-viewer').css('display', 'block');
        }

        // Cerrar el visor de PDF
        $(document).on('click', '#close-pdf', function() {
            $('#pdf-viewer').css('display', 'none');
        });    
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
        url: "/servicios/sistema/InformeVista/Cargas/pro/mdatos.php",
        data: parametros,
        success: function(response) {                   
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
        url: "/servicios/sistema/InformeVista/Cargas/pro/mdatos.php",
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