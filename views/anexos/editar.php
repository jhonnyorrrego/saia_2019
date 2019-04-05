<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<div class="row mx-0">
    <div class="col-12 px-0">
        <form>
            <div class="form-group">
                <label for="tag_input">Etiqueta</label>
                <input type="text" class="form-control" id="tag_input">
            </div>
            <div class="form-group">
                <label for="description_area">Descripción</label>
                <textarea class="form-control" id="description_area" rows="3"></textarea>
            </div>
        </form>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/anexos/js/editar.js" id="file_edit_script" data-baseurl="<?= $ruta_db_superior ?>" data-fileparams='<?= json_encode($_REQUEST) ?>'></script> 