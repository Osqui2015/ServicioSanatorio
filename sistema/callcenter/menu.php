<style>
  .navbar-custom {
    background: rgb(34, 95, 173);
    background: linear-gradient(90deg, rgba(34, 95, 173, 0.964) 56%, rgba(176, 194, 242, 1) 100%);
  }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="/servicios/sistema/callcenter/">
      <img src="/servicios/sistema/callcenter/Logo.png" class="img-fluid" style="width: 180px; height: 70px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/ListadoMedicos/">Listado Medico</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/Metricas/">Metricas</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/Turnos/">Turnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/Cancelaciones/">Cancelaciones</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" aria-current="page" href="/servicios/sistema/callcenter/Usuarios/">Usuarios</a>
        </li>       
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" href="./../salir.php">Cerrar Sesion</a>
        </li> 
      </ul>
      <span class="navbar-text fw-bold" id="user">
        Usuario: <?php  echo $_SESSION['NombreApe'] ?>
      </span>
    </div>
  </div>
</nav>
<br><br>