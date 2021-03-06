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

    <link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>views/visor/shared/toolbar.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= $ruta_db_superior ?>views/visor/shared/pdf_viewer.css" />
    <link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>views/visor/css/annotate.css" />
</head>

<body>
    <div class="container mw-100 px-0 mx-0" id="pdf_editor">
        <div class="row mx-0 sticky-top" id="toolbar_container">
            <div class="col-12 toolbar" id="toolbar">
                <button class="fa fa-arrow-left" type="button" title="Volver" id="goto_viewer"></button>
                <div class="spacer"></div>
                <select class="scale" id="select_scale">
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
                <button class="fa fa-print print d-none d-md-inline" id="print_pdf" type="button" title="Imprimir" data-tooltype=""></button>
                <div class="spacer d-none d-md-inline"></div>
                        <button class="fa fa-hand-o-up active" id="cursor_tool" type="button" title="Cursor" data-tooltype="cursor"></button>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-5 col-md-2 d-none px-1 height_window" style="overflow-y:auto;">
                <div id="thumbnails" class="pdfViewer"></div>
            </div>
            <div class="col px-1 height_window" id="content-wrapper">
                <div id="viewer" class="pdfViewer"></div>
            </div>
            <div class="col-5 col-md-3 px-1 d-none height_window" id="comment-wrapper">
                <h4>Comentarios</h4>
                <div class="comment-list">
                    <div class="comment-list-container"></div>
                    <form class="comment-list-form" style="display:none;">
                        <input type="text" placeholder="Comentario" class="form-control">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="printer_container" class="d-none"></div>
    
    <script src="<?= $ruta_db_superior ?>views/visor/shared/pdf.js"></script>
    <script src="<?= $ruta_db_superior ?>views/visor/shared/pdf_viewer.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/comments/comments.js"></script>
    <script src="<?= $ruta_db_superior ?>views/visor/js/annotate.js"
        data-params='<?= json_encode($_REQUEST) ?>' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>