<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../../conSanatorio.php";    
    require_once "../../../conServicios.php";

    // Verifica si se recibió el parámetro 'parametro' en la URL
    if (isset($_GET['parametro'])) {
        // Obtiene el valor del parámetro y lo almacena en una variable
        $valorParametro = intval($_GET['parametro']);

        // Utiliza una sentencia preparada para evitar inyección SQL
        $sql = "SELECT * FROM informes WHERE Id = $valorParametro";

        $query = mysqli_query($conServicios, $sql);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            // Resto del código para procesar la fila obtenida
        } else {
            echo "Error en la consulta: " . mysqli_error($conServicios);
        }

    }

    $carpeta = '../../uploads/'.$valorParametro;

    $fechaC = date('Y-m-d', strtotime($row['FIngreso']));    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Auditoria</title>
    <?php require_once '../dependencias.php' ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {                     
            padding: 1px 0;            
        }

        #sidebar {
            height: calc(100vh - 50px); /* Restamos la altura del header */
            width: 250px;
            position: fixed;
            top: 50px;
            left: -250px;
            
            
            transition: left 0.3s ease-in-out;
            z-index: 1000; /* Z-index mayor para que el menú esté sobre el header */
        }

        #sidebar.active {
            left: 0;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar ul li {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s;
        }

        #sidebar ul li:last-child {
            border-bottom: none;
        }

        #sidebar ul li a {            
            text-decoration: none;
        }

        #sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        #content {
            margin-left: 20px;
            padding: 80px 20px 20px;
        }

        #menu-toggle {
            margin: 20px;
        }
        #TInformes_filter {
            text-align: center;
        }
        #TInformes_filter label {
            font-size: 24px; /* Tamaño de fuente */
            font-weight: bold; /* Texto en negrita */
            font-family: "Arial", sans-serif; /* Tipo de letra */
            color: #0C5195; /* Color de texto (cambiar a tu preferencia) */
            text-decoration: underline; /* Subrayado */
        }

        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-bottom: 20px;
        }

        ul.tree {
            list-style-type: none;
            padding-left: 20px;
            border-left: 1px solid #ccc;
        }

        ul.tree li {
            margin: 0;
            padding: 0;
            line-height: 1.5em;
            position: relative;
        }

        ul.tree li.folder > span:before {
            content: "+";
            display: inline-block;
            width: 1em;
            cursor: pointer;
            margin-right: 5px;
        }

        ul.tree li.folder.open > span:before {
            content: "-";
        }

        ul.tree ul {
            display: none;
            list-style-type: none;
            padding-left: 20px;
            border-left: 1px solid #ccc;
        }

        ul.tree li.file {
            margin-left: 20px;
            padding-left: 0;
            list-style-type: none;
            position: relative;
        }

        ul.tree li.file:before {
            content: "\f15b";
            font-family: FontAwesome;
            display: inline-block;
            width: 1em;
            margin-left: -20px;
            margin-right: 5px;
            color: #888;
        } 

    </style>
</head>
<body onload="carpeta()" >
    <div id="header">
        <div class="row justify-content-between">
            <div class="col-4">
                <button id="menu-toggle" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>   
                </button>

                <a class="navbar-brand" href="#">
                    <img src="../../img/imgdos.jpeg" alt="Logo" width="150" height="70">            
                </a>

            </div>
            <div class="col-4 align-self-center text-center">                
                <p class="fw-bold">Sistema Auditoria.</p>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div id="sidebar" class="active">
        <ul class="list-unstyled">
            <li><a href="#"> </a></li>
            <br>
            <li><a href="/servicios/sistema/InformeVista">Inicio</a></li>
            <li><a href="#"></a></li>
            <li><a href="/servicios/sistema/salir.php">Salir</a></li>
        </ul>
    </div>

    <div class="container">
        <div id="content">
            


        <fieldset>
          <legend class="fs-2 text-white fw-semibold">Información de Ingreso</legend>
          <div class="row align-items-center">
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nIngreso">N de Ingreso</label>
                <input  disabled readonly type="number" id="nIngreso" class="form-control" aria-describedby="basic-addon1" value="<?php echo $row['NIngreso'] ?>"  required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nOIS">OIS</label>
                <input  disabled readonly type="number" id="nOIS" class="form-control" aria-describedby="basic-addon1" value="<?php echo $row['NOIS'] ?>"  required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="fechaIngreso">Fecha de Ingreso</label>
                <input  disabled readonly type="date" id="fechaIngreso" class="form-control" aria-describedby="basic-addon1" value="<?php echo $fechaC ?>"  required>
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend class="fs-3 text-white fw-semibold">Información Personal</legend>
          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="dni">DNI</label>
                <input  disabled readonly type="number" id="dni" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NDni'] ?>"  required>
              </div>            
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nombreApellido">Nombre y Apellido</label>
                <input  disabled readonly type="text" id="nombreApellido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NombreApellido'] ?>"  required>
              </div>
            </div>
          </div>

          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="numAfiliado">N° de Afiliado</label>
                <input  disabled readonly type="number" id="numAfiliado" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NAfiliado'] ?>"  required>
              </div>            
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="habitacion">Habitación</label>
                <input  disabled readonly type="number" id="habitacion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['Habitacion'] ?>"  required>
              </div>
            </div>
            
          </div>

          <button hidden type="button" class="btn btn-light" onclick="Gestado(<?php echo $row['Id'] ?>)">Guardar Estado</button>
        </fieldset>









            <input type="text" name="" id="carpeta" value="<?php echo $carpeta ?>" hidden>
            <div class="container">
            <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                    <div id="file-tree">
                        <!-- Aquí se cargará el árbol de archivos -->
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-8">
                <div id="pdf-viewer">            
                    <iframe id="pdf-iframe" style="width: 100%; height: 500px;"></iframe>
                    <!-- Cambia 'height' a la altura deseada, por ejemplo, '800px' -->
                </div>
                </div>
            </div>
            </div>





        </div>
    </div>
    
    <script src="funciones/funciones.js"></script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
 
    </script>
</body>
</html>
