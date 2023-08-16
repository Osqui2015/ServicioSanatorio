function CProductos(){
    let NombreP = $("#NombreP").val();
    let PrecioUno = $("#PrecioUno").val();
    let categoria = $("#Categoria").val();
    let SubT = $("#SubT").val();
    let ListT = $("#ListT").val();
    let idP = $("#idP").val();
    if (!SubT) {
        SubT = 0;
    }
      
    if (!ListT) {
        ListT = 0;
    }

if (idP == 0){
    var parametros = {
        "NombreP": NombreP,
        "PrecioUno" : PrecioUno,
        "categoria" : categoria,
        "CargarProductos" : 1,
        "SubT" : SubT ,
        "ListT" : ListT,
        "idP" : idP
    };
}else{
    var parametros = {
        "NombreP": NombreP,
        "PrecioUno" : PrecioUno,
        "categoria" : categoria,
        "EditCargarProductos" : 1,
        "SubT" : SubT ,
        "ListT" : ListT,
        "idP" : idP
    };
}

    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/productos.php',
        type: 'POST',
        success:function(r){
            limpiar()
            PTabla();
        }
    })
}

function PTabla(){
    let categoria = $("#Categoria").val();
    var parametros = {
        "categoria": categoria,
        "TablaProductos" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/productos.php',
        type: 'POST',
        success:function(r){            
            $('#TProductos').html(r);                
        }
    })
    
    


}
function EditProductos (x) {    
    var parametros = {        
        x : x ,
        "EditarP" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/productos.php',
        type: 'POST',
        success:function(r){
            limpiar()
            PTabla();
            var response = JSON.parse(r); // Convertir la cadena JSON en un objeto JavaScript
            document.getElementById("NombreP").value = response.Nombre;
            document.getElementById("PrecioUno").value = response.PrecioUno;
            document.getElementById("SubT").value = response.SubTitulo;
            document.getElementById("ListT").value = response.Listado;
            document.getElementById("idP").value = response.Id;
        }
    })
}

function DeleteProductos (x) {    
    var parametros = {        
        x : x ,
        "Desactivar" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/productos.php',
        type: 'POST',
        success:function(r){
            limpiar()
            PTabla();
            alert ('Producto Desabilitado')
        }
    })

}
function ActProductos (x) {    
    var parametros = {        
        x : x ,
        "Activar" : 1
    };
    console.log(parametros)
    $.ajax({
        data:  parametros,
        url:   '/servicios/sistema/Bar/procesos/productos.php',
        type: 'POST',
        success:function(r){
            limpiar()
            PTabla();
            alert ('Producto Activado')
        }
    })

}

function SelectProductos (x) {
    alert(x)
}

function limpiar (){
    document.getElementById("NombreP").value = "";
    document.getElementById("PrecioUno").value = "";
    document.getElementById("SubT").value = "";
    document.getElementById("ListT").value = "";
    document.getElementById("idP").value = "0";
}