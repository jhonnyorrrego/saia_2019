<?php
if (!$_REQUEST['tipo'] || ($_REQUEST['tipo'] && $_REQUEST['tipo'] != 5)) {
    if (isset($_REQUEST["vista"]) && $_REQUEST["vista"]) {
        $vista = busca_filtro_tabla("pie_pagina", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
        $contenido_pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["pie_pagina"] . "'", "", $conn);
        $pie = busca_filtro_tabla("encabezado", $formato[0]["nombre_tabla"], "documento_iddocumento='" . $_REQUEST["iddoc"] . "'", "", $conn);
    } else {
        $contenido_pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["pie_pagina"] . "'", "", $conn);
        $pie = busca_filtro_tabla("encabezado", $formato[0]["nombre_tabla"], "documento_iddocumento='" . $_REQUEST["iddoc"] . "'", "", $conn);
    }
}

if ($pie[0]['encabezado'] && $contenido_pie["numcampos"]) : ?>
    <div class="page_margin_bottom" id="doc_footer">
        <?= crear_encabezado_pie_pagina(stripslashes($contenido_pie[0]['contenido']), $_REQUEST["iddoc"], $formato[0]["idformato"]) ?>
    </div>
<?php endif; ?>