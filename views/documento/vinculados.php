<?php
$max_salida = 6;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

$params = [
    'baseUrl' => $ruta_db_superior,
    'documentId' => $_REQUEST['documentId']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vinculados</title>

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Buscar documentos</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select class="form-control" id="document" placeholder="Documento a vincular"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>Vinculados por el usuario</h4>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-12">
                <table id="linked_list"></table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>Vinculados en el proceso</h4>
            </div>
        </div>
        <div class="row pb-3">
            <div class="col-12">
                <table id="responses_list"></table>
            </div>
        </div>
    </div>

    <?= select2() ?>
    <?= bootstrapTable() ?>
    <script id="script_documents" src="<?= $ruta_db_superior ?>views/documento/js/vinculados.js" data-documents='<?= json_encode($params) ?>'></script>
</body>

</html>