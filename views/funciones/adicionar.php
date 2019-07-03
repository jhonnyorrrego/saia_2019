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
    'functionId' => $_REQUEST['functionId']
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
                <form id="function_form">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-default required">
                                <label class="pl-1 mb-0 mt-1">Nombre</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="state_container">
                        <div class="col-12">
                            <div class="form-group form-group-default required">
                                <label class="pl-1 mb-0 mt-1">Estado</label>
                                <div class="radio radio-success mt-0 mb-2">
                                    <input id="active" type="radio" name="state" value="1" checked required>
                                    <label for="active">Activo</label>
                                    <input id="inactive" type="radio" name="state" value="0">
                                    <label for="inactive">Inactivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <script id="add_function_script" src="<?= $ruta_db_superior ?>views/funciones/js/adicionar.js" data-params='<?= $params ?>'></script>
</body>

</html>