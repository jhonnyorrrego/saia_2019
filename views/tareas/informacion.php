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
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen">
<div class="form-group">
    <label class="my-0" for="name">Nombre de la tarea<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" placeholder="Qué desea que se realice?">
</div>
<div class="form-group">
    <label class="my-0" for="manager">Responsable</label>
    <select class="form-control" id="manager" multiple="multiple" placeholder="Quien desea que la realice?"></select>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="send_notification">
        <label class="form-check-label" for="send_notification">Desea notificar por email?</label>
    </div>
</div>
<div class="form-group">
    <label class="my-0" for="date_ranger">Fecha limite</label>
    <div class="input-group">
        <input type="text" class="form-control" id="final_date">
        <div class="input-group-append ">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="my-0" for="description">Instrucciones adicionales</label>
    <textarea class="form-control" id="description" rows="3"></textarea>
</div>
<div class="form-group text-right">
    <button class="btn btn-complete" id="save_task"></button>
    <div class="float-right progress-circle-indeterminate" id="spiner" style="display:none"></div>
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script>
<script src="<?= $ruta_db_superior ?>views/tareas/js/informacion.js"></script> 