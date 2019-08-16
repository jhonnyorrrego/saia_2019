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
$btn_search = $btn_add = $actions = '';
$query = "idbusqueda_componente={$BusquedaComponente->getPK()}";

echo jquery();
echo bootstrap();
echo bootstrapTable();
echo bootstrapTableExport();
echo theme();
echo icons();

$phpLibraries = explode(",", $BusquedaComponente->getSearch()->ruta_libreria);
$jsLibraries = explode(",", $BusquedaComponente->getSearch()->ruta_libreria_pantalla);
$libraries = array_merge($phpLibraries, $jsLibraries);

foreach ($libraries as $library) {
    include_once $ruta_db_superior . $library;
}

if ($BusquedaComponente->busqueda_avanzada) {
    $btn_search = "<button class='btn btn-secondary' title='Buscar' id='btn_search' data-url='{$BusquedaComponente->busqueda_avanzada}?{$query}'>
        <i class='fa fa-search'></i>
        <span class='d-none d-sm-inline'>Buscar</span>
    </button>";
}

if ($BusquedaComponente->enlace_adicionar) {
    $BusquedaComponente->enlace_adicionar .= (strpos($BusquedaComponente->enlace_adicionar, '?') === false ? '?' : '&') . $query;

    $btn_add = "<button class='btn btn-secondary' title='Adicionar' id='btn_add' data-url='{$BusquedaComponente->enlace_adicionar}'>
        <i class='fa fa-plus'></i>
        <span class='d-none d-sm-inline'>Adicionar</span>
    </button>";
}

if ($BusquedaComponente->acciones_seleccionados) {
    $datos_reporte = [
        'idbusqueda_componente' => $BusquedaComponente->getPK(),
        'variable_busqueda' => $_REQUEST["variable_busqueda"] ?? null
    ];

    $acciones = explode(",", $BusquedaComponente->acciones_seleccionados);
    foreach ($acciones as $key => $value) {
        $actions = $value($datos_reporte);
    }
}
?>
<div class="container-fluid px-0">
    <div class="row mx-0" id="content">
        <div class="col-12">
            <div id="toolbar">
                <?= $btn_search ?>
                <?= $btn_add ?>
                <?= $actions ?>
            </div>
            <table id="table" data-selections=""></table>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/buzones/js/grilla.js" id="script_grid" data-params='<?= $params ?>'></script>