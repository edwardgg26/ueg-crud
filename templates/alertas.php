<?php 

if(isset($alertas)):
    foreach($alertas as $key => $alerta):
        foreach($alerta as $mensaje):?>
            <div class="alert alert-<?php echo $key;?> alert-dismissible fade show" role="alert">
                <p class="m-0"><?php echo $mensaje;?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php  endforeach;
    endforeach;
endif;?>