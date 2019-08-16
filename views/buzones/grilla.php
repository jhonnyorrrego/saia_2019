<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';

$BusquedaComponente = new BusquedaComponente($_REQUEST['idbusqueda_componente']);
$params = json_encode(array_merge($_REQUEST, [
    'baseUrl' => $ruta_db_superior,
    'pageSize' => $BusquedaComponente->getSearch()->cantidad_registros,
    'columns' => $BusquedaComponente->info
]));
?>
<?= jquery() ?>
<?= bootstrap() ?>
<?= bootstrapTable() ?>
<?= bootstrapTableFilter() ?>
<?= bootstrapTableExport() ?>
<?= theme() ?>
<?= icons() ?>

<div class="container-fluid px-0">
    <div class="row mx-0" id="content">
        <div class="col-12">
            <table id="table" data-selections=""></table>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/buzones/js/grilla.js" id="script_grid" data-params='<?= $params ?>'></script>

<?php
if ($BusquedaComponente->getSearch()->ruta_libreria_pantalla) {
    $libraries = explode(',', $BusquedaComponente->getSearch()->ruta_libreria_pantalla);

    foreach ($libraries as $library) {
        include_once $ruta_db_superior . $library;
    }
}
?>