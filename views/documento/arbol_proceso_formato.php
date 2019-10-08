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

include_once $ruta_db_superior . "assets/librerias.php";

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'documentId' => $_REQUEST['documentId']
]);
?>
<div class="container">
    <div class="row px-0">
        <div class="col-12 px-0" id="tree_container"></div>
    </div>
    <script id="tree_document_process" src="<?= $ruta_db_superior ?>views/documento/js/arbol_proceso_formato.js" data-params='<?= $params ?>'></script>
</div>
<?= jqueryUi() ?>
<?= fancyTree() ?>