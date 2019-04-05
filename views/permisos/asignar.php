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
<div class="container-fluid p-0">
    <input type="hidden" id="access_type" value="<?= $_REQUEST['type'] ?>">
    <input type="hidden" id="access_type_id" value="<?= $_REQUEST['typeId'] ?>">

    <div class="row mx-0">
        <div class="col pl-0 pr-1" id="users_component"></div>
        <div class="col-auto p-0 align-self-center" id="button_actions"></div>
    </div>
    <div class="row mx-0">
        <div class="form-check float-right">
            <input type="checkbox" class="form-check-input" id="send_notification">
            <label class="form-check-label" for="send_notification">Notificar por email.</label>
        </div>
    </div>
    <div class="row mx-0 pt-5">
        <div class="col-12 px-0">
            <span class="text-complete cursor" id="show_advanced">Opciones avanzadas</span>
        </div>
    </div>
    <div id="advanced" class="d-none pt-3">
        <div class="row">
            <div class="col-12">
                <h6 class="bold">Usuarios con acceso:</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="radio radio-complete">
                    <input type="radio" id="public_radio" name="private" data-type="public">
                    <label for="public_radio">Cualquier usuario de la organización puede buscarlo y acceder. (Público)</label><br>
                    <input type="radio" id="private_radio" name="private" data-type="private">
                    <label for="private_radio">Sólo yo puedo acceder al documento. (Privado)</label><br>
                    <input type="radio" id="specific_radio" name="private" data-type="specific">
                    <label for="specific_radio">Sólo usuarios especificos.</label><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped" id="user_list"></table>
            </div>
        </div>
    </div>
</div>
<?= fancyTree() ?>
<?= select2() ?>
<script src="<?= $ruta_db_superior ?>views/permisos/js/asignar.js"></script> 