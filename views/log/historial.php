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

include_once $ruta_db_superior . "assets/librerias.php";

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'model' => $_REQUEST['model'],
    'item' => $_REQUEST['item']
]);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Historial</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table id="history_table"></table>
            </div>
        </div>
    </div>
    <?= bootstrapTable() ?>
    <script id="history_script" src="<?= $ruta_db_superior ?>views/log/js/historial.js" data-params='<?= $params ?>'></script>
</body>

</html>