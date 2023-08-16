function ver(x) {
    // Redirecciona a la URL con el parámetro x en la cadena de consulta
    $(location).attr('href', '/servicios/sistema/Informes/Cargas/muestra.php?parametro=' + encodeURIComponent(x));
}