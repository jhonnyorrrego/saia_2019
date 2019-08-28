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
$sql = <<<SQL
    SELECT
        A.cantidad_registros,
        A.ruta_libreria_pantalla,
        B.idbusqueda_componente,
        B.info,
        B.busqueda_avanzada,
        B.enlace_adicionar,
        B.acciones_seleccionados
    FROM
        busqueda A JOIN
        busqueda_componente B
            ON A.idbusqueda=B.busqueda_idbusqueda
    WHERE
        B.idbusqueda_componente={$_REQUEST["idbusqueda_componente"]}
SQL;
$component = StaticSql::search($sql, 0, 1)[0];

$params = json_encode(array_merge($_REQUEST, [
    'baseUrl' => $ruta_db_superior,
    'pageSize' => $component['cantidad_registros'],
    'columns' => $component['info'],
    'showCheckbox' => empty($component['acciones_seleccionados']) ? 0 : 1
]));
$btn_search = $btn_add = $actions = '';
$query = "idbusqueda_componente={$component['idbusqueda_componente']}";

echo jquery();
echo bootstrap();
echo bootstrapTable();
echo bootstrapTableExport();
echo theme();
echo icons();
echo accionesKaiten();
echo lodash();

$routes = $component['ruta_libreria_pantalla'];
if ($routes) {
    $libraries = array_unique(explode(",", $routes));
    foreach ($libraries as $library) {
        include_once $ruta_db_superior . $library;
    }
}
if ($component['acciones_seleccionados']) {
    $datos_reporte = [
        'idbusqueda_componente' => $component['idbusqueda_componente'],
        'variable_busqueda' => $_REQUEST["variable_busqueda"] ?? null
    ];

    $acciones = explode(",", $component['acciones_seleccionados']);
    foreach ($acciones as $key => $value) {
        $actions = $value($datos_reporte);
    }
}
?>
<div class="container-fluid px-0">
    <div class="row mx-0" id="content">
        <div class="col-12">
            <div id="toolbar">
                <?php if ($component['busqueda_avanzada']) : ?>
                <button class='btn btn-secondary' title='Buscar' id='btn_search' data-url='<?= "{$component['busqueda_avanzada']}?{$query}" ?>'>
                    <i class='fa fa-search'></i>
                    <span class='d-none d-sm-inline'>Buscar</span>
                </button>
                <?php endif; ?>

                <?php
                if ($component['enlace_adicionar']) :
                    $component['enlace_adicionar'] .= (strpos($component['enlace_adicionar'], '?') === false ? '?' : '&') . $query;
                    ?>
                <button class='btn btn-secondary' title='Adicionar' id='btn_add' data-url='<?= $component['enlace_adicionar'] ?>'>
                    <i class='fa fa-plus'></i>
                    <span class='d-none d-sm-inline'>Adicionar</span>
                </button>
                <?php endif; ?>
                <?= $actions ?>
            </div>
            <table id="table"></table>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/buzones/js/grilla.js" id="script_grid" data-params='<?= $params ?>'></script>
