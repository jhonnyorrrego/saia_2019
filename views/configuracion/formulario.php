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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'configurationId' => $_REQUEST['configurationId'] ?? 0
]);

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Configuracion</title>
</head>

<body>
    <div class="container-fluid">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="configuration_form" autocomplete='off'>
                    <p>Los campos con <span class="bold" style="font-size:15px">*</span> son obligatorios</p>
                    <div class="form-group form-group-default required">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Valor:</label>
                        <input name="valor" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Tipo:</label>
                        <input name="tipo" type="text" class="form-control">
                    </div>
                    <?php if (SessionController::isRoot()) : ?>
                        <div class="form-group">
                            <label class="pl-1 mb-0 mt-1">Cifrar</label>
                            <div class="radio radio-success my-0">
                                <input type="radio" value="1" name="encrypt" id="encrypt1">
                                <label for="encrypt1">Si</label>
                                <input type="radio" value="0" name="encrypt" checked id="encrypt0">
                                <label for="encrypt0">No</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="pl-1 mb-0 mt-1">Acceso root</label>
                            <div class="radio radio-success my-0">
                                <input type="radio" value="1" name="acceso_root" id="acceso_root1">
                                <label for="acceso_root1">Si</label>
                                <input type="radio" value="0" name="acceso_root" checked id="acceso_root0">
                                <label for="acceso_root0">No</label>
                            </div>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <script id="configuration_script" src="<?= $ruta_db_superior ?>views/configuracion/js/formulario.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>