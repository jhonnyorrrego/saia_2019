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
    <title>TRD</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
</head>

<body>
    <div class="container-fluid pt-2 h-100" style="overflow-y: auto">

        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="loadTRDForm">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="form-group form-group-default required">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Numero Versión:</label>
                        <input name="version" id="version" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Descripción:</label>
                        <textarea name="descripcion" class="form-group form-group-default"></textarea>
                    </div>

                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">Acción</label>
                        <div class="radio radio-complete ml-4 ml-md-0 mt-0">
                            <input type="radio" value="1" name="tipo" id="cargar_trd" checked=true>
                            <label class="d-block d-md-inline-block mb-0" for="cargar_trd">Cargar TRD</label>
                            <input type="radio" value="2" name="tipo" id="clonar_trd">
                            <label class="d-block d-md-inline-block mb-0" for="clonar_trd">Clonar TRD</label>
                            <input type="radio" value="3" name="tipo" id="manual_trd">
                            <label class="d-block d-md-inline-block mb-0" for="manual_trd">Carga Manual TRD</label>
                        </div>
                    </div>

                    <div class="form-group form-group-default" id="divTrd">
                        <label>TRD:</label>
                        <div id="file_trd"></div>
                        <input type="hidden" name="file_trd">
                    </div>

                    <div class="form-group form-group-default">
                        <label>Soporte:</label>
                        <div id="file_anexos"></div>
                        <input type="hidden" name="file_anexos">
                    </div>

                    <div class="form-group form-group-default" style="text-align:right">
                        <button type="submit" id="btn_success" class="btn btn-complete">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= dropzone() ?>
    <?= validate() ?>
    <script id="scriptCargarTrd" src="<?= $ruta_db_superior ?>views/serie_version/js/cargar_trd.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>