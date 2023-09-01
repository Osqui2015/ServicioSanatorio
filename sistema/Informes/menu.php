
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    body {
        height: 100%;
        background-image:  url("../../img/hero.png"),linear-gradient(to bottom, #0C5195, #0584AB);
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .navbar {
      background-color: transparent !important;
    }

    /* Ajustar el estilo del texto de la marca y los enlaces para resaltar y ser legibles */
    .navbar-brand,
    .navbar-nav .nav-link,
    .navbar-text,
    .navbar-nav .dropdown-item {
      font-family: 'Roboto', sans-serif; /* Aplicar la tipografía Roboto */
        color: white;
        font-weight: bold;
        text-shadow: 4px 2px 3px rgba(0, 0, 0, 0.5);
        font-size: 20px;
        transition: all 0.2s ease-in-out;
    }

    /* Estilo para el texto del perfil */
    .navbar-text {
        margin-left: auto; /* Alinea el texto del perfil a la derecha del navbar */
    }

    /* Cambiar el estilo del enlace activo */
    .navbar-nav .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1); /* Agrega un fondo semi-transparente al enlace activo */
        border-radius: 5px; /* Agrega bordes redondeados al enlace activo */
    }

    /* Estilo para el dropdown */
    .navbar-nav .dropdown-menu {
        background-color: #0C5195; /* Fondo del dropdown */
    }

    .navbar-nav .dropdown-item {
        color: white; /* Color de letra del dropdown */
    }

    .navbar-scrolled {
      background-color: #0C5195 !important;
    }
    .btn-primary {
    background-color: #0C5195 !important;
  }
  label, span {
    font-weight: 600 !important; /* O 700 según tus preferencias */
    font-size: 16px; /* Puedes ajustar este valor según tus preferencias */
  }

</style>

<nav id="main-navbar" class="navbar sticky-top navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/servicios/sistema/index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/servicios/sistema/Informes/Cargas/index.php" hidden>Cargas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/servicios/sistema/Informes/Ver/index.php">Buscar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success" target="_blank" href="https://weliiclientes.gomedisys.com/">Gomedisys</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Perfil
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="/servicios/sistema/salir.php">Cerrar Sesion</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#camContra">Cambio de Contraseña</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <span class="navbar-text">
      <?php echo $_SESSION['NombreApe'] ?>
    </span>
  </div>
</nav>


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
</script>


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

          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Contraseña Actual</span>
            <input type="password" class="form-control"  id="Actual" placeholder="Actual" aria-label="Actual" aria-describedby="basic-addon1">            
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Contraseña Nueva</span>
            <input type="password" class="form-control"  id="Nueva" placeholder="Nueva" aria-label="Nueva" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Repetir Contraseña</span>
            <input type="password" class="form-control" id="Repet" placeholder="Repet" aria-label="Repet" aria-describedby="basic-addon1">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

