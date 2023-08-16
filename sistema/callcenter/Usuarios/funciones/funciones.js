$(document).ready(function() {
    $('#TUser').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 10,
        ordering: false, // Desactivar el orden
        language: {
            search: "Buscar"
        }
    } );
    
} );

function idEditar(x){
    alert(x)

}

function idDesactivar(x){
    alert(x)
}