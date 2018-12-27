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

?>
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
<div class="row" style="min-height:150px">
    <div class="col-6">
        <div id="dropzone" class="dropzone"></div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <textarea id="description" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-complete">Cargar Anexo</button>
        </div>        
    </div>
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>
<script src="<?= $ruta_db_superior ?>views/tareas/js/anexos.js"></script>