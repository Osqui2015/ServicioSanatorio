<?php
session_start();
// echo $_SESSION['tipo'];

require_once "../../conServicios.php";

$usuarioInfo = mysqli_query($conServicios, "SELECT * FROM usuario");

$menSector = mysqli_query($conServicios, "SELECT * FROM sector");  // Sector

$usuarioInfoMenu = mysqli_query($conServicios, "SELECT us.usuario,
                                                        us.contra,
                                                        us.NombreApe,
                                                        se.Sector,
                                                        us.Telefono,
                                                        us.Email
                                                        FROM usuario AS us

                                                        INNER JOIN sector AS se ON
                                                        us.Sector = se.id;");

$menNombre = mysqli_query($conServicios, "SELECT Matricula, NomApe FROM profesional ORDER BY NomApe;");



?>

<!DOCTYPE html>
<html lang="en">
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
            <div class="mx-auto" style="width: 1100px;"> <!-- Tabla Imagen-->                 
                <div class="card text-center">                    
                    <div class="card-body">                        
                            <div class="row">                            
                                <div class="col">
                                    <h5 class="card-title">Nombre</h5>
                                </div>
                                <div class="col">
                                    <select class="js-select-Nombre custom-select" name="Nombre" id="Nombre" onchange="selectUser()">
                                        <option value="00">TODOS</option>
                                        <?php 
                                            while($row=mysqli_fetch_array($usuarioInfo)) {
                                        ?>
                                            <option value="<?php echo utf8_encode($row['usuario'])?>"> <?php echo utf8_encode($row['NombreApe'])?> </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AgregarUser" onclick="AgregarUser()">Agregar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#AgregarUser"  onclick="EditarUser()">Editar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="BorrarUSer()">Borrar</button>
                                </div>
                                
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">Sector</h5>
                                </div>                                
                                <div class="col">
                                    <select class="js-select-ObraSocial custom-select" name="Sect" id="Sect" onchange="select()" >
                                        <option value="00">TODOS</option>
                                        <?php 
                                            while($row=mysqli_fetch_array($menSector)) {
                                        ?>
                                            <option value="<?php echo utf8_encode($row['id'])?>"> <?php echo utf8_encode($row['Sector'])?></option>
                                        <?php }?>
                                    </select>                                   
                                </div>
                         
                                <div class="col">
                                    <button onclick="AgregarSector()" type="button" class="btn btn-success"  class="btn btn-primary" data-toggle="modal" data-target="#SectorModal"  >Agregar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info" onclick="editarObraSocial()" >Editar</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="BorrarObraSocial()">Borrar</button>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-info" onclick = "BorrarFiltro()">Borrar Filtro</button>
                                </div>
                            </div>
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
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Nombre y Apellido</th>
                                <th>Sector</th> <!-- niño adulto ambos -->
                                
                                <th>Telefono</th>                                 
                                <th>Email</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>                
                            
                            <?php while($row=mysqli_fetch_array($usuarioInfoMenu)) {?>
                                    <tr>
                                        <td>  <?php echo $row['usuario']; ?> </td>
                                        <td> **** </td>
                                        <td> <?php echo utf8_encode($row['NombreApe']);?> </td>
                                        <td> <?php echo utf8_encode($row['Sector']);?> </td>
                                        
                                        <td> <a href="https://wa.me/+54<?php echo utf8_encode($row['Telefono']);?>" target="_blank" class="stretched-link"> <?php echo utf8_encode($row['Telefono']);?> </a>
                                        <td> <?php echo utf8_encode($row['Email']);?> </td>
                                    
                                        <td>
                                           
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
           
        
       
        <!-- <span class="footer">© <?php echo date('Y'); ?> Todos los derechos reservados </span> -->
        
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
        
      /*  $('.js-select-Nombre').select2();
        $('.js-select-Espec').select2(); */
        
    });
   
</script>
</body>

</html>

<!-- Button trigger modal -->


<!-- Button trigger modal -->


<!-- Modal info doc -->
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
<!-- Agregar Usuario -->
    <div class="modal fade" id="AgregarUser" tabindex="-1" aria-labelledby="AgregarUserLabel" aria-hidden="true">        
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AgregarUserLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Apellido y Nombre</label>
                            <input type="text" class="form-control" id="NombreApe">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="Legajo">Legajo / Usuario </label>
                            <input type="number" class="form-control" id="Legajo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sector">Sector</label>
                            <br>
                            <select class="js-select-Espec custom-select form-control" name="sector" id="sector">
                                <option value="00">ㅤㅤㅤㅤㅤTODOSㅤㅤㅤㅤㅤ</option>
                                <?php  $menObraSocia = mysqli_query($conServicios, "SELECT * FROM sector");
                                    while($row=mysqli_fetch_array($menObraSocia)) {
                                ?>
                                    <option value="<?php echo utf8_encode($row['id'])?>"> <?php echo utf8_encode($row['Sector'])?></option>
                                <?php }?>
                            </select>
                        </div>            
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="form-control" id="pass">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="passw">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="passw" onchange="validContr()">
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
                        
                    </div>
                    <br>
                        
                </div>
                <div class="modal-footer" id="btnGuardar" style="display:none">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id = "agregarUser" type="button" class="btn btn-primary" onclick="guardarUser()" style="display:none">Guardar</button>
                    <button id= "editUser" type="button" class="btn btn-primary" onclick="guardarUserEdit()" style="display:none">Guardar M</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Sector-->
    <div class="modal fade" id="SectorModal" tabindex="-1" aria-labelledby="SectorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="SectorModalLabel">Agregar Sector</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="nomSector">Nombre Del Sector</label>
                    <input type="text" class="form-control" id="nomSector">                
                </div>

                <div class="form-group" hidden>
                    <label for="PlanSector"> </label>
                    <input type="numeric" class="form-control" id="PlanSector">
                </div>            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="GuardarSector()" id="GuardarSector" style="display:none">Guardar</button>
            <button type="button" class="btn btn-primary" onclick="GuardarSectorModi()" id="GuardarSectorModi" style="display:none">Guardar M</button>
        </div>
        </div>
    </div>
    </div>

