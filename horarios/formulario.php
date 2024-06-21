<div class="col">
    <label for="hora" class="form-label">Hora</label>
    <input value="<?php echo $horario->hora??'';?>" type="time" name="hora" class="form-control" id="hora" aria-describedby="hora">
</div>

<div class="col">
    <label for="id_dia" class="form-label">Dia</label>
    <select name="id_dia" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un dia...</option>
        <?php foreach($dias as $dia):?>
            <option value="<?php echo $dia->id;?>" <?php echo $horario->id_dia === $dia->id?'selected':null;?>><?php echo $dia->nombre;?></option>
        <?php endforeach;?>
    </select>
</div>