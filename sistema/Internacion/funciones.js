function BuscarDNI() {    
    numDNIP = $("#numDNIP").val();

    var parametros = {
        "bscaDNI" : 1,
        "numDNIP": numDNIP
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
                console.log ('ok')
                console.log(x);
                $("#ApellidoP").val(x.Apellido)
                $("#NombreP").val(x.Nombre)
              /*  $("#passw").val(x.Contra)
                $("#NombreApe").val(x.NombreApe)
                $("#sector").val(x.Sector)
                $("#telf").val(x.Telefono)
                $("#email").val(x.Email) */
               }else{
                alert("error")
                console.log ('nok')
               }
            } 
    }) 
}

// acompañante
$(document).ready(function(){
	$('#form input').on('change',function(){
		val = $('input[name=Acomp]:checked','#form').val();
        if (val == 1){
            document.getElementById('cardAcom').style.display = 'block';            
        }else{            
            document.getElementById('cardAcom').style.display = 'none';
                $("#numDNIA").val(" ");
                $("#ApellidoA").val(" ");
                $("#NombreA").val(" ");
                $("#habA").val(" ");
        }
	});	
});

function GuardarPaciente() {
    check = $('input[name=Acomp]:checked','#form').val();
    numDNIP = $("#numDNIP").val();
    ApellidoP = $("#ApellidoP").val();
    NombreP = $("#NombreP").val();
    HabP = $("#HabP").val();    
    numDNIA = $("#numDNIA").val();
    ApellidoA = $("#ApellidoA").val();
    NombreA = $("#NombreA").val();
    habA = $("#habA").val();
    
    var parametros = {
        "cargar": 1,
        "numDNIP" : numDNIP, 
        "ApellidoP" : ApellidoP, 
        "NombreP" : NombreP, 
        "HabP" : HabP, 
        "Acomp" : check, 
        "numDNIA" : numDNIA, 
        "ApellidoA" : ApellidoA, 
        "NombreA" : NombreA, 
        "habA" : habA
    }
    console.log(parametros);

    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            }

            
    })
}

function ph(){
    hab = $("#Hab").val();
    console.log (hab)
    var parametros = {
        "bH" : 1,
        "hab": hab
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
               }else{
                alert('No se Agrego Correctamente')
                console.log ('nok')
               }
            }

            
    })

}
////////////////////////////////////////////////////////////////////////
function pisoSelect(){
    piso = $("#idPiso").val();
    var parametros = {
        "pisoSelect" : 1,
        "piso": piso
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
                    $('#habSelc').html(val)
                } 

            
    })
}
function selecHabitacion(){
    hab = $("#idHabitacion").val();
    var parametros = {
        "habSelect" : 1,
        "hab": hab
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
                console.log ('ok hab')
                $("#dniA").val(x.DniA)
                $("#dniB").val(x.DniB)
                $("#nomapeA").val(x.nomA)
                $("#nomapeB").val(x.nomB)
                $("#telA").val(x.telA)
                $("#telB").val(x.telB) 
               }else{
                alert("error")
                console.log ('nok')
               } 
        } 

            
    })
}
function GuardarA() {
    idPiso = $("#idPiso").val();
    idHabitacion = $("#idHabitacion").val();
    dniA = $("#dniA").val()
    nomapeA = $("#nomapeA").val()
    telA = $("#telA").val()
    var parametros = {
        "cargarHabitacion" : 1,
        "dni" : dniA,
        "nomape" : nomapeA,
        "tel" : telA,
        "cama" : 1,
        "idPiso" : idPiso,
        "idHabitacion" : idHabitacion
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
                alert('ok A')
               
               }else{
                alert("error A")
                
               } 
        } 

            
    })
}
function GuardarB() {
    idPiso = $("#idPiso").val();
    idHabitacion = $("#idHabitacion").val();
    dniB = $("#dniB").val()
    nomapeB = $("#nomapeB").val()
    telB = $("#telB").val()
    var parametros = {
        "cargarHabitacion" : 1,
        "dni" : dniB,
        "nomape" : nomapeB,
        "tel" : telB,
        "cama" : 2,
        "idPiso" : idPiso,
        "idHabitacion" : idHabitacion
    }
    console.log (parametros);
    $.ajax({
        data:  parametros,
        url:   'phpInter.php',
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
                alert('ok B')
               
               }else{
                alert("error B")
                
               } 
        } 

            
    })
}