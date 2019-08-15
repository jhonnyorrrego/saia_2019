<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'versionId' => $_REQUEST['versionId']
]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="pdf_container">
            <span class="bold"> Documento: &nbsp;</span>
        </div>
    </div>
    <div class="row pt-3 d-none">
        <div class="col-12">
            <span class="bold"> Listado de anexos: &nbsp;</span>
            <ul id="attachments_container"></ul>
        </div>
    </div>
    <div class="row pt-3 d-none">
        <div class="col-12">
            <span class="bold"> Listado de páginas: &nbsp;</span>
            <ul id="pages_container"></ul>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/documento/js/detalles_version.js" id="script_version_details" data-params='<?= $params ?>'></script>