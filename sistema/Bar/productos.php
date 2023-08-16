<?php 
   $fecha_actual = date('Y-m-d');

    $valor = $_GET['valor'];

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>BAR ADM</title>
  <?php require_once 'dependencias.php' ?>
</head>

<body onload="PTabla()">
    
  <?php require_once 'menu.php' ?>

  <div class="container">
    

    <div class="container text-center">
      <div class="row">
        <div class="col align-self-start">
          
        </div>
        <div class="col align-self-center">
            <p>Ingreso Categoria</p> <input type="text" value="<?php echo $valor ?>" id="Categoria">
        </div>
        <div class="col align-self-end">
          
        </div>
      </div>
    </div><br>


 

    <div class="container text-center">
        <div class="row">
            <div class="col-4">
                <p>ID</p>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="idP" value="0" disabled readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Ingrese Producto</p>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="NombreP">
            </div>
        </div>
        <div class="row"> 
            <div class="col-4">
                <p>SubTitulo</p>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="SubT" placeholder="(500ml) (1 lts) (c/u)">
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Listado</p>
            </div>
            <div class="col-4">
                <textarea type="text" class="form-control" id="ListT" placeholder="Ejemplo: Banana -Manzana -Frutilla"></textarea>
            </div>
        </div>
        <div class="row" hidden>
            <div class="col-4">
                <p>Ingrese Cantidad</p>
            </div>
            <div class="col-4">
                <input type="number" class="form-control">
            </div>
        </div>  
        <div class="row">
            <div class="col-4">
                <p>Ingrese Precio</p>
            </div>
            <div class="col-4">
                <input type="number" class="form-control" id="PrecioUno">
            </div>
        </div>  
        <div class="row" hidden>
            <div class="col-4">
                <p>Ingrese Precio</p>
            </div>
            <div class="col-4">
                <input type="number" class="form-control">
            </div>            
        </div>  
        <div class="col-4">
            <button type="button" class="btn btn-success" onclick="CProductos()"> Cargar </button>
        </div>
    </div>
    <br>

           

    <br>
    <div class="container" onload="PTabla()">
        <div id="TProductos"></div>
    </div>



  </div>
  <script src="/servicios/sistema/Bar/funciones/productos.js"></script>
  <?php // require_once '../fin.php'; ?>
</body>

</html>
