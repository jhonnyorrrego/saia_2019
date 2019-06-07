<?php
$max_salida = 10;
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
    'userId' => $_REQUEST['userId']
]);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Funciones</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                <div class="row">
                    <div class="col">
                        <div class="form-group form-group-default form-group-default-select2 required">
                            <label class="">Función</label>
                            <select class="full-width" id="function" multiple></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <script id="bind_function_script" src="<?= $ruta_db_superior ?>views/funciones/js/vincular_funcionario.js" data-params='<?= $params ?>'></script>
</body>

</html>