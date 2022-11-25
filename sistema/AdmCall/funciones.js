function verinfo(numero){
	console.log (numero);
    matricula = numero;   
        
    var parametros = {
        "fbuscar": "1",
        "matricula" : matricula        
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
        type: 'POST',
        success:function(r){
            $('#TodosTurnos').html(r)
        }
    })
}
function select(){
    matricula = $("#Nombre").val();
    console.log ($("#Nombre").val());

    console.log ($("#ObraSocial").val());
    ObraSocial = $("#ObraSocial").val ();

    if ((matricula == 00 ) && (ObraSocial == 00)){
        console.log ('vacio');
        setTimeout(function(){
            $(location).attr('href','index.php');
            }, 0);
    }else{
        var parametros = {
            "Tabla": "1",
            "ObraSocial" : ObraSocial,
            "matricula" : matricula        
        };
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpSecretaria.php',
            type: 'POST',
            success:function(r){
                $('#misTurnos').html(r)
            }
        })
    }
}

// botón agregar MEDICO
function btnAgregarMedico(){ 
    document.getElementById('agregarMedico').style.display = 'block';
    document.getElementById('editMedico').style.display = 'none';
}
/// obrasocial botón agregar
function AgregarObraSocial(){  
    document.getElementById('AgregarOB').style.display = 'block';
    document.getElementById('ModiOB').style.display = 'none';
}
// guardar Obra Social
function GuardarObraSocial(){
    nombreObraSocial = $("#nombreObraSocial").val();
    PlanObrasocial = $("#PlanObrasocial").val();    


    var parametros = {
        "GuardarObraSocial": "1",                
        "nombreObraSocial" : nombreObraSocial,
        "PlanObrasocial" : PlanObrasocial,
      
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')
                alert('Agregado Correctamente')
                borrarGuardarObraSocial()
                $('#obraSocial').modal('hide')
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            }

            
    })
    
}
// editar Obra ObraSocial
function editarObraSocial(){
    document.getElementById('AgregarOB').style.display = 'none';
    document.getElementById('ModiOB').style.display = 'block';
    idOS = $("#ObraSocial").val();
    var parametros = {
        "editarOSocial": "1",
        "idOS" : idOS     
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                    $("#PlanObrasocial").val(x.Plan)
                    $("#nombreObraSocial").val(x.Nombre)                    
                    $('#obraSocial').modal('show')
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}

function GuardarObraSocialModi(){
    idOS = $("#ObraSocial").val();
    PlanObrasocial = $("#PlanObrasocial").val();
    nombreObraSocial = $("#nombreObraSocial").val();
    tipoObraSocial = $("#tipoObraSocial").val();
    

    var parametros = {
        "EditarOS": "1",
        "idOS" : idOS,
        "PlanObrasocial" : PlanObrasocial,
        "nombreObraSocial" : nombreObraSocial,
        "tipoObraSocial" : tipoObraSocial        
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')
                alert('Agregado Correctamente')
                borrarGuardarObraSocial()
                $('#obraSocial').modal('hide')
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            } 
    })
}
// limpieza modal obra social
function borrarGuardarObraSocial(){
    $("#PlanObrasocial").val(' ')
    $("#nombreObraSocial").val(' ')
}
// ELIMINAR obrasocial
function BorrarObraSocial(){
    console.log("entre")
    idOS = $("#ObraSocial").val();
    var parametros = {
        "BorrarOS": "1",
        "idOS" : idOS        
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')                
                alert('BORRADO Correctamente')
                $(location).attr('href','index.php');
                
               }else{
                alert('No se BORRO Correctamente')
                console.log ('nok')
               }
            } 
    })
}
// ver obra social de cada medico
function verObraSocialCarga(){
   matricula = $("#matriculaMedicoAlta").val();
   var parametros = {
    "VerObraMedico" : 1,
    "matricula": matricula
    };

    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                $('#ObSocTabla').html(val)
            } 
    })

}
// focus


// VALIDAR MATRICULAR
function validarMatricula(){
    matricula = $("#matriculaMedicoAlta").val();
    var parametros = {
        "ValMatricula" : "1",
        "matricula" : matricula
    }
    console.log(parametros)
}

// GUARDAR medico
function guardarMedico(){
    matricula = $("#matriculaMedicoAlta").val();
    NomApe = $("#NomApe").val();
    Espec = $("#Espec").val();
    Tatencion = $("#Tatencion").val();
    telf = $("#telf").val();
    email = $("#email").val();
    Hatencion = $("#Hatencion").val();
    Consult = $("#Consult").val();
    obs = $("#obsText").val();
    var parametros = {
        "GMedico" : 1,
        "matricula": matricula, 
        "NomApe" : NomApe ,
        "Espec" : Espec ,
        "Tatencion" : Tatencion ,
        "telf" : telf ,
        "email" : email ,
        "Hatencion" : Hatencion ,
        "Consult" : Consult,
        "obs" : obs
        };
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                alert("OK")
                borrar ()
                setTimeout(function(){
                    $(location).attr('href','secretaria.php');
                    }, 0);
                $('#Agregar').modal('hide')
                   
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}

// BORRAR MÉDICOS BorrarMedico()
function BorrarMedico(){
    console.log("entre Borrar Medico")
    matricula = $("#Nombre").val();
    var parametros = {
        "BorrarMedico": "1",
        "matricula" : matricula        
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')                
                alert('BORRADO Correctamente')
                $(location).attr('href','index.php');
                
               }else{
                alert('No se BORRO Correctamente')
                console.log ('nok')
               }
            } 
    })
}

// EDITAR MEDICO Traer datos
function EditarMedico(){

    document.getElementById('agregarMedico').style.display = 'none';
    document.getElementById('editMedico').style.display = 'block';

    matricula = $("#Nombre").val();    
    var parametros = {
        "editarMedico": "1",
        "matricula" : matricula     
    };
    console.log(parametros);

    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                    $("#matriculaMedicoAlta").val(x.Matricula)
                    $("#NomApe").val(x.NomApe)
                    $("#Espec").val(x.Especialidad)
                    $("#Tatencion").val(x.TipoAtencion)
                    $("#telf").val(x.Telefono)
                    $("#email").val(x.Email)
                    $("#Hatencion").val(x.HorarioAtencion)
                    $("#Consult").val(x.Consultorio)
                    var inputNombre = document.getElementById("obsText");
                        inputNombre.value = x.Obs;                    
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })

}

// Guardar medico Editado
function guardarMedicoEdit(){
    matricula = $("#matriculaMedicoAlta").val();
    NomApe = $("#NomApe").val();
    Espec = $("#Espec").val();
    Tatencion = $("#Tatencion").val();
    telf = $("#telf").val();
    email = $("#email").val();
    Hatencion = $("#Hatencion").val();
    Consult = $("#Consult").val();
    obs = $("#obsText").val();
    var parametros = {
        "GMedicoEditado" : 1,
        "matricula": matricula, 
        "NomApe" : NomApe ,
        "Espec" : Espec ,
        "Tatencion" : Tatencion ,
        "telf" : telf ,
        "email" : email ,
        "Hatencion" : Hatencion ,
        "Consult" : Consult,
        "obs" : obs
        };
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                alert("OK")
                borrar ()
                $('#Agregar').modal('hide')
                   
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}


// agrega obra social al medico correspondiente.
function AgregarOBSocMedico(){        
    matriculaMedicoAlta = $("#matriculaMedicoAlta").val();
    OBSocSelect = $("#ObraSocialAgregar").val();
    Importe = $("#ObraSocialImporte").val();
    tipoObraSocial = $("#tipoObraSocial").val();
    EstudiosAgregar = $("#EstudiosAgregar").val();
    EstudiosImporte = $("#EstudiosImporte").val();

    var parametros = {
        "AgregarOBSOC" : 1,
        "OBSocSelect": OBSocSelect,
        "matriculaMedicoAlta" : matriculaMedicoAlta,
        "Importe": Importe,
        "tipoObraSocial": tipoObraSocial,
        "EstudiosAgregar" : EstudiosAgregar,
        "EstudiosImporte" : EstudiosImporte
    };

    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                verObraSocialCarga()
                console.log ('ok')
                alert("OK")
                   
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}

// limpiar Formulario
function borrar (){
    $("#matriculaMedicoAlta").val(' ');
    $("#NomApe").val(' ');
    $("#Espec").val(00);
    $("#Tatencion").val(' ');
    $("#telf").val(' ');
    $("#email").val(' ');
    $("#Hatencion").val(' ');
    $("#Consult").val(' ');
}



function GuardarEstudio(){

}
// SECTOR USUARIO

function selectUser(){
    Legajo = $("#Nombre").val();
    console.log ($("#Nombre").val());

    console.log ($("#ObraSocial").val());
    Sect = $("#Sect").val ();

    if ((Legajo == 00 ) && (Sect == 00)){
        console.log ('vacio');
        setTimeout(function(){
            $(location).attr('href','usuarios.php');
            }, 0);
    }else{
        var parametros = {
            "TablaUser": "1", 
            "Sect" : Sect,
            "Legajo" : Legajo        
        };
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpSecretaria.php',
            type: 'POST',
            success:function(r){
                $('#misTurnos').html(r)
            }
        })
    }
}
/// Usuario botón agregar
function AgregarUser(){  
    document.getElementById('agregarUser').style.display = 'block';
    document.getElementById('editUser').style.display = 'none';
}
/// Usuario botón Editar y Traer datos usuario
function EditarUser(){  
    document.getElementById('btnGuardar').style.display = 'block';
    document.getElementById('agregarUser').style.display = 'none';
    document.getElementById('editUser').style.display = 'block';
    Legajo = $("#Nombre").val();    
    var parametros = {
        "editarUser": "1",
        "Legajo" : Legajo     
    };
    console.log(parametros);

    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                    $("#Legajo").val(x.Usuario)
                    $("#pass").val(x.Contra)
                    $("#passw").val(x.Contra)
                    $("#NombreApe").val(x.NombreApe)
                    $("#sector").val(x.Sector)
                    $("#telf").val(x.Telefono)
                    $("#email").val(x.Email)                    
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })


}

// Guardar Usuario
function guardarUser(){
    Nombre = $("#NombreApe").val();
    Legajo = $("#Legajo").val();
    sector = $("#sector").val();
    passw = $("#passw").val();
    telf = $("#telf").val();
    email = $("#email").val();
    if (sector == 0 ){
        tipo = 1
    }else{
        tipo = 2
    }
    var parametros = {
        "GUser" : 1,
        "Nombre"  : Nombre ,
        "Legajo"  : Legajo ,
        "sector"  : sector ,
        "passw"  : passw ,
        "telf"  : telf ,
        "email" : email,
        "tipo" : tipo 
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')
                alert('Agregado Correctamente')
                
                $('#AgregarUser').modal('hide')
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            } 
    })
}
function guardarUserEdit(){
    Nombre = $("#NombreApe").val();
    Legajo = $("#Legajo").val();
    sector = $("#sector").val();
    passw = $("#passw").val();
    telf = $("#telf").val();
    email = $("#email").val();
    var parametros = {
        "GEditUser" : 1,
        "Nombre"  : Nombre ,
        "Legajo"  : Legajo ,
        "sector"  : sector ,
        "passw"  : passw ,
        "telf"  : telf ,
        "email" : email 
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')
                alert('Editado Correctamente')
                
                $('#AgregarUser').modal('hide')
               }else{
                alert('No se Editado Correctamente')
                console.log ('nok')
               }
            } 
    })
}

// borrar Username
function BorrarUSer(){
    Legajo = $("#Nombre").val();    
    var parametros = {
        "BorrarUser": "1",
        "Legajo" : Legajo     
    };
    console.log(parametros);

    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                alert ('ok')                                      
               }else{
                alert("error")                
               }
            } 
    })
}

// comparar contraseñas Agregar Username

function validContr () {
	pass1 = $("#pass").val();
	pass2 = $("#passw").val();
	if(pass1 == pass2){
		alert('correcto')
        document.getElementById('btnGuardar').style.display = 'block';        
	}
	else{
		alert('Error')
	}
}

// botón agregar sector
function AgregarSector() {
    document.getElementById('GuardarSector').style.display = 'block';
    document.getElementById('GuardarSectorModi').style.display = 'none';
}
// sector guardar
function GuardarSector(){
    nomSector = $("#nomSector").val();

    var parametros = {
        "Gsector" : 1,
        "nomSector": nomSector
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')
                alert('Agregado Correctamente')                
                $('#SectorModal').modal('hide')
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            }

            
    })
}


// btn editar costo traer datos
function EditarOBS(nume){
  
    console.log (nume)
    var parametros = {
        "editTraerObsMedico":1,
        "nume" : nume
    }
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);               
               if (x.existe == '1'){
                console.log ('ok') 
                $("#editarCostoO").val(x.Costo)
                $("#text").val(x.id)
                $("#editarCostoE").val(x.CostoEstudio)
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}
// guardar editar consto
function GuardarEditarOBS(){
    id = $("#text").val();
    editarCostoO = $("#editarCostoO").val();
    editarCostoE = $("#editarCostoE").val();
    var parametros = {
        "GuardarEditarOBS" : 1,
        "id" : id,
        "editarCostoO" : editarCostoO,
        "editarCostoE" : editarCostoE
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);               
               if (x.existe == '1'){
                console.log ('ok')
                verObraSocialCarga()
                $('#editarCostoOBS').modal('hide')
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}

function BorrarOBS(nume){
    alert ("Borrar")
    console.log (nume)
    var parametros = {
        "deleteObsMedico":1,
        "nume" : nume
    }
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                verObraSocialCarga()
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })

}

// ESPECIALIDAD
function AgregarEstudios (){	
    document.getElementById('agregarEstudio').style.display = 'block';
    document.getElementById('editEstudio').style.display = 'none';
}
function editarEstudios (){
    document.getElementById('agregarEstudio').style.display = 'none';
    document.getElementById('editEstudio').style.display = 'block';
    idEs = $("#Estudios").val();
    var parametros = {
        "editarVerEstudios": "1",
        "idEs" : idEs     
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               console.log (val)
               if (x.existe === '1'){
                console.log ('ok')
                    $("#nombreEstudio").val(x.Estudios)
                    $('#estudios').modal('show')
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}
function GuardarEstudio() {
    nomEstudio = $("#nombreEstudio").val();    
    var parametros = {
        "GuardarEstudio" : 1,
        "nomEstudio" : nomEstudio
        
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               if (x.existe == '1'){
                console.log ('ok')                
                $('#estudios').modal('hide')
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}

function BorrarEstudios (){
    idEs = $("#Estudios").val();
    var parametros = {
        "BorrarEstudio": "1",
        "idEs" : idEs        
    };
    console.log (parametros);   
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
                console.log(val)
               let x = JSON.parse(val);
               console.log (x.existe)
               if (x.existe === '1'){
                console.log ('ok')                
                alert('BORRADO Correctamente')
                $(location).attr('href','index.php');
                
               }else{
                alert('No se BORRO Correctamente')
                console.log ('nok')
               }
            } 
    })
}
function GuardarEstudioModi(){
    idEs = $("#Estudios").val();
    nomEs = $("#nombreEstudio").val();
    var parametros = {
        "GuardarEditarEstudio" : 1,
        "nomEs" : nomEs,
        "idEs":idEs
        
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               if (x.existe == '1'){
                console.log ('ok')                
                $('#estudios').modal('hide')
                setTimeout(function(){
                    $(location).attr('href','index.php');
                    }, 0);
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })
}


// cancelar Turnos
function btnCancelar(){
    tablaCancelar()
}
function Cancelar(){
    obsCancelacion = $("#obsCancelacion").val();
    NombreM = $("#NombreM").val();
    fechaCancelacion = $("#fechaCancelacion").val();

    var parametros = {
        "addCancelacion" : 1,
        "obsCancelacion" : obsCancelacion,
        "NombreM" : NombreM ,
        "fechaCancelacion" : fechaCancelacion 
    }
    console.log(parametros);
    $.ajax({
        data:  parametros,
        url:   'phpSecretaria.php',
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

        success:  function (val)
            {
               let x = JSON.parse(val);
               if (x.existe == '1'){
                    console.log ('ok')
                        tablaCancelar()
                    $("#obsCancelacion").val('');
                    $("#NombreM").val('');
                    $("#fechaCancelacion").val('');
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    })

}
function tablaCancelar(){
    var parametros = {
        "VerTablaCancelar" : 1        
        };
    
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpSecretaria.php',
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
    
            success:  function (val)
                {
                    $('#tablaCancelacion').html(val)
                } 
        })  
}