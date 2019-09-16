<?php
if (!$_REQUEST['tipo'] || ($_REQUEST['tipo'] && $_REQUEST['tipo'] != 5)) {
    $documentId = $_REQUEST['iddoc'];
    $Documento = new Documento($documentId);
    $Formato = $Documento->getFormat();

    if ($Formato->getFooter()) : ?>
        <div class="page_margin_bottom" id="doc_footer">
            <?= crear_encabezado_pie_pagina($Formato->getFooter()->contenido, $_REQUEST["iddoc"], $Formato->getPK()) ?>
        </div>
<?php endif;
}
