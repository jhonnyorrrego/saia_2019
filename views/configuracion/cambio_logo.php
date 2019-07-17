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
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= dropzone() ?>
</head>

<body>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12 col-md-6">
                <div class="form-group form-group-default">
                    <label>Logo:</label>
                    <div id="file"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" id="remove_logo">Limpiar</button>
                    <button class="btn btn-complete" id="save_logo">Guardar</button>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <img src="" width="100%" id="logo">
            </div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>" src="<?= $ruta_db_superior ?>views/configuracion/js/cambio_logo.js"></script>
</body>

</html>