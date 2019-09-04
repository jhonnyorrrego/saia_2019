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
    'documentId' => $_REQUEST['documentId']
]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="versions_list"></div>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/documento/js/lista_versiones.js" id="script_version_list" data-params='<?= $params ?>'></script>