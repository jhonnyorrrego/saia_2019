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

    <link href="<?= $ruta_db_superior ?>views/visor/css/jsViewer.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="modal">
        <div id="modal-container">
            <div id="docxjs-wrapper" style="width:100%;height:100%;"></div>
        </div>
    </div>
    <div id="parser-loading"></div>

    <?= kuku() ?>
    <script id="viewer_script" src="<?= $ruta_db_superior ?>views/visor/js/viewer_kuku.js" data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>