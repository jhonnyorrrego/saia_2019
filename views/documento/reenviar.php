<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
?>
<?= librerias_arboles_ft("2.24", 'filtro') ?>
<?= librerias_UI("1.12") ?>
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" media="screen">
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"
    type="text/css">
<link href="<?= $ruta_db_superior ?>views/arbol/css/arbol.css" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-12">
        <div class="radio radio-complete">
            <input type="radio" value="input" name="change_type" id="input_type" checked="checked">
            <label for="input_type">Seleccionar por usuario</label>
            <input type="radio" value="tree" name="change_type" id="tree_type">
            <label for="tree_type">Seleccionar usuarios por dependencia</label>
        </div>
    </div>
</div>
<div class="row" id="input">
    <div class="col-12">
        <div class="form-group form-group-default">
            <label>Puede buscar y elegir a los usuarios</label>
            <select class="full-width" data-init-plugin="select2" multiple id="select_users"></select>
        </div>
    </div>
</div>
<div class="row" id="tree" style="display:none">
    <div class="col-12 mb-2">
        <div id="users_tree"></div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group form-group-default">
            <label>Mensaje</label>
            <textarea class="form-control" id="message" placeholder="Escriba el mensaje que desea enviar al destino"
                rows="4"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="dropzone" class="dropzone" style="min-height:150px"></div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>
<script src="<?= $ruta_db_superior ?>views/documento/js/reenviar.js"></script>