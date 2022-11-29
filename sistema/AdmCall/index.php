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
                                                ON pr.TipoAtencion = tp.id");

$menObraSocial = mysqli_query($conServicios, "SELECT * FROM obrasocial");  //order by Orden 
$menEstudios = mysqli_query($conServicios, "SELECT * FROM estudios");  //order by Orden 
$menEspecialidad = mysqli_query($conServicios, "SELECT Especialidad FROM docinfo GROUP BY Especialidad;");
$menNombre = mysqli_query($conServicios, "SELECT Matricula, NomApe FROM profesional ORDER BY NomApe;");
$menCanNombre = mysqli_query($conServicios, "SELECT Matricula, NomApe FROM profesional ORDER BY NomApe;");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Turnos</title>

    <?php  include_once "dependencias.php" ?>

</head>
<body>
            <!–– menu -->
             <?php  include_once "menuSecretaria.php" ?>
            <!–– fin menu -->
            <br><br><br>
             <!-- Tabla Imagen-->                 
                <div class="card text-center">                    
                    <div class="card-body">                        
                            <div class="row">                            
                                <div class="col-md">
                                    <h5 class="card-title">Nombre Medico </h5>
                                </div>
                                <div class="col-md">
                                    <select class="js-select-Nombre custom-select" name="Nombre" id="Nombre" onchange="select()">
                                        <option value="00">TODOS</option>
                                        <?php 
                                            while($row=mysqli_fetch_array($menNombre)) {
                                        ?>
                                            <option value="<?php echo utf8_encode($row['Matricula'])?>"> <?php echo utf8_encode($row['NomApe'])?> </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Agregar" onclick="btnAgregarMedico()">Agregar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Agregar"  onclick="EditarMedico()">Editar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="BorrarMedico()">Borrar</button>
                                </div>
                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <h5 class="card-title">Obra Social</h5>
                                </div>                                
                                <div class="col-md">
                                    <select class="js-select-ObraSocial custom-select" name="ObraSocial" id="ObraSocial" onchange="select()" >
                                        <option value="00">TODOS</option>
                                        <?php 
                                            while($row=mysqli_fetch_array($menObraSocial)) {
                                        ?>
                                            <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Nombre'])?> || <?php echo utf8_encode($row['Plan'])?></option>
                                        <?php }?>
                                    </select>                                   
                                </div>
                         
                                <div class="col">
                                    <button onclick="AgregarObraSocial()" type="button" class="btn btn-success"  class="btn btn-primary" data-toggle="modal" data-target="#obraSocial"  >Agregar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info" onclick="editarObraSocial()" >Editar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="BorrarObraSocial()">Borrar</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <h5 class="card-title">Estudios</h5>
                                </div>                                
                                <div class="col-md">
                                    <select class="js-select-Estudios custom-select" name="Estudios" id="Estudios"  >
                                        <option value="00">TODOS</option>
                                        <?php 
                                            while($row=mysqli_fetch_array($menEstudios)) {
                                        ?>
                                            <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Estudios'])?> </option>
                                        <?php }?>
                                    </select>                                   
                                </div>
                         
                                <div class="col">
                                    <button type="button" class="btn btn-success" onclick="AgregarEstudios()" data-toggle="modal" data-target="#estudios" >Agregar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info" onclick="editarEstudios()" data-toggle="modal" data-target="#estudios" >Editar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="BorrarEstudios()">Borrar</button>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">                               
                                <div class="col">
                                    <button type="button" class="btn btn-info" onclick = "BorrarFiltro()">Borrar Filtro</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelaciones" onclick="btnCancelar()">
                                        Cancelar Agendas
                                    </button>
                                </div>
                            </div>
                    </div>                    
                </div>                   
            <!–– Fin Principal -->
            
        <div class="container mb-3">
        <br><br>
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
                                    // 
                                        
                                        ?>
                                        
                                                                
                            </tbody>
                        </table>
                    </div>
                <!--- TABLA ----> 
            </div>
        </div>
                                 
        
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
        });
        
        $('.js-select-ObraSocial').select2();
        $('.js-select-ObraSocialAgregar').select2();
        $('.js-select-Especialidad').select2();
        $('.js-select-Nombre').select2();
        $('.js-select-Espec').select2();
        
    });
   
</script>
</body>

</html>



<!-- Modal info doc -->
<div class="modal fade" id="masInfo" tabindex="-1" aria-labelledby="masInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="masInfoLabel">Información Doctor</h5>
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
        </div>
        </div>
    </div>
</div>



<!-- Agregar Medico Profesional -->
<div class="modal fade" id="Agregar" tabindex="-1" aria-labelledby="AgregarLabel" aria-hidden="true">
    
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AgregarLabel">Agregar Medico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Matricula</label>
                <input type="number" class="form-control" id="matriculaMedicoAlta" onfocus="validarMatricula()">
            </div>
            <div class="form-group col-md-8">
                <label for="NomApe">Nombre y Apellido</label>
                <input type="text" class="form-control" id="NomApe">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Espec">Especialidad</label>
                <br>
                <select class="js-select-Espec custom-select form-control" name="Espec" id="Espec">
                    <option value="00">ㅤㅤㅤㅤㅤTODOSㅤㅤㅤㅤㅤ</option>
                    <?php  $menObraSocia = mysqli_query($conServicios, "SELECT * FROM Especialidad");
                        while($row=mysqli_fetch_array($menObraSocia)) {
                    ?>
                        <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Especialidad'])?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="Tatencion">Tipo Atencion</label>
                <select id="Tatencion" class="form-control">
                    <option value = 1 selected>Todos</option>
                    <option value = 2 >Niño</option>
                    <option value = 3 >Adultos</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telf">Teléfono</label>
                <input type="number" class="form-control" id="telf">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Hatencion">Horario Atencion</label>
                <input type="text" class="form-control" id="Hatencion">
            </div>
            <div class="form-group col-md-6">
                <label for="Consult">Consultorio</label>
                <input type="text" class="form-control" id="Consult">
            </div>
        </div>

        <div class="form-group">
            <label for="obsText">OBSERVACION</label>
            <textarea class="form-control" id="obsText" rows="3"></textarea>
        </div>
        <br>
        
        <button onclick="verObraSocialCarga()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ObraSocialProfesional">
            Agregar Obra Social
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id = "agregarMedico" type="button" class="btn btn-primary" onclick="guardarMedico()" style="display:none">Guardar</button>
        <button id= "editMedico" type="button" class="btn btn-primary" onclick="guardarMedicoEdit()" style="display:none">Guardar M</button>
      </div>
    </div>
  </div>
</div>

<!-- Agregar Obra Social al Profesional -->
<div class="modal fade" id="ObraSocialProfesional"data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ObraSocialProfesionalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content border-info">
      <div class="modal-header">
        <h5 class="modal-title" id="ObraSocialProfesionalLabel">Obra Social</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body">
                
                <div class="container">
                    <div class="row justify-content-md-center">
                    
                        <div class="col-md-auto">
                            <select class="js-select-ObraSocialAgregar custom-select" name="ObraSocialAgregar" id="ObraSocialAgregar">
                                <option value="00">ㅤㅤㅤㅤㅤObra Socialesㅤㅤㅤㅤㅤ</option>
                                <?php  $menObraSocia = mysqli_query($conServicios, "SELECT * FROM obrasocial");
                                    while($row=mysqli_fetch_array($menObraSocia)) {
                                ?>
                                    <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Nombre'])?> ==> <?php echo utf8_encode($row['Plan'])?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row justify-content-md-center">
                            <div class="col col-lg-2">
                                <label>Costo: </label>
                            </div>
                            <div class="col-md-auto">
                                <input type="number" class="form-control" id="ObraSocialImporte" >
                            </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="form-group col-md-4">                
                            <select class="custom-select" id="tipoObraSocial">
                                <option selected>Tipo de Obra Social</option>
                                <option value="Colegio Medico">Colegio Medico</option>
                                <option value="Prestador Directo">Prestador Directo</option>
                                <option value="Factura Por Sanatorio">Factura Por Sanatorio</option>
                                <option value="Otro">Otros..</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="container">
                    <div class="row justify-content-md-center">
                    
                        <div class="col-md-auto">
                            <select class="js-select-Estudios custom-select" name="EstudiosAgregar" id="EstudiosAgregar">
                                <option value="00">ㅤㅤㅤㅤㅤEstudiosㅤㅤㅤㅤㅤ</option>
                                <?php  $menEstudios2 = mysqli_query($conServicios, "SELECT * FROM estudios");
                                    while($row=mysqli_fetch_array($menEstudios2)) {
                                ?>
                                    <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Estudios'])?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row justify-content-md-center">
                            <div class="col col-lg-2">
                                <label>Costo: </label>
                            </div>
                            <div class="col-md-auto">
                                <input type="number" class="form-control" id="EstudiosImporte" >
                            </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row justify-content-md-center">
         
                       
                        
                        <button type="button" class="btn-success form-control" style="width: 18rem;" onclick="AgregarOBSocMedico()" > Agregar </button>
                    </div>
                </div> 
                <br><br>
                <div id='ObSocTabla'>
                                    
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal obraSocial-->
<div class="modal fade" id="obraSocial" tabindex="-1" aria-labelledby="obraSocialLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="obraSocialLabel">Agregar Obra Social</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="nombreObraSocial">Nombre Obra Social</label>
                <input type="text" class="form-control" id="nombreObraSocial">                
            </div>
 
            <div class="form-group">
                <label for="PlanObrasocial">Plan</label>
                <input type="numeric" class="form-control" id="PlanObrasocial">
            </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarObraSocial()" id="AgregarOB" style="display:none">Guardar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarObraSocialModi()" id="ModiOB" style="display:none">Guardar M</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal editar costo obra social -->
<div class="modal fade" id="editarCostoOBS" tabindex="-1" aria-labelledby="editarCostoOBSLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-white bg-info">
      <div class="modal-header">
        <h5 class="modal-title" id="editarCostoOBSLabel">Editar Costo Obra Social</h5>ㅤㅤ<input type="number" class="form-control" id="text" disabled>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <label for="text" class="">Obra Social:</label>
      <div class="modal-body">
        <input type="number" class="form-control" id="editarCostoO">
      </div>
      <br>
      <label for="text" class="">Estudio:</label>
      <div class="modal-body">
        <input type="number" class="form-control" id="editarCostoE">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarEditarOBS()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal Estudios -->
<div class="modal fade" id="estudios" tabindex="-1" aria-labelledby="estudiosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="estudiosLabel">Agregar Estudios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="nombreEstudio">Nombre Estudios</label>
                <input type="text" class="form-control" id="nombreEstudio">
            </div>
            <br>
            <div id='EstudioTabla'>
                                    
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarEstudio()" id="agregarEstudio" style="display:none">Guardar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarEstudioModi()" id="editEstudio" style="display:none">Guardar M</button>      
      </div>
    </div>
  </div>
</div>





<!-- Modal Cancelaciones-->
<div class="modal fade" id="cancelaciones" tabindex="-1" aria-labelledby="cancelacionesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelacionesLabel">Cancelaciones de Turnos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                        Fecha:
                    </div>
                    <div class="col-md-auto">
                        <input type='date' class="form-control" id="fechaCancelacion" />
                    </div>                    
                </div>
                <br>
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                        Medico: 
                    </div>
                    <div class="col-md-auto">
                        <select class="js-select-NombreM custom-select" name="NombreM" id="NombreM" >
                            <option value="00">TODOS</option>
                            <?php 
                                while($row=mysqli_fetch_array($menCanNombre)) {
                            ?>
                                <option value="<?php echo utf8_encode($row['Matricula'])?>"> <?php echo utf8_encode($row['NomApe'])?> </option>
                            <?php }?>
                        </select>
                    </div>                    
                </div>
                <br>
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                        Observación: 
                    </div>
                    <div class="col-md-auto">
                        <textarea class="form-control" id="obsCancelacion" rows="5"></textarea>
                    </div>                    
                </div>
                <br>
                <div class="row justify-content-md-center">                    
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-warning" onclick="Cancelar()">Agregar</button> 
                    </div>                    
                </div>
            </div>
            <br>
            <div class="container">
                <div id="tablaCancelacion">

                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>