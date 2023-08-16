<style>
  .bg-body-tertiary {
    background-image: linear-gradient(to left, #0077c0, #004993);
  }

  .dropdown-menu {
    background-image: linear-gradient(to left, #0077c0, #004993);
  }

  .navbar-nav .nav-link {
    color: white;
    font-weight: bold;
  }

  .dropdown-item {
    color: white;
    font-weight: bold;
  }

  .btn-primary {
    background-image: linear-gradient(to left, #0077c0, #004993);
    color: #fff;
  }

  .btn-secondary {
    background-image: linear-gradient(to left, #628890, #000000);
    color: #fff;
  }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/servicios/sistema/CallCenter/index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/servicios/sistema/RRHH/postulacion.php">Postulación</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/servicios/sistema/CallCenter/metricas.php"></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Perfil
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Cambio de Contraseña</a></li>
            <li><a class="dropdown-item" href="/servicios/sistema/salir.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>