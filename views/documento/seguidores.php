<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'documentId' => $_REQUEST['documentId']
]);
?>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="my-0" for="follower">Seguidor</label>
            <select class="form-control" id="follower" multiple="multiple"></select>                                
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="follower_list"></div>
</div>
<?= select2() ?>
<script src="<?= $ruta_db_superior ?>views/documento/js/seguidores.js" data-followers-params='<?= $params ?>'></script>