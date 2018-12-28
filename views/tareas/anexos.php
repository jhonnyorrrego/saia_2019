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
            <textarea id="file_description" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-complete" id="upload" disabled="true">Cargar Anexos</button>
        </div>        
    </div>
</div>
<div class="row pt-3">
    <div class="col-12 table-responsive">
        <table class="table table-striped" id="file_history" style="display:none">
            <tr>
                <td>Nombre</td>
                <td>Versión</td>
                <td>Descripción</td>
                <td>Responsable</td>
                <td>Fecha</td>
                <td>Tamaño</td>
            </tr>
        </table>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>
<script src="<?= $ruta_db_superior ?>views/tareas/js/anexos.js"></script>