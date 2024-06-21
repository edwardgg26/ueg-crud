<div class="col">
    <label for="id" class="form-label">Cedula</label>
    <input value="<?php echo $usuario->id??'';?>" type="number" name="id" class="form-control" id="id" aria-describedby="cedula">
</div>

<div class="col">
    <label for="nombres" class="form-label">Nombres</label>
    <input value="<?php echo $usuario->nombres??'';?>" type="text" name="nombres" class="form-control" id="nombres">
</div>

<div class="col">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input value="<?php echo $usuario->apellidos??'';?>" type="text" name="apellidos" class="form-control" id="apellidos">
</div>

<div class="col">
    <label for="email" class="form-label">Email</label>
    <input value="<?php echo $usuario->email??'';?>" type="email" name="email" class="form-control" id="email">
</div>

<div class="col">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" name="password" class="form-control" id="password">
</div>

<div class="col">
    <label for="id_rol" class="form-label">Rol</label>
    <select name="id_rol" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un rol...</option>
        <?php foreach($roles as $rol):?>
            <option value="<?php echo $rol->id;?>" <?php echo $usuario->id_rol === $rol->id?'selected':null;?>><?php echo $rol->nombre;?></option>
        <?php endforeach;?>
    </select>
</div>

<div class="col">
    <label for="id_programa" class="form-label">Programa</label>
    <select name="id_programa" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un programa...</option>
        <?php foreach($programas as $programa):?>
            <option value="<?php echo $programa->id;?>" <?php echo isset($usuario->id_programa) && $usuario->id_programa === $programa->id?'selected':null;?>><?php echo $programa->nombre;?></option>
        <?php endforeach;?>
    </select>
</div>

<div class="col">
    <label for="id_sexo" class="form-label">Sexo</label>
    <select name="id_sexo" class="form-select" aria-label="Default select example">
        <option value="" selected>Selecciona un sexo...</option>
        <?php foreach($sexos as $sexo):?>
            <option value="<?php echo $sexo->id;?>" <?php echo $usuario->id_sexo === $sexo->id?'selected':null;?>><?php echo $sexo->nombre;?></option>
        <?php endforeach;?>
    </select>
</div>
