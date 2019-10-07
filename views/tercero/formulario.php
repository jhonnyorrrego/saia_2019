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

include_once $ruta_db_superior . 'assets/librerias.php';

$params = json_encode([
    'baseUrl' => $ruta_db_superior
] + $_REQUEST);

?>
<div class="container">
    <div class="row">
        <div class="col-12" id="form_container">
            <div class="row">
                <div class="col-12" id="frequently"></div>
            </div>
            <div class="row pb-2">
                <div class="col-12">
                    <button class="btn btn-complete btn-sm" id="toggle_advanced">Mostrar opciones avanzadas</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-none" id="advanced"></div>
            </div>
        </div>
    </div>
</div>
<?= select2() ?>
<script id="external_script" src="<?= $ruta_db_superior ?>views/tercero/js/formulario.js" data-params='<?= $params ?>'></script>