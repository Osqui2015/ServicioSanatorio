<?php
    session_start();
    // echo $_SESSION['tipo'];

    require_once "../../conServicios.php"; 

    $docinfo = mysqli_query($conServicios, "SELECT pr.Matricula,
                                                    pr.NomApe,
                                                    es.Especialidad,
                                                    tp.TipoAtencion,
                                                    pr.Telefono,
                                                    pr.Email,
                                                    pr.HorarioAtencion
                                                    FROM profesional AS pr

                                                    INNER JOIN especialidad AS es
                                                    ON pr.Especialidad = es.Id

                                                    INNER JOIN tipoatencion AS tp
                                                    ON pr.TipoAtencion = tp.id
                                                    
                                                    ORDER BY pr.NomApe");

    $menObraSocial = mysqli_query($conServicios, "SELECT * FROM obrasocial");  //order by Orden 

    $menEstudios = mysqli_query($conServicios, "SELECT * FROM estudios");  //order by Orden 

    $menEspecialidad = mysqli_query($conServicios, "SELECT * FROM Especialidad GROUP BY Especialidad;");

    $menNombre = mysqli_query($conServicios, "SELECT * FROM profesional ORDER BY NomApe;");

    $menCanNombre = mysqli_query($conServicios, "SELECT Matricula, NomApe FROM profesional ORDER BY NomApe;");
?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Turnos</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
    <?php  include_once "dependencias.php" ?>

    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    
    <!-- searchPanes -->
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.0.1/css/searchPanes.dataTables.min.css">
    <!-- select -->
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

</head>
<body>
  <!–– menu -->
    <?php  include_once "menuSecretaria.php" ?>
  <!–– fin menu -->
  <br><br><br>

    <div class="card mx-auto" style="width: 90%; max-width: 400px;">
      <div class="card-body">
        <h5 class="card-title text-center">Cancelación de turno</h5>
       
          <div class="form-group">
            <label for="nombreDoctor">Nombre Doctor:</label>
            <select class="js-select-Nombre custom-select" name="Nombre" id="Nombre">
                <option value="00"> </option>
                <?php while($row=mysqli_fetch_array($menNombre)) { ?>
                <option value="<?php echo utf8_encode($row['Matricula'])?>"><?php echo utf8_encode($row['NomApe'])?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tipoCancelacion">Tipo de Cancelación:</label>
            <select class="form-control" id="tipoCancelacion">
              <option>Enfermedad</option>
              <option>Urgencia</option>
              <option>Vacaciones</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" class="form-control" id="fechaInicio">
          </div>
          <div class="form-group">
            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" class="form-control" id="fechaFin">
          </div>
          <div class="form-group">
            <label for="observacion">Observación:</label>
            <textarea class="form-control" id="observacion" rows="3"></textarea>
          </div>
          <button class="btn btn-primary btn-block" onclick="GCancelar()">Guardar</button>
        
      </div>
    </div>



  <br><br><br><br>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
  <!--   Datatables-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

  <!-- searchPanes   -->
  <script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>
  <!-- select -->
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>        
        
<script>
    $(document).ready(function(){
        $('#reporteTurno').DataTable({

            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                fixedHeader: {
                header: true,
                footer: true,
                },
                ordering: false
        });
         
        $('.js-select-Estudios').select2();
        $('.js-select-ObraSocial').select2();
        $('.js-select-Especialidad').select2();
        $('.js-select-Nombre').select2();
        $('.js-select-NombreM').select2();
        
        
    });
   
</script>
</body>

</html>
