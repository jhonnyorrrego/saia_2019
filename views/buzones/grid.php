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

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . 'assets/librerias.php';

$params = (!empty($_REQUEST)) ? $_REQUEST : [];

global $conn;
$sql = "select a.ruta_libreria_pantalla,b.encabezado_componente,info,cantidad_registros from busqueda a,busqueda_componente b where a.idbusqueda = b.busqueda_idbusqueda and b.idbusqueda_componente={$_REQUEST['idbusqueda_componente']}";
$component = StaticSql::search($sql);

$nameColumns = [];
$columns = [];
$cantColumns = explode("|-|", stripslashes($component[0]["info"]));
foreach ($cantColumns as $attColumn) {
    $column = [];
    $attributes = explode("|", $attColumn);
    $column['title'] = $attributes[0];
    $column['field'] = explode('@', str_replace("{*", "", str_replace("*}", "", $attributes[1])))[0];
    $nameColumns[] = $column['field'];
    if (!empty($attributes[2])) {
        $column['align'] = $attributes[2];
    }
    $columns[] = $column;
}
$params['nameColumns'] = $nameColumns;

?>
<?= bootstrapTable() ?>
<div class="container px-0">
    <div class="row sticky-top bg-master-lightest mx-0" style="height:36px" id="header_list"></div>
    <div class="row mx-0" id="content">
        <table id="table" data-selections=""></table>
    </div>
</div>
<script>
    $(function() {
        var baseUrl = $("script[data-baseurl]").data('baseurl');
        var params = <?= json_encode($params); ?>;
        var encabezado = '<?= $component[0]["encabezado_componente"] ?>';
        var UrlsourceData = 'app/busquedas/datosBootstrapTableExp.php';
        var table = $('#table');

        table.bootstrapTable({
            url: baseUrl + UrlsourceData,
            queryParams: function(queryParams) {
                queryParams = $.extend(queryParams, params);
                return queryParams;
            },
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: '<?= $component[0]['cantidad_registros'] ?>',
            columns: <?= json_encode($columns); ?>,
            onPostBody: function() {
                table.parents('.bootstrap-table').addClass('w-100');
            },
        });
        if (encabezado) {
            $("#header_list").load(baseUrl + encabezado, params, function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        }
    });
</script>
<?php
if ($component['numcampos'] && $component[0]['ruta_libreria_pantalla']) {
    $libraries = explode(',', $component[0]['ruta_libreria_pantalla']);

    foreach ($libraries as $librarie) {
        include_once $ruta_db_superior . $librarie;
    }
}
