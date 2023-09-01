<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../conSanatorio.php";    
    require_once "../../conServicios.php";

    $sql = "SELECT * FROM informes";


    $Info = mysqli_query($conServicios,$sql);

    
    $numRows = mysqli_num_rows($Info);                   

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Stylish Vertical Menu with Toggle</title>
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
            margin-bottom: 70px; /* Margen inferior */
        }



    </style>
</head>
<body>
    <div id="header">
        <div class="row justify-content-between">
            <div class="col-4">
                <button id="menu-toggle" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>   
                </button>

                <a class="navbar-brand" href="#">
                    <img src="../img/imgdos.jpeg" alt="Logo" width="150" height="70">            
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
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </div>

    <div class="container">
        <div id="content">
            <table class="table table-striped table-hover table-bordered table-sm text-center" id="TInformes">
                <thead>
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Apellido</th>
                        <th scope="col">N° Afiliado</th>
                        <th scope="col">N° OIS</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $Info->fetch_assoc()) { ?>
                    <tr>
                    <th scope="row"><?php echo $fila['NDni'] ?></th>
                    <td><?php echo $fila['NombreApellido'] ?></td>
                    <td><?php echo $fila['NAfiliado'] ?></td>
                    <td><?php echo $fila['NOIS'] ?></td>
                    <td>
                        <?php 
                            $fecha_formateada = date('d-m-Y', strtotime($fila['FIngreso']));

                            echo  $fecha_formateada;
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="ver(<?php echo $fila['Id'] ?>)">Ver</button>
                    </td>
                    </tr>
                <?php } ?>  
                </tbody>
            </table>
        </div>
    </div>
    

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
        $(document).ready(function() {
            $("#TInformes").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                "sDom": '<"top"f>t<"bottom"lip>',
                "oLanguage": {
                    "sSearch": "Buscar Paciente:" // Cambia el texto de búsqueda
                },
                fixedHeader: {
                    header: true,
                    footer: true
                }
            });
        });
 
    </script>
</body>
</html>
