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
            <div class="d-flex align-items-center h-100">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col"><h5 class="card-title">Nombre Medico </h5></div>
                            <div class="col">
                            <select class="js-select-Nombre custom-select" name="nombreDoctor" id="nombreDoctor" onchange="select()">
                                <option value="00">TODOS</option>
                                <?php while($row=mysqli_fetch_array($menNombre)) { ?>
                                <option value="<?php echo utf8_encode($row['Matricula'])?>"><?php echo utf8_encode($row['NomApe'])?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="col"><h5 class="card-title">Especialidad:</h5></div>
                            <div class="col">
                            <select class="js-select-Especialidad custom-select" name="Especialidad" id="Especialidad" onchange="select()">
                                <option value="00">TODOS</option>
                                <?php while($row=mysqli_fetch_array($menEspecialidad)) { ?>
                                <option value="<?php echo utf8_encode($row['Id'])?>"><?php echo utf8_encode($row['Especialidad'])?> </option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col"><h5 class="card-title">Obra Social</h5></div>
                            <div class="col">
                            <select class="js-select-ObraSocial custom-select" name="ObraSocial" id="ObraSocial" onchange="select()">
                                <option value="00">TODOS</option>
                                <?php while($row=mysqli_fetch_array($menObraSocial)) { ?>
                                <option value="<?php echo utf8_encode($row['Id'])?>">
                                <?php echo utf8_encode($row['Nombre'])?>ㅤㅤㅤㅤ<?php echo utf8_encode($row['Plan'])?>
                                </option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="col"><h5 class="card-title">Estudios</h5></div>
                            <div class="col">
                            <select class="js-select-Estudios custom-select" name="Estudios" id="Estudios" onchange="select()">
                                <option value="00">TODOS</option>
                                <?php while($row=mysqli_fetch_array($menEstudios)) { ?>
                                <option value="<?php echo utf8_encode($row['Id'])?>"><?php echo utf8_encode($row['Estudios'])?> </option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                    <br>
                    <div class="row">
                        <div class="col"><button type="button" class="btn btn-info" onclick="BorrarFiltro()">Borrar Filtro</button></div>
                    </div>
                    <br>
                    
                    </div>
                </div>
            </div>
                <br><br>
            <!–– Fin Principal -->

        <div class="card">
            <div class="justify-content-center align-items-center" id='misTurnos'>
                <!--- TABLA ----> 
                <div class="table-responsive">    
                    <table class="table" id="reporteTurno">
                        <thead>
                            <tr class="">
                                <th>Matricula</th>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Tipo de Atención</th> <!-- niño adulto ambos -->
                                <th>Horario Atención</th>                                
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>                                            
                            <?php while($row=mysqli_fetch_array($docinfo)) {?>
                                    <tr>
                                        <td>  <?php echo $row['Matricula']; ?> </td>
                                        <td> <?php echo utf8_encode($row['NomApe']);?> </td>
                                        <td> <?php echo utf8_encode($row['Especialidad']);?> </td>
                                        <td> <?php echo utf8_encode($row['TipoAtencion']);?> </td>
                                        <td> <?php echo utf8_encode($row['HorarioAtencion']);?> </td>
                                    
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#masInfo" onclick="verinfo(<?php echo $row['Matricula'];?>)">
                                                MAS INFO
                                            </button>
                                        </td>
                                    </tr>
                            <?php
                                }//Fin while
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--- TABLA ---->
            </div>
        </div>
          <!--  <iframe id="wcbox_body" frameborder="5" scrolling="no" allowtransparency="true" src="https://wcentrix.net/app/form_web.html?accountID=Sa6036&amp;wcboxID=431450e8a67645c3bf582b82e924bb48" style="height: 500px; width: 500px;""></iframe>
        
       
        <span class="footer">© <?php echo date('Y'); ?> Todos los derechos reservados </span> -->
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

<!-- Button trigger modal -->


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="masInfo" tabindex="-1" aria-labelledby="masInfoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="masInfoLabel">Info Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="card">
            <div class="card-body">
                <div id='TodosTurnos'>
                                 e   
                </div>
            </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-primary">REPORTE</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Mas info -->
<div class="modal fade" id="masInfo" tabindex="-1" aria-labelledby="masInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="masInfoLabel">Info Doctor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">        
            <div class="card">
                <div class="card-body">
                    <div id='TodosTurnos'>
                                        
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            <button type="button" class="btn btn-primary">REPORTE</button>
        </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="mCancelar" tabindex="-1" aria-labelledby="mCancelarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mCancelarLabel">Agenda Canceladas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">            
            <br>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    Medico: 
                </div>
                <div class="col-md-auto">
                    <select class="js-select-NombreM custom-select" name="NombreM" id="NombreM" onchange= "tablaCancelar()">
                        <option value="00">                       TODOS                     </option>
                        <?php 
                            while($row=mysqli_fetch_array($menCanNombre)) {
                        ?>
                            <option value="<?php echo utf8_encode($row['Matricula'])?>"> <?php echo utf8_encode($row['NomApe'])?> </option>
                        <?php }?>
                    </select>
                </div>                    
            </div>
        </div>
        <br>
            <div class="container">
                <div id="AgendaTotal">



                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
