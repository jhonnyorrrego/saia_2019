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

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'searchId' => $_REQUEST['searchId']
]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
</head>

<body>
    <div class="container m-0 p-0 mw-100 mx-100 h-100">
        <div class="row mx-0 h-100">
            <div class="col-12 h-100">
                <div class="card my-3">
                    <div class="card-header">
                        <h3>Listado de reportes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mx-0 pt-2" id="component_list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="component_script" src="<?= $ruta_db_superior ?>views/buzones/js/listado_componentes.js" data-params='<?= $params ?>'></script>
</body>

</html>