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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row py-2">
            <div class="col-12">
                <button class="btn btn-complete btn-sm float-right" id="add_function" title="Crear función">
                    Crear función
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="function_table"></table>
            </div>
        </div>
    </div>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= bootstrapTable() ?>
    <script id="function_script" src="<?= $ruta_db_superior ?>views/funciones/js/grilla.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>