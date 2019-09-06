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
//POR EL MOMENTO NO SE USA ESTE SCRIPT=> BORRAR

$params = json_encode([
    'baseUrl' => $ruta_db_superior
]);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, iversionial-scale=1, shrink-to-fit=no">
    <title>SGDA</title>
    <?= jquery() ?>
    <?= jqueryUi() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <style type="text/css">
        .style-dep {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid pt-2 h-100" style="overflow-y: auto">
        <div class="row">
            <div class="col-md-6">
                <div id="trd_tree">TRD</div>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
    <?= fancyTree() ?>
    <script id="listarTrd_script" src="<?= $ruta_db_superior ?>views/serie/js/listar_trd.js" data-params='<?= $params ?>'></script>
</body>

</html>