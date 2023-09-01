function ver(x) {
    // Redirecciona a la URL con el parámetro x en la cadena de consulta
    $(location).attr('href', '/servicios/sistema/InformeVista/Cargas/muestra.php?parametro=' + encodeURIComponent(x));
}


