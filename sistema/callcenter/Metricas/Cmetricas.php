<?php 
    require_once "conServicios.php";

    mysqli_set_charset($conServicios, "utf8");

    $consulta = "SELECT * FROM tabla_preguntas";

    $preguntas = mysqli_query($conServicios, $consulta);

    $consultaDos = "SELECT * FROM usuario WHERE Sector = 3 order by NombreApe";

    $sql = mysqli_query($conServicios, $consultaDos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Metricas</title>
    <?php require_once "../dependencias.php" ?>
</head>
<body>
    <?php require_once "../menu.php" ?>
    <div class="container">
        <div class="card">
            <div class="card-body ">

                <div class="row mt-2 ">
                    <div class="col-2 border-end">
                        Legajo
                    </div>
                    <div class="col-4">
                        <select id="select-Legajo" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="00"></option>
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                            <option value="<?php echo $row['usuario'] ?>"><?php echo $row['NombreApe'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    Fecha
                </div>
                <div class="col-4">
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    ID #:
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="ID" name="ID">
                </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    Evaluador:
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="Evaluador" name="Evaluador">
                </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    N° Caso
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="Caso" name="Caso">
                </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    Canal
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="Canal" name="Canal">
                </div>
                </div>

                <div class="row mt-2">
                <div class="col-2 border-end">
                    Motivo de contacto:
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="Motivo" name="Motivo">
                </div>
                </div>

                <div class="row mt-2">

                <div class="col-sm-2 d-flex align-items-center justify-content-center border-end">
                    KPIS
                </div>

                <div class="col-sm-8">
                    <div class="row">
                    <div class="row">
                        <div class="col-sm-3">AHT</div>
                        <div class="col-sm-3"><input type="text" class="form-control" id="AHT" name="AHT"></div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="row">
                        <div class="col-sm-3">NPC</div>
                        <div class="col-sm-3"><input type="text" class="form-control" id="NPC" name="NPC"></div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="row">
                        <div class="col-sm-3">FCR</div>
                        <div class="col-sm-3"><input type="text" class="form-control" id="FCR" name="FCR"></div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="row">
                        <div class="col-sm-3">OTRO</div>
                        <div class="col-sm-3"><input type="text" class="form-control" id="OTRO" name="OTRO"></div>
                    </div>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <?php while ($Rpreguntas = $preguntas->fetch_assoc()) {  ?>
                    <div class="row">
                        <div class="col">
                            <!-- PREGUNTAS -->
                                <p><?php echo $Rpreguntas['pregunta'] ?></p>
                        </div>
                        <div class="col">
                            <!-- RESPUESTA -->
                            <select class="form-select" aria-label="select-id" id="select-id<?php echo $Rpreguntas['Id'] ?>">
                                <option value="<?php echo $Rpreguntas['pts']?>" selected>SI</option>
                                <option value="0">NO</option>
                                <option value="1">NO APLICA</option>
                            </select>
                        </div>
                    </div>
                    <br>
                <?php } ?>
                    <div class="row">
                        <div class="col">
                            <p>Observaciones</p>
                        </div>
                        <div class="col">
                            <textarea class="form-control" id="ObserTarea" rows="5"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-2">
                            <button type="button" class="btn btn-success btn-lg" onclick="guardarMetricas()">Guardar</button>
                        </div>
                    </div>
            </div>
        </div>        
    </div>
    <br><br>
    <script src="./funciones/funciones.js"></script>
</body>
</html>
<?php ?>