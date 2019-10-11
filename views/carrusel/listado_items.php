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
    'carouselId' => $_REQUEST['carouselId'] ?? 0
]);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Items</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row pb-2">
            <div class="col-12">
                <button class="btn btn-complete btn-sm float-right" id="add_item" title="Crear función">
                    Crear noticia
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="item_table"></table>
            </div>
        </div>
    </div>
    <?= bootstrapTable() ?>
    <script id="carousel_item_script" src="<?= $ruta_db_superior ?>views/carrusel/js/listado_items.js" data-params='<?= $params ?>'></script>
</body>

</html>