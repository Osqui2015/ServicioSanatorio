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
    console.log ($("#Nombre").val());
    nombre = $("#Nombre").val();

    console.log ($("#Especialidad").val());
    Especialidad = $("#Especialidad").val ();

    console.log ($("#ObraSocial").val());
    ObraSocial = $("#ObraSocial").val ();

    if ((Especialidad == 00) && (nombre == 00 ) && (ObraSocial == 00)){
        console.log ('vacio');
        setTimeout(function(){
            $(location).attr('href','secretaria.php');
            }, 0);
    }else{
        var parametros = {
            "Tabla": "1",
            "ObraSocial" : ObraSocial,
            "Especialidad" : Especialidad,
            "Nombre" : nombre        
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

function BorrarFiltro() {
    setTimeout(function(){
        $(location).attr('href','secretaria.php');
        }, 0);
}


///
function verinfo(numero){
	console.log (numero);
    matricula = numero;   
        
    var parametros = {
        "fbuscarMedico": "1",
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