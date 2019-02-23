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
    <link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/shared/toolbar.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/shared/pdf_viewer.css" />
    <link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/annotate.css" />
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row" id="toolbar_container">
            <div class="col-12 toolbar">
                <select class="scale">
                    <option value=".5">50%</option>
                    <option value="1" selected="selected">100%</option>
                    <option value="1.33">133%</option>
                    <option value="1.5">150%</option>
                    <option value="2">200%</option>
                </select>
                <div class="spacer"></div>
                <button class="fa fa-comment" type="button" title="Comment" data-tooltype="point"></button>
                <div class="spacer"></div>
                <button class="fa fa-undo rotate-ccw" type="button" title="Girar" data-tooltype="turn"></button>
                <button class="fa fa-refresh rotate-cw" type="button" title="Girar" data-tooltype="turn"></button>
                <div class="spacer"></div>
                <button class="fa fa-download download" type="button" title="Descargar"
                    data-tooltype="download"></button>
                <div class="spacer"></div>
                <button class="fa fa-image thumbnails" type="button" title="Miniaturas" data-tooltype=""></button>
                <div class="spacer"></div>
                <button class="fa fa-print print" type="button" title="Imprimir" data-tooltype=""></button>
                <div class="spacer"></div>
                <button class="fa fa-hand-o-up" type="button" title="Cursor" data-tooltype="cursor"></button>
            </div>
        </div>
        <div class="row">
            <div class="col-2 parent_list px-1">
                <div id="thumbnails" class="pdfViewer"></div>
            </div>
            <div class="col-7 parent_list px-1" id="content-wrapper">
                <div id="viewer" class="pdfViewer"></div>
            </div>
            <div class="col-3 px-1">
                <div id="comment-wrapper">
                    <h4>Comments</h4>
                    <div class="comment-list">
                        <div class="comment-list-container">
                            <div class="comment-list-item">No comments</div>
                        </div>
                        <form class="comment-list-form" style="display:none;">
                            <input type="text" placeholder="Add a Comment" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="printer_container" class="d-none"></div>
    
    <script src="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/shared/pdf.js"></script>
    <script src="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/shared/pdf_viewer.js"></script>
    <script src="<?= $ruta_db_superior ?>views/visor/pdfAnnotate/annotate.js"
        data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>