<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <?php  include_once "dependencias.php" ?>
    <title>Hoteleria Adm</title>
  </head>
  <body>
    <?php  include_once "menuAdmin.php" ?>
    <br><br><br><br>

    
























    <div class="container">
      <h1>Encuesta Pre-Admisión Sanatorio Modelo</h1>
      <form>
        <div class="form-group">
          <label for="nombre">1. Apellido y nombre del paciente</label><br>
          <input type="text" id="nombre" name="nombre" required><br>
        </div>
        <div class="form-group">
          <label for="dni">2. DNI Nº</label><br>
          <input type="text" id="dni" name="dni" required><br>
        </div>
        <div class="form-group">
          <label for="fecha_nacimiento">3. Fecha de nacimiento:</label><br>
          <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" pattern="\d{2}/\d{2}/\d{4}" required><br>
        </div>
        <div class="form-group">
          <label for="domicilio">4. Domicilio:</label><br>
          <input type="text" id="domicilio" name="domicilio" required><br>
        </div>
        <div class="form-group">
          <label for="obra_social">5. Obra Social del paciente:</label><br>
          <input type="text" id="obra_social" name="obra_social" required><br>
        </div>
        <div class="form-group">
          <label for="fecha_cirugia">6. Fecha de cirugía</label><br>
          <input type="text" id="fecha_cirugia" name="fecha_cirugia" pattern="\d{2}/\d{2}/\d{4}" required><br>
        </div>
        <div class="form-group">
          <label for="medico">7. Nombre del médico que
          le realizará la cirugía</label><br>
            <input type="text" id="medico" name="medico" required><br>
            </div>
            <div class="form-group">
            <label for="peso">8. Peso:</label><br>
            <input type="text" id="peso" name="peso" required><br>
            </div>
            <div class="form-group">
            <label for="estatura">9. Estatura del paciente:</label><br>
            <input type="text" id="estatura" name="estatura" required><br>
            </div>
            <div class="form-group">
            <label for="estudios_prequirurgicos">10. Del siguiente listado, indique si su médico le solicitó algunos de estos estudios pre-quirúrgicos:</label><br>
            <input type="checkbox" id="electrocardiograma" name="estudios_prequirurgicos" value="electrocardiograma"> Electrocardiograma<br>
            <input type="checkbox" id="analisis_laboratorio" name="estudios_prequirurgicos" value="analisis_laboratorio"> Análisis de laboratorio<br>
            <input type="checkbox" id="radiografia" name="estudios_prequirurgicos" value="radiografia"> Radiografía<br>
            <input type="checkbox" id="examen_neumonologico" name="estudios_prequirurgicos" value="examen_neumonologico"> Exámen neumonológico<br>
            <input type="checkbox" id="ninguno" name="estudios_prequirurgicos" value="ninguno"> No me solicitó ninguno de estos estudios<br>
            </div>
            <div class="form-group">
            <label for="enfermedades">11. Indique si tiene antecedentes de algunas de estas enfermedades:</label><br>
            <input type="checkbox" id="enfermedades_cardiovasculares" name="enfermedades" value="enfermedades_cardiovasculares"> Enfermedades cardiovasculares<br>
            <input type="checkbox" id="enfermedades_renales" name="enfermedades" value="enfermedades_renales"> Enfermedades renales<br>
            <input type="checkbox" id="enfermedades_respiratorias" name="enfermedades" value="enfermedades_respiratorias"> Enfermedades respiratorias<br>
            <input type="checkbox" id="ninguna" name="enfermedades" value="ninguna"> Ninguna<br>
            <input type="checkbox" id="otras" name="enfermedades" value="otras"> Otras<br>
        </div>
        <div class="form-group">
        <label for="alimentacion">12. ¿Qué tipo de alimentación consume habitualmente?</label><br>
            <select id="alimentacion" name="alimentacion">
            <option value="vegetariana">Vegetariana</option>
            <option value="vegana">Vegana</option>
            <option value="celiaca">Celíaca</option>
            <option value="ninguna">Ninguna de las anteriores</option>
            </select>
            </div>
            <div class="form-group">
            <label for="alergia">13. ¿Tiene alguna alergia alimenticia?</label><br>
            <select id="alergia" name="alergia">
            <option value="si">SI</option>
            <option value="no">NO</option>
            </select>
            </div>
            <div class="form-group">
            <label for="alimentos_alergicos">14. ¿Podría por favor indicarnos el/los alimentos que le provocan alergia al paciente?</label><br>
            <input type="text" id="alimentos_alergicos" name="alimentos_alergicos"><br>
            </div>
            <div class="form-group">
            <label for="culto">15. ¿Pertenece a algún culto/religión que le impida el consumo de algún alimento?</label><br>
            <select id="culto" name="culto">
            <option value="si">SI</option>
            <option value="no">NO</option>
            </select>
            </div>
            <div class="form-group">
            <label for="alimentos_prohibidos">16. ¿Podría indicarnos por favor cuáles son los alimentos que no puede consumir?</label><br>
            <input type="text" id="alimentos_prohibidos" name="alimentos_prohibidos"><br>
            </div>
            <div class="form-group">
            <label for="cirugias_anteriores">17. ¿Se realizó alguna cirugía anteriormente?</label><br>
            <select id="cirugias_anteriores" name="cirugias_anteriores">
            <option value="no">No</option>
            <option value="si">Si</option>
            </select>
            </div>
            <div class="form-group">
            <label for="detalle_cirugias">18. Por favor detalle que cirugías se realizo</label><br>
            <textarea id="detalle_cirugias" name="detalle_cirugias"></textarea><br>
            </div>
            <div class="form-group">
            <label for="medicamentos">19. Enumere todos los medicamentos que toma habitualmente</label><br>
            <textarea id="medicamentos" name="medicamentos"></textarea><br>
            </div>
            <div class="form-group">
            <label for="alergia_medicamentos">20. ¿Es alérgico a algún medicamento?</label><br>
            <select id="alergia_medicamentos" name="alergia_medicamentos">
            <option value="si">SI</option>
            <option value="no">NO</option>
            </select>
            </div>
            <div class="form-group">
            <label for="medicamentos_alergicos">21. Indique por favor el nombre del/los medicamentos a los que es alérgico</label><br>
            <input type="text" id="medicamentos_alergicos" name="medicamentos_alergicos"><br>
            </div>
            <div class="form-group">
            <label for="comidas_acompanante">22. ¿Quisiera solicitar servicio de comidas para el acompañante? (incluye desayuno/almuerzo/merienda/cena) "Este servicio podría tener costo adicional"</label><br>
            <select id="comidas_acompanante" name="comidas_acompanante">
            <option value="si">SI</option>
            <option value="no">NO</option>
            </select>
            </div>
            <div class="form-group">
            <label for="estudios_diagnosticos">23. Si cuenta con estudios diagnósticos como Ecografía, Tomografía, Resonancia magnetica por favor adjunte el informe médico.</label><br>
            <input type="file" id="estudios_diagnosticos" name="estudios_diagnosticos"><br>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

</body>
</html>