function btnPiso(p){
    console.log("carga")
    piso = p;
    var parametros = {
        "cargaHab" : 1,
        "piso" : piso
        };
      
        console.log(parametros)
        $.ajax({
            data:  parametros,
            url:   'phpHotel.php',
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
                    $('#CargarDatos').html(val)
                } 
        })
}

function btnAgregarHab(){
    console.log('btnAgregarHab')
    h = $("#MenHab").val();
    console.log(h)
    p = $("IdHab").val(h);
    console.log(p)
    document.getElementById('IdHab').value=h;
    
}


function IdEstado(numero){
    n = numero;
    console.log(n);
    $("#IdH").val(n);
    LimpiarEstado()
}

function GEstadoH(){
    idHab = $("#IdH").val();
    idest = $("#EstadoSelect").val();
    obs = $("#Observacion").val()

    var parametros = {
        "editEstadoHab" : 1,
        "idHab": idHab,
        "idest": idest,
        "obs" : obs
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpHotel.php',
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
               if (x.existe === '1'){
                
                $('#cambiarEstado').modal('hide')
                console.log ('ok')
                p = $("#IdPiso").val()
                btnPiso(p)
                
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    }) 
}
function LimpiarEstado(){
    $("#EstadoSelect").val('');
    $("#Observacion").val('');
}

function HistorialEstado(numero){    
    idHab = numero;
    var parametros = {
        "cargaHistorialEstado" : 1,
        "idHab" : idHab
    };
    
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpHotel.php',
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
                $('#HistorialE').html(val)
            } 
    })
}




function GuardarAñadirHab(){
    console.log("Guardar Añadir")
    habitacion = $("#MenHab").val();
    estado = $("#EstadoSelectAdd").val();
    tipo = $("#TipoHabAdd").val();

    var parametros = {
        "AddHabitacion" : 1,
        "habitacion" : habitacion ,
        "estado" : estado ,
        "tipo" : tipo
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpHotel.php',
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
               if (x.existe === '1'){                
                $('#AddHabitacion').modal('hide')
                console.log ('ok')  
                p = $("#IdPiso").val()
                btnPiso(p)              
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    }) 


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
            url:   'phpHotel.php',
            type: 'POST',
            success:function(r){
                $('#misTurnos').html(r)
            }
        })
    }
}
/// Usuario botón agregar
function AgregarUser(){      
    document.getElementById('btnGuardar').style.display = 'block';
    document.getElementById('btnagregarUser').style.display = 'block';
    document.getElementById('editUser').style.display = 'none';
}

/// Usuario botón Editar y Traer datos usuario
function EditarUser(){  
    document.getElementById('btnGuardar').style.display = 'block';
    document.getElementById('btnagregarUser').style.display = 'none';
    document.getElementById('editUser').style.display = 'block';
    Legajo = $("#Nombre").val();    
    var parametros = {
        "editarUser": "1",
        "Legajo" : Legajo     
    };
    console.log(parametros);

    $.ajax({
        data:  parametros,
        url:   'phpHotel.php',
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
    tipo = 1
 
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
        url:   'phpHotel.php',
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
        url:   'phpHotel.php',
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
        url:   'phpHotel.php',
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
        url:   'phpHotel.php',
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
        url:   'phpHotel.php',
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
    var parametros = {
        "GuardarEditarOBS" : 1,
        "id" : id,
        "editarCostoO" : editarCostoO
    }
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   'phpHotel.php',
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
        url:   'phpHotel.php',
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


