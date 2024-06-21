<div class="col">
    <label for="nombre" class="form-label">Nombre</label>
    <input value="<?php echo $materia->nombre??'';?>" type="text" name="nombre" class="form-control" id="nombre" aria-describedby="nombre">
</div>

<div class="col">
    <label for="creditos" class="form-label">Creditos</label>
    <input value="<?php echo $materia->creditos??'';?>" type="number" min="1" max="5" name="creditos" class="form-control" id="creditos" aria-describedby="creditos">
</div>

<div class="col">
    <label for="aula" class="form-label">Aula</label>
    <input value="<?php echo $materia->aula??'';?>" type="number" min="1000" max="9999" name="aula" class="form-control" id="aula" aria-describedby="aula">
</div>

<div class="col">
    <label for="cupos" class="form-label">Cupos</label>
    <input value="<?php echo $materia->cupos??'';?>" type="number" min="1" max="50" name="cupos" class="form-control" id="cupos" aria-describedby="cupos">
</div>

<div class="col">
    <label for="id_docente" class="form-label">Docente</label>
    <select name="id_docente" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un docente...</option>
        <?php foreach($docentes as $docente):?>
            <option value="<?php echo $docente->id;?>" <?php echo $materia->id_docente === $docente->id?'selected':null;?>><?php echo $docente->nombres." ".$docente->apellidos;?></option>
        <?php endforeach;?>
    </select>
</div>

<div class="col">
<label for="id_horario" class="form-label">Horario</label>
    <select name="id_horario" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un horario...</option>
        <?php foreach($horarios as $horario):?>
            <option value="<?php echo $horario->id;?>" <?php echo $materia->id_horario === $horario->id?'selected':null;?>><?php echo $horario->dia->nombre." - ".$horario->horaFormateada();?></option>
        <?php endforeach;?>
    </select>
</div>