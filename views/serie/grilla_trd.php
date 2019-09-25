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
    'baseUrl' => $ruta_db_superior,
    'id' => $_REQUEST['id'],
    'type' => $_REQUEST['type'],
    'currentVersion' => $_REQUEST['currentVersion']
]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGDA</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= bootstrapTable() ?>
    <?= bootstrapTableFilter() ?>
    <?= bootstrapTableExport() ?>
    <?= theme() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container-fluid h-100" style="overflow-y:auto">
        <div class="row">
            <div class="col-12">
                <div id="toolbar">
                    <button class="btn btn-secondary" title="Adicionar" style="display:none" id="btn_add">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">Adicionar</span>
                    </button>
                    <input type="hidden" value="0" id="generateTRD">
                </div>
                <table id="trd_table"></table>
            </div>
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>views/serie/js/grilla_trd.js" id="trd_report_script" data-params='<?= $params ?>'></script>
</body>

</html>