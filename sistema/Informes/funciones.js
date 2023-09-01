function ver(x) {
    // Redirecciona a la URL con el parámetro x en la cadena de consulta
    $(location).attr('href', '/servicios/sistema/Informes/Cargas/muestra.php?parametro=' + encodeURIComponent(x));
}

function VerificarDatos(){
    var nIngreso = $('input[name="NIngreso"]').val();
    var nois = $('input[name="NOIS"]').val();

    var formData = {
        NIngreso: nIngreso,
        NOIS: nois,
        verf:1
    };
        console.log (formData)

    // Realizar la llamada AJAX para guardar los datos 
    $.ajax({
        url: '/servicios/sistema/Informes/pro.php', // Archivo PHP que manejará la inserción en la base de datos
        method: 'POST',
        data: formData,
        success: function(valores) {
            console.log(valores)
            if(valores == 0) //A
            {
                GuardarDatosPaciente()
            }
            else
            {
                alert('Error! N° de Ingreso o N° de OIS repetido')
            }
        }
        
    });
}

function GuardarDatosPaciente() {
    var nIngreso = $('input[name="NIngreso"]').val();
    var nois = $('input[name="NOIS"]').val();
    var fechaIngreso = $('input[name="FechaIngreso"]').val();
    var nDni = $('input[name="NDni"]').val();
    var nombreApellido = $('input[name="NombreApellido"]').val();

    var nAfiliadouno = $('input[name="NAfiliadouno"]').val();
    var nAfiliadodos = $('input[name="NAfiliadodos"]').val();
    var nAfiliadotres = $('input[name="NAfiliadotres"]').val();

    

    var habitacion = $('#Habitacion').val();

    var Usuario = document.querySelector('.navbar-text').textContent.trim();
    
    // Verificar si alguno de los campos está vacío
    if (
      !nIngreso ||
      !nois ||
      !fechaIngreso ||
      !nDni ||
      !nombreApellido ||
      !nAfiliadouno ||
      !nAfiliadodos ||
      !nAfiliadotres ||
      !habitacion ||
      !Usuario
    ) {
      // Crear y mostrar el mensaje de alerta
      var mensaje = "Falta cargar los siguientes datos:\n";
      if (!nIngreso) mensaje += "- Número de Ingreso\n";
      if (!nois) mensaje += "- NOIS\n";
      if (!fechaIngreso) mensaje += "- Fecha de Ingreso\n";
      if (!nDni) mensaje += "- Número de DNI\n";
      if (!nombreApellido) mensaje += "- Nombre y Apellido\n";

      if (!nAfiliadouno) mensaje += "- Número de Afiliado\n";
      if (!nAfiliadodos) mensaje += "- Número de Afiliado\n";
      if (!nAfiliadotres) mensaje += "- Número de Afiliado\n";

      if (!habitacion) mensaje += "- Sector\n";
      if (!Usuario) mensaje += "- Usuario\n";
    
      alert(mensaje);
    } else {
      // Todos los datos están cargados

      var nAfiliado = nAfiliadouno + '-' + nAfiliadodos + '-' + nAfiliadotres;

        var formData = {
                NIngreso: nIngreso,
                NOIS: nois,
                FechaIngreso: fechaIngreso,
                NDni: nDni,
                NombreApellido: nombreApellido,
                NAfiliado: nAfiliado,
                Habitacion: habitacion,
                Usuario:Usuario
        };
            console.log (formData)

        // Realizar la llamada AJAX para guardar los datos 
        $.ajax({
            url: '/servicios/sistema/Informes/guardar_paciente.php', // Archivo PHP que manejará la inserción en la base de datos
            method: 'POST',
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                alert('Datos del paciente guardados correctamente.');
                $(location).attr('href', '/servicios/sistema/Informes/index.php');
            }
        });
    }

    
}

function estadoAct(x) {
  var respuesta = confirm("¿Estás seguro Desactivar?");

  if (respuesta) {
    var parametros = {
        nIngreso: x,
        Es:0,
        mEstado:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/pro.php",
        data: parametros,
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor 
            cTabla()
        }
    });

  } else {
      alert("Presionaste No");
  }
}

function estadoDes(x){
  var respuesta = confirm("¿Estás seguro?");

  if (respuesta) {      
    var parametros = {
        nIngreso: x,
        Es:1,
        mEstado:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/pro.php",
        data: parametros,
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor
            cTabla()
        }
    });

  } else {
      alert("Presionaste No");
  }
}



function cambiarEstado(x, es) {
  var respuesta = confirm("¿Estás seguro?");

  if (respuesta) {
      var parametros = {
          nIngreso: x,
          Es: es,
          mEstado: 1
      };
      $.ajax({
          type: "POST",
          url: "/servicios/sistema/Informes/pro.php",
          data: parametros,
          success: function(response) {
              alert(response); // Muestra la respuesta del servidor     
              $(location).attr('href', '/servicios/sistema/Informes/index.php');       
          }
      });
  } else {
      alert("Presionaste No");
  }
}

function Delete(x, n){
    var respuesta = confirm("¿Estás seguro de Eliminar?");

    if (respuesta) {
        var parametros = {
            nIngreso: n,
            nId: x,
            mDelete: 1
        };
        $.ajax({
            type: "POST",
            url: "/servicios/sistema/Informes/pro.php",
            data: parametros,
            success: function(response) {
                alert(response); // Muestra la respuesta del servidor
                $(location).attr('href', '/servicios/sistema/Informes/index.php');           
            }
        });
    } else {
        alert("Presionaste No");
    }
}


function tabEstado(){
    var estado=$('#tEstado').val();
    console.log(estado)
    var parametros = {        
        estado: estado,        
        verT:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/pro.php",
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
            $('#TablaEstados').html(val);
        }
    });
}

function cTabla(){
    var estado= 3;
    console.log(estado)
    var parametros = {        
        estado: estado,        
        verT:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/pro.php",
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
            $('#TablaEstados').html(val);
        }
    });
}



function estadoActInter(x) {
    var respuesta = confirm("¿Estás seguro?");
  
    if (respuesta) {
      var parametros = {
          nIngreso: x,
          Es:0,
          mEstadoH:1
      }
      $.ajax({
          type: "POST",
          url: "/servicios/sistema/Informes/pro.php",
          data: parametros,
          success: function(response) {
              alert(response); // Muestra la respuesta del servidor 
              cTabla()          
          }
      });
  
    } else {
        alert("Presionaste No");
    }
  }
  
function estadoDesAlta(x){
var respuesta = confirm("¿Estás seguro?");

if (respuesta) {      
    var parametros = {
        nIngreso: x,
        Es:1,
        mEstadoH:1
    }
    $.ajax({
        type: "POST",
        url: "/servicios/sistema/Informes/pro.php",
        data: parametros,
        success: function(response) {
            alert(response); // Muestra la respuesta del servidor
            cTabla()
        }
    });

} else {
    alert("Presionaste No");
}
}


function camSe(x){
    $('#camNIngreso').val(x);
}

function CamEstadoIngreso(){
    var nIngreso = $('#camNIngreso').val();
    var sector = $('#Sector').val();

    if (nIngreso !== '' && sector !== '') {
     
        var parametros = {
            nIngreso: nIngreso,
            sector:sector,
            mEstadoSector:1
        }
        $.ajax({
            type: "POST",
            url: "/servicios/sistema/Informes/pro.php",
            data: parametros,
            success: function(response) {
                alert(response); // Muestra la respuesta del servidor
                cTabla()
            }
        });

    } else {
        alert("Alguno de los campos está vacío.");
    }    
}