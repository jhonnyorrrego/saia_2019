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
    'baseUrl' => $ruta_db_superior
]);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, iversionial-scale=1, shrink-to-fit=no">
    <title>Funcionario</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
</head>

<body>
    <div class="container-fluid pt-2">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="user_form">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="form-group form-group-default required">
                        <label>Numero Versión:</label>
                        <input name="version" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Nombres:</label>
                        <input name="nombres" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="pl-1 mb-0 mt-1">Acción</label>
                        <div class="radio radio-success my-0">
                            <input type="radio" value="1" name="estado" id="cargar_trd" checked>
                            <label for="cargar_trd">Cargar TRD</label>
                            <input type="radio" value="2" name="estado" id="clonar_trd">
                            <label for="clonar_trd">Clonar TRD</label>
                        </div>
                    </div>

                    <div class="form-group form-group-default">
                        <label>TRD:</label>
                        <div id="file_trd"></div>
                        <input type="hidden" name="archivo_trd">
                    </div>

                    <div class="form-group form-group-default">
                        <label>Anexos:</label>
                        <div id="file_anexos"></div>
                        <input type="hidden" name="anexos">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= dropzone() ?>
    <?= validate() ?>
    <script id="loadTrd_script" src="<?= $ruta_db_superior ?>views/serie/js/cargar_trd.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>