
<style>

</style>

<nav id="main-navbar" class="navbar sticky-top navbar-expand-lg bg-body-tertiary mb-4" style="background-color: white !important;">
  <div class="container-fluid">
      <a class="navbar-brand" href="/servicios/sistema/index.php">
          <img src="imgdos.jpeg" alt="Logo" width="170" height="70">            
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/servicios/sistema/index.php">Inicio</a>
        </li>
        <li class="nav-item" hidden>
          <a class="nav-link" href="/servicios/sistema/index.php">Buscar</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Perfil
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#camContra">Cambiar de Contraseña</a></li>
            <li><a class="dropdown-item" href="/servicios/sistema/salir.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <span class="navbar-text">
      <?php echo $_SESSION['NombreApe'] ?>
    </span>
  </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="camContra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambio de Contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <input type="number" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['usuario'] ?>" hidden>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Contraseña Actual</span>
                <input type="password" class="form-control" id="Actual" placeholder="Actual" aria-label="Actual" aria-describedby="basic-addon1" autocomplete="current-password">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Contraseña Nueva</span>
                <input type="password" class="form-control" id="Nueva" placeholder="Nueva" aria-label="Nueva" aria-describedby="basic-addon1" autocomplete="new-password">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Repetir Contraseña</span>
                <input type="password" class="form-control" id="Repet" placeholder="Repetir" aria-label="Repetir" aria-describedby="basic-addon1" autocomplete="new-password">
            </div>
        </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="guardarBtn">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>








<script>
  // Función para cambiar la clase del navbar al hacer scroll
  function changeNavbarColorOnScroll() {
    const navbar = document.getElementById('main-navbar');
    const offset = 100; // La cantidad de píxeles que el usuario debe hacer scroll para cambiar el color del navbar

    // Agregar o quitar la clase "navbar-scrolled" según el desplazamiento del usuario
    if (window.scrollY > offset) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }
  }

  // Escuchar el evento "scroll" y llamar a la función para cambiar el color del navbar
  window.addEventListener('scroll', changeNavbarColorOnScroll);

  $(document).ready(function() {
    $("#guardarBtn").click(function() {
        var actual = $("#Actual").val();
        var nueva = $("#Nueva").val();
        var repetir = $("#Repet").val();
        var idUsuario = $("#idUsuario").val();

        // Verificar si algún campo está vacío
        if (actual === '' || nueva === '' || repetir === '') {
            alert("Por favor, complete todos los campos.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "cambiar_contra.php",
            data: { actual: actual, nueva: nueva, repetir: repetir, idUsuario: idUsuario },
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    alert(data.message);
                    // Actualizar la página o redirigir después de un cambio exitoso de contraseña
                    $(location).attr('href', '/servicios/sistema/salir.php');
                } else {
                    alert(data.message);                    
                }
            },
            error: function() {
                alert("Ha ocurrido un error en la solicitud.");
            }
        });
    });
});



</script>
