<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Tomar foto</title>
    <style>
        @media only screen and (max-width: 350px) {
            video {
                max-width: 100%;
            }
        }
    </style>
</head>
        <body>
            <h1>Estudio Fotografia WEBCAM</h1>
            <p>
                
            </p>
            <h1>Dispositivo</h1>
            <div style="height: 180px; width: 100%;">
                <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                <button id="boton">Tomar foto</button>
                <p id="estado"></p>
            </div>
            <br>
            <video muted="muted" id="video" style="height: 350px; width: 100%;"></video>
            <canvas id="canvas" style="display: none;"></canvas>
        </body>
   <script src="app.js"></script>
</html>