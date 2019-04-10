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

$jsParams = json_encode([
    'baseUrl' => $ruta_db_superior,
    'typeId' => $_REQUEST['typeId'],
    'type' => $_REQUEST['type']
]);

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PDFJSAnnotate</title>
    <link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>views/visor/shared/toolbar.css" />
</head>

<body>
    <div class="container mw-100 px-0 mx-0" id="page_editor">
        <div class="row mx-0 sticky-top" id="toolbar_container">
            <div class="col-12 toolbar" id="toolbar">
                <button class="fa fa-comment" type="button" title="Comentario" id="add_comment"></button>
                <div class="spacer"></div>
                <button class="fa fa-image thumbnails" type="button" title="Miniaturas" data-tooltype=""></button>
                <div class="spacer"></div>
                <button class="fa fa-hand-o-up active" id="cursor_tool" type="button" title="Cursor" data-tooltype="cursor"></button>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-5 col-md-2 px-1" id="thumbnails">
                <div id="item_parent" style="overflow-y:auto;"></div>
            </div>
            <div class="col px-1" id="content-wrapper" style="overflow-x:auto;"></div>
            <div class="col-auto px-1 d-none bg-master-lighter" id="comment-wrapper" style="overflow-y:auto;">
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
    <script src="<?= $ruta_db_superior; ?>assets/theme/assets/js/cerok_libraries/comments/comments.js" type="text/javascript"></script>
    <?= jqueryUi() ?>
    <script src="<?= $ruta_db_superior; ?>views/visor/js/viewer_annotate_image.js" data-pages-params='<?= $jsParams ?>' type="text/javascript"></script>
</body>

</html> 