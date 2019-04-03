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
    <div class="container main-container">
        <button id="pdf">pdf</button>
        <button id="xlsx">xlsx</button>
        <button id="pptx">pptx</button>
        <button id="docx">docx</button>
        <button id="view-btn">Get File button</button>

        <!--control button-->
        <button id="prev-btn">prev button</button>
        <button id="next-btn">next button</button>

        <button id="zoom-in-btn">zoom in button</button>
        <button id="zoom-out-btn">zoom out button</button>

        <div id="kuku-viewer-node" style="width:1000px; height: 500px; border:1px solid #eee; margin: 20px 0;"></div>
    </div>

    <?= kuku() ?>
    <script id="viewer_script" src="<?= $ruta_db_superior ?>views/visor/js/viewer_kuku.js" data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html> 