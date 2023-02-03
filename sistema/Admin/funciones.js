




function LimpiarEstado(){
    $("#EstadoSelect").val('');
    $("#Observacion").val('');
}

/// USUARIO
        let ch = 0;
        let agr = 0;
    //Limpiar Form
    // limpiar Formulario
        function borrar (){
            $("#NombreApe").val('');
            $("#Legajo").val('');
            $("#sector").val(00);
            $("#passw").val('');
            $("#pass").val('');
            $("#telf").val('');
            $("#email").val('');
            $("#nomSector").val('');
            $("#idSector").val('');
        }
    // EDITAR USUARIO
        function EditarUser(leg){
            legajo = leg        
            var parametros = {
                "traerDato": "1",
                "legajo" : legajo     
            };
            console.log(parametros);
        
            $.ajax({
                data: {
                "traerDato": "1",
                "legajo" : legajo
                },
                url: 'phpAdmin.php',
                type: 'POST',
                success: function(val) {
                const x = JSON.parse(val);
                if (x.existe === '1') {                    
                    $("#Legajo").val(x.Usuario)
                    $("#pass").val(x.Contra)
                    $("#passw").val(x.Contra)
                    $("#NombreApe").val(x.NombreApe)
                    $("#sector").val(x.Sector)
                    $("#telf").val(x.Telefono)
                    $("#email").val(x.Email)
                    $('#agregarUser').hide();
                    agr = 1;
                } else {
                    alert("error");
                }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert(`Error: ${errorThrown}`);
                }
            });
        }
        // habilitamos el botón de modificar contraseña            
            $(document).ready(function() {
                // Seleccionamos el elemento de lista de verificación y los elementos de entrada
                const checkbox = $('#myCheckbox');
                const input1 = $('#pass');
                const input2 = $('#passw');            
                // Escuchamos el evento change del elemento de lista de verificación
                checkbox.change(function() {
                // Verificamos si está tildado o no
                if (checkbox.is(':checked')) {
                    // Está tildado, así que habilitamos los elementos de entrada
                    input1.prop('disabled', false);
                    input2.prop('disabled', false);
                    $("#pass").val('');
                    $("#passw").val('');
                    ch = 1;                    
                } else {
                    // No está tildado, así que deshabilitamos los elementos de entrada                
                    input1.prop('disabled', true);
                    input2.prop('disabled', true);
                    $("#pass").val('********');
                    $("#passw").val('********');
                }
                });
            });

        // guardar
                // Verificar contraseña
                    function validContr(){
                        pass1 = $("#pass").val();
                        pass2 = $("#passw").val();
                        if(pass1 == pass2){
                                                    
                        }
                        else{
                            alert('Error en contraseña')
                        }
                    }
            function editUser(){
                Nombre = $("#NombreApe").val();
                Legajo = $("#Legajo").val();
                sector = $("#sector").val();
                passw = ch == 1 ? $("#passw").val() : 0;
                telf = $("#telf").val();
                email = $("#email").val();
                agre = agr;
                var parametros = {
                    "GEditUser" : 1,
                    "Nombre"  : Nombre ,
                    "Legajo"  : Legajo ,
                    "sector"  : sector ,
                    "passw"  : passw ,
                    "telf"  : telf ,
                    "email" : email,
                    "agr" : agre
                }
                console.log(parametros);
                $.ajax({
                    data:  parametros,
                    url:   'phpAdmin.php',
                    type: 'POST',
                    beforeSend: function(){}, 
                
                    error: handleError,
                    
                    complete: function(){},
            
                    success:  function (val)
                        {
                            console.log(val)
                        let x = JSON.parse(val);
                        console.log (x.existe)
                        if (x.existe === '1'){                        
                            alert('Editado Correctamente')                        
                            $('#AgregarUser').modal('hide')
                        }else{
                            alert('No se Editado Correctamente')
                        }
                        } 
                })
            }

    // DAR DE ALTA Y BAJA
        function AltaUser(leg){
            sendAjaxRequest('altaUser', leg, 'Alta Correctamente', 'No se a dado de Alta Correctamente');
        }
        function BajaUser(leg){
            sendAjaxRequest('bajaUser', leg, 'Baja Correctamente', 'No se a dado de Baja Correctamente');
        }
        function sendAjaxRequest(parameter, leg, successMessage, errorMessage) {
            var parametros = {
                [parameter]: 1,                
                "Legajo": leg
            }
            console.log(parametros);
            $.ajax({
                data:  parametros,
                url:   'phpAdmin.php',
                type: 'POST',
                beforeSend: function(){}, 
                error: handleError,
                complete: function(){},
                success:  function (val) {
                console.log(val)
                let x = JSON.parse(val);
                console.log(x.existe)
                if (x.existe === '1'){                        
                    alert(successMessage)
                }else{
                    alert(errorMessage)
                }
                } 
            });
        }

    // AGREGAR USUARIO
      /// Usuario botón agregar
        function AgregarUser(){            
            borrar()
            ch = 1;
            agr = 0;            
            $('#formC').hide();
            const inputElement = document.getElementById('pass');
                inputElement.disabled = false;
            const inputElemen = document.getElementById('passw');
                inputElemen.disabled = false;
        }
      
// SECTOR         
        //Traer datos
            function EditarSector(){
                d = $("#Sect").val(); 
                $.ajax({
                    data: {
                    "traerDatoSector": "1",
                    "id" : d
                    },
                    url: 'phpAdmin.php',
                    type: 'POST',
                    success: function(val) {
                    const x = JSON.parse(val);
                    if (x.existe === '1') {
                        $("#nomSector").val(x.Sector)
                        $("#idSector").val(x.id)
                    } else {
                        alert("error");
                    }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    alert(`Error: ${errorThrown}`);
                    }
                });
            }
        //borrar
            function BorrarSector(){
                d = $("#Sect").val();
                var parametros = {
                    "borrarSector":1,
                    "id" : d
                }
                console.log (parametros);
                $.ajax({
                    data:  parametros,
                    url:   'phpAdmin.php',
                    type: 'POST',
                    beforeSend: function(){}, 
                
                    error: handleError,
                    
                    complete: function(){},
            
                    success:  function (val)
                        {
                           let x = JSON.parse(val);
                           console.log (val)
                           if (x.existe === '1'){
                            alert("borrado correcto")
                            console.log ('ok')
                           }else{
                            alert("error")
                            console.log ('nok')
                           }
                        } 
                })        
            }
        //guardar
            function GuardarSector(){
                id = $("#idSector").val();
                Nom = $("#nomSector").val();
                var parametros = {
                    "GSector" : 1,
                    "id"  : id ,
                    "Nom"  : Nom ,
                }
                console.log(parametros);
                $.ajax({
                    data:  parametros,
                    url:   'phpAdmin.php',
                    type: 'POST',
                    beforeSend: function(){}, 
                
                    error: handleError,
                    
                    complete: function(){},
            
                    success:  function (val)
                        {
                            console.log(val)
                        let x = JSON.parse(val);
                        console.log (x.existe)
                        if (x.existe === '1'){                        
                            alert(' Correctamente')                        
                            $('#SectorModal').modal('hide')
                        }else{
                            alert('Error')
                        }
                        } 
                })
            }
        //Agregar
            function AgregarSector(){
                borrar ();
                $('#SectorModal').modal('show')
            }

//HABITACION
            //seleccion de piso
                function btnPiso(p){
                    console.log("carga")
                    piso = p;
                    $("#idpiso").val(piso)
                    var parametros = {
                        "cargaHab" : 1,
                        "piso" : piso
                        };
                    
                        console.log(parametros)
                        $.ajax({
                            data:  parametros,
                            url:   'phpAdmin.php',
                            type: 'POST',
                            beforeSend: function(){}, 
                    
                            error: handleError,
                            
                            complete: function(){},
                    
                            success:  function (val)
                                {
                                    $('#CargarDatos').html(val)
                                } 
                        })
                }
            //traer datos    
                function IdEstado(numero){
                    n = numero;
                    console.log(n);
                    $("#IdH").val(n);
                    LimpiarEstado()
                }
            //guardar estado
                function GEstadoH(){
                    console.log("gEstadosH")
                    idHab = $("#IdH").val();
                    idest = $("#EstadoSelect").val();
                    obs = $("#Observacion").val();
                    user = $("#usuario").val();
                
                    var parametros = {
                        "editEstadoHab" : 1,
                        "idHab": idHab,
                        "idest": idest,
                        "obs" : obs,
                        "user" : user,
                    }
                    console.log (parametros);
                    $.ajax({
                        data:  parametros,
                        url:   'phpAdmin.php',
                        type: 'POST',
                        beforeSend: function(){}, 
                    
                        error: handleError,
                        
                        complete: function(){},
                
                        success:  function (val)
                            {
                            let x = JSON.parse(val);              
                            if (x.existe === '1'){
                                
                                $('#cambiarEstado').modal('hide')
                                console.log ('ok')
                                p = $("#idpiso").val()
                                btnPiso(p)
                                
                            }else{
                                alert("error")
                                console.log ('nok')
                            }
                            } 
                    }) 
                }
            //Historial 
                function HistorialEstado(numero){    
                    idHab = numero;
                    var parametros = {
                        "cargaHistorialEstado" : 1,
                        "idHab" : idHab
                    };
                    
                    console.log(parametros)
                    $.ajax({
                        data:  parametros,
                        url:   'phpAdmin.php',
                        type: 'POST',
                        beforeSend: function(){}, 
                
                        error: handleError,
                        
                        complete: function(){},
                
                        success:  function (val)
                            {
                                $('#HistorialE').html(val)
                            } 
                    })
                }

//CARGA DE PACIENTE
            //carga
                window.onload = function() {
                    // Obtener los elementos de botón
                    var buttonA = document.getElementById('button-a');
                    var buttonB = document.getElementById('button-b');
                
                    // Agregar un oyente de eventos al botón A que llame a la función guardarHabitacion con los parámetros apropiados cuando se haga clic
                    buttonA.addEventListener('click', function() {
                    guardarHabitacion($("#dniA").val(), $("#nomapeA").val(), $("#telA").val(), 1, $("#idPiso").val(), $("#idHabitacion").val());
                    });
                
                    // Agregar un oyente de eventos al botón B que llame a la función guardarHabitacion con los parámetros apropiados cuando se haga clic
                    buttonB.addEventListener('click', function() {
                    guardarHabitacion($("#dniB").val(), $("#nomapeB").val(), $("#telB").val(), 2, $("#idPiso").val(), $("#idHabitacion").val());
                    });
                }

                function guardarHabitacion(dni, nomape, tel, cama, idPiso, idHabitacion) {
                    var parametros = {
                    "cargarHabitacion": 1,
                    "dni": dni,
                    "nomape": nomape,
                    "tel": tel,
                    "cama": cama,
                    "idPiso": idPiso,
                    "idHabitacion": idHabitacion
                    }
                    console.log(parametros);
                    $.ajax({
                    data: parametros,
                    url: 'phpAdmin.php',
                    type: 'POST',
                    success: function(val) {
                        let x = JSON.parse(val);
                        if (x.existe === '1') {
                        alert('ok')
                        } else {
                        alert("error")
                        }
                    }
                    })
                }
            // alta
                


// ERROR
function handleError(jqXHR, textStatus, errorThrown) {
    switch (jqXHR.status) {
      case 0:
        alert('Not connect: Verify Network.');
        break;
      case 404:
        alert('Requested page not found [404]');
        break;
      case 500:
        alert('Internal Server Error [500].');
        break;
      default:
        alert('Uncaught Error: ' + jqXHR.responseText);
    }
  } 


  ///////////

  $(document).ready(function() {
    // Inicializar objeto MediaStream
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(function(stream) {
        // Cuando el usuario haga clic en el botón de capturar foto...
        $('#capturar-foto').click(function() {
          // Obtener contexto del canvas y dibujar el video en él
          var canvas = document.getElementById('canvas');
          var context = canvas.getContext('2d');
          context.drawImage(video, 0, 0, canvas.width, canvas.height);
  
          // Obtener la imagen del canvas y mostrarla en la página
          var imagen = canvas.toDataURL('image/png');
          $('#imagen').attr('src', imagen);
  
          // Generar archivo Word con el título y la imagen
          var doc = new jsPDF();
          doc.text(20, 20, $('#titulo').val());
          doc.addImage(imagen, 'PNG', 20, 30, 160, 120);
          doc.save('archivo.doc');
        });
      })
      .catch(function(error) {
        console.error('Error al acceder a la cámara:', error);
      });
  });
  