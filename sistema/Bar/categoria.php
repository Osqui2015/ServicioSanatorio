<?php 
   $fecha_actual = date('Y-m-d');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>BAR ADM</title>
  <?php require_once 'dependencias.php' ?>
</head>

<body onload="CTabla()">
  <?php require_once 'menu.php' ?>

  <div class="container">
    

    <div class="container text-center">
      <div class="row">
        <div class="col align-self-start">
          
        </div>
        <div class="col align-self-center">
            <p>Ingreso Categoria</p>
        </div>
        <div class="col align-self-end">
          
        </div>
      </div>
    </div><br>




    <div class="container text-center">
        <div class="row">
            <div class="col-4">
                <p>Ingrese Categoria</p>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="NomCategoria">
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-success" onclick="CCategoria()"> Cargar </button>
            </div>
        </div>      
    </div>
    <br>

    <div class="container">
        <div id="TCategoria"></div>
        <!--
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Desactivar</th>
                            <th scope="col">Seleccionar</th>
                        </tr>
                    </thead>        
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-warning">Editar</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger">Desactivar</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary">Seleccionar</button>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        -->
    </div>



  </div>
  <script src="./funciones/categoria.js"></script>
  <?php // require_once '../fin.php'; ?>
</body>

</html>
