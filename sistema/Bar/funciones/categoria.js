function CCategoria(){
    let nom = $("#NomCategoria").val();
    var parametros = {
        "nom": nom,
        "CargarCategoria" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/categoria.php',
        
        type: 'POST',
        success:function(r){
            document.getElementById("NomCategoria").value = "";
            CTabla(0);
        }
    })
}

function CTabla(x){
    var parametros = {
        "x": x,
        "TablaCategoria" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/categoria.php',
        type: 'POST',
        success:function(r){            
            $('#TCategoria').html(r);                
        }
    })
    
    


}

function SelectCategoria(x){
    window.location.href = '/servicios/sistema/Bar/productos.php?valor=' + x;
}