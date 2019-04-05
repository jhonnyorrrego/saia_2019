<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PDFJSAnnotate</title>

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container px-2 mw-100">
        <div class="row mb-1 mx-0" id="tool_row">
            <div class="col-12 text-right">
                <button class="btn" id="prev-btn" style="display:none">
                    <i class="fa fa-chevron-circle-left fa-2x"></i>
                </button>
                <button class="btn" id="next-btn" style="display:none">
                    <i class="fa fa-chevron-circle-right fa-2x"></i>
                </button>
                <button class="btn" id="zoom-out-btn">
                    <i class="fa fa-search-minus fa-2x"></i>
                </button>
                <button class="btn" id="zoom-in-btn">
                    <i class="fa fa-search-plus fa-2x"></i>
                </button>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-12">
                <div id="kuku-viewer-node" class="h-100 w-100"></div>
            </div>
        </div>

    </div>

    <?= kuku() ?>
    <script id="viewer_script" src="<?= $ruta_db_superior ?>views/visor/js/viewer_kuku.js" data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>