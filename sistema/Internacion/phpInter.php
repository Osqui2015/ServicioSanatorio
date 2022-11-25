<?php

    require_once "../../conSanatorio.php";
    require_once "../../conServicios.php";

    // traer Datos DNI
    if (isset($_POST["bscaDNI"])){

        $dni = $_POST["numDNIP"];
        $valores['existe'] = "0";

        $consulta = "SELECT * FROM pacientes WHERE NumeroDocumentoIdentidad = $dni;";
    
        $resultados = mysqli_query($conSanatorio,$consulta);
        if (!$resultados) {
            echo "Error en la inserción Guardar: ".$conSanatorio->error;
            $valores['existe'] = "0";
        }
        while($consulta = mysqli_fetch_array($resultados))
        {
            $valores['existe'] = "1";         
            $valores['Apellido'] = $consulta['Apellido'];
            $valores['Nombre'] = $consulta['Nombre'];
            $valores['Domicilio'] = $consulta['Domicilio'];
            $valores['Localidad'] = $consulta['Localidad'];
            $valores['Provincia'] = $consulta['Provincia'];
            $valores['FechaNacimiento'] = $consulta['FechaNacimiento'];
            $valores['Telefono'] = $consulta['Telefono'];
        }
        
        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;

    }
    // cargar paciente a habitacion
    if (isset($_POST['cargar'])) {
            $Acomp = $_POST['Acomp'];
            $numDNIP  = $_POST['numDNIP'];
            $ApellidoP  = $_POST['ApellidoP'];
            $NombreP  = $_POST['NombreP'];
            $HabP  = $_POST['HabP'];
            $valores = array();
            $valores['existe'] = "1";

            if ($Acomp == 1) {
                $numDNIA  = $_POST['numDNIA'];
                $ApellidoA  = $_POST['ApellidoA'];
                $NombreA  = $_POST['NombreA'];
                $habA  = $_POST['habA'];
                
                $consultaUna = "INSERT INTO habdesg ( Dni, IdCama, Acom, DniDos, IdCamaDos)
                                VALUES($numDNIP, $HabP, $Acomp, $numDNIA, $habA )";

                $consultaDos = "UPDATE hab SET Ocupado =  1, Estado = 1 WHERE Id = $HabP";

                $consultaTres = "UPDATE hab SET Ocupado =  1, Estado = 1 WHERE Id = $habA";

                $resultadoTres = mysqli_query($conServicios,$consultaTres);
                    if (!$resultadoTres) {
                        echo "Error en la resultadoTres Guardar: ".$conServicios->error;
                        $valores['existe'] = "0";
                    }
                
            }else{
                $consultaUna = "INSERT INTO habdesg ( Dni, IdCama, Acom)
                                VALUES($numDNIP, $HabP, $Acomp)";

                $consultaDos = "UPDATE hab SET Ocupado =  1, Estado = 1 WHERE Id = $HabP";
            }            

            $resultadoUno = mysqli_query($conServicios,$consultaUna);
            if (!$resultadoUno) {
                echo "Error en la resultadoUno Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
            
            

            $resultadoDos = mysqli_query($conServicios,$consultaDos);
            if (!$resultadoDos) {
                echo "Error en la resultadoDos Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
            
            
            $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
                echo $valores;

    }
    /// carga de habitaciones
    if (isset($_POST["bH"])){

        $hab = $_POST["hab"];
        $valores['existe'] = "0";

        $consulta = "SELECT * FROM hab WHERE Hab = $hab" ;
    
        $resultados = mysqli_query($conServicios,$consulta);
        if (!$resultados) {
            echo "Error en la inserción Guardar: ".$conSanatorio->error;
            $valores['existe'] = "0";
        }

        $row_cnt = mysqli_num_rows($resultados);
        
        echo $row_cnt;

        while($consulta = mysqli_fetch_array($resultados))
        {
            $valores['existe'] = "1";         
            $valores['Hab'] = $consulta['Hab'];
            $valores['Id'][] = $consulta['Id'];
            $valores['Oc'][] = $consulta['Ocupado'];

        }
            $un = $valores ['Id'][0];
            $do = $valores ['Id'][1];

        $habunoc = "SELECT * FROM habdesg WHERE IdCama = $un;" ;    
        $habuno = mysqli_query($conServicios,$habunoc);
        if (!$resultados) {
            echo "Error en la inserción Guardar: ".$conSanatorio->error;
            $valores['existe'] = "0";
        }
        while($hu= mysqli_fetch_array($habuno))
        {
            $valores['DniUno'] = $hu['Dni'];
        }


        $habdosc = "SELECT * FROM habdesg WHERE IdCama =  $do" ;    
        $habdos = mysqli_query($conServicios,$habdosc);
        if (!$resultados) {
            echo "Error en la inserción Guardar: ".$conSanatorio->error;
            $valores['existe'] = "0";
        }
        while($hd= mysqli_fetch_array($habdos))
        {
            $valores['DniDos'] = $hd['Dni'];
        }   





        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;

    }


    ////
    if (isset($_POST['pisoSelect'])){
        $piso = $_POST['piso'];


        $cargaHab = mysqli_query($conServicios, "SELECT * FROM habitacion WHERE Piso = $piso");



        $salida = '
            <select class="form-control" id="idHabitacion" onchange="selecHabitacion()">
                <option>Habitacion</option>';
                while($row=mysqli_fetch_array($cargaHab)) {
                    $salida.= '<option value='.utf8_encode($row['Habitaciones']).'>'.utf8_encode($row['Habitaciones']).'</option>';
                };

            $salida.= '</select>';

        echo $salida;

    }
    /// carga de habitaciones
    if (isset($_POST['habSelect'])){
        $hab = $_POST['hab'];
        
        $valores = array();
        $valores['existe'] = "1";

        $consulta = "SELECT Fin.id, Fin.piso, Fin.Habitaciones, Fin.CamaA, hc.Dni AS DniA, pa.NomApe AS nomA, pa.Tel AS telA, Fin.CamaB, ht.Dni AS DniB, pb.NomApe AS nomB, pb.Tel AS telB
                            FROM(
                                SELECT id, piso, Habitaciones, CamaA, (SELECT tc.Cama FROM habcamas AS tc WHERE tc.Habitacion = Con.Habitaciones AND tc.Cama <> Con.CamaA AND tc.Estado = 1) AS CamaB
                                FROM (
                                    SELECT ha.id, ha.piso, ha.Habitaciones, (SELECT MIN(hc.Cama) FROM habcamas AS hc WHERE hc.Habitacion = ha.Habitaciones AND hc.Estado = 1) AS CamaA
                                    FROM habitacion AS ha
                                ) AS Con
                            ) AS Fin
                        LEFT JOIN habconsulta AS hc ON hc.Hab = Fin.Habitaciones AND hc.Cama = CamaA
                        LEFT JOIN habconsulta AS ht ON ht.Hab = Fin.Habitaciones AND ht.Cama = CamaB
                        INNER JOIN paciente AS pa ON hc.Dni = pa.Dni 
                        INNER JOIN paciente AS pb ON ht.Dni = pb.Dni 
                        
                        WHERE Fin.Habitaciones = $hab
                        
                        ORDER BY Fin.piso, Fin.Habitaciones, Fin.CamaA";

        $resultado = mysqli_query($conServicios,$consulta);
            if (!$resultado) {
                echo "Error en la resultado Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
           

        while($consulta = mysqli_fetch_array($resultado))
        {
            $valores['existe'] = "1";         
            $valores['id'] = $consulta['id'];
            $valores['piso'] = $consulta['piso'];
            $valores['Habitaciones'] = $consulta['Habitaciones'];
            $valores['CamaA'] = $consulta['CamaA'];
            $valores['DniA'] = $consulta['DniA'];
            $valores['CamaB'] = $consulta['CamaB'];
            $valores['DniB'] = $consulta['DniB'];
            $valores['nomA'] = $consulta['nomA'];
            $valores['nomB'] = $consulta['nomB'];
            $valores['telA'] = $consulta['telA'];
            $valores['telB'] = $consulta['telB'];
            
        }


        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
        
    }

    if(isset($_POST['cargarHabitacion'])){
        $dni = $_POST['dni'];
        $nomape = $_POST['nomape'];
        $tel = $_POST['tel'];
        $cama = $_POST['cama'];
        $idPiso = $_POST['idPiso'];
        $idHabitacion = $_POST['idHabitacion'];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $DateAndTime = date('Y-m-d h:i:s', time());

        $valores = array();
        $valores['existe'] = "1";

        $consultaUna = "INSERT INTO habconsulta ( Piso, Hab, Cama, Estado, Fecha, Dni)
        VALUES($idPiso, $idHabitacion, $cama, 1, '$DateAndTime', $dni )";

        $resultadoUno = mysqli_query($conServicios,$consultaUna);
        if (!$resultadoUno) {
            echo "Error en la resultadoUno Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }

        $consultaDos = "INSERT INTO paciente ( Dni, NomApe, Tel, Tipo)
        VALUES($dni, $nomape, $tel, 1)";

        $resultadoDos = mysqli_query($conServicios,$consultaDos);
        if (!$resultadoDos) {
            echo "Error en la resultadoDos Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }





        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

    }