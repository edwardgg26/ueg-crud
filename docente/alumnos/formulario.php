<div class="col">
    <label for="nota1" class="form-label">Corte 1</label>
    <input value="<?php echo $materia_estudiante->nota1??'';?>" type="number" min="0" max="5" step="0.01" name="nota1" class="form-control" id="nota1" aria-describedby="nota1">
</div>

<div class="col">
    <label for="nota2" class="form-label">Corte 2</label>
    <input value="<?php echo $materia_estudiante->nota2??'';?>" type="number" min="0" max="5" step="0.01" name="nota2" class="form-control" id="nota2" aria-describedby="nota2">
</div>

<div class="col">
    <label for="nota3" class="form-label">Corte 3</label>
    <input value="<?php echo $materia_estudiante->nota3??'';?>" type="number" min="0" max="5" step="0.01" name="nota3" class="form-control" id="nota3" aria-describedby="nota3">
</div>