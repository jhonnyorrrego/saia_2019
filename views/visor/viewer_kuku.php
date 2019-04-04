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
</head>

<body>
    <div class="container">
        <div class="row my-1" id="tool_row">
            <div class="col-12">
                <button class="btn" id="prev-btn">prev button</button>
                <button class="btn" id="next-btn">next button</button>
                <button class="btn" id="zoom-in-btn">zoom in button</button>
                <button class="btn" id="zoom-out-btn">zoom out button</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="kuku-viewer-node" class="mw-100 h-100" style="border:1px solid #eee;"></div>
            </div>
        </div>

    </div>

    <?= kuku() ?>
    <script id="viewer_script" src="<?= $ruta_db_superior ?>views/visor/js/viewer_kuku.js" data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html> 